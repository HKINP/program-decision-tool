<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFeed;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Configuration\Repositories\StagesRepository;
use Modules\Report\Repositories\DistrictVulnerabilityRepository;
use Modules\Report\Repositories\PriorityRepository;
use Modules\Configuration\Repositories\DistrictRepository;
use Modules\Configuration\Repositories\LocalLevelRepository;
use Modules\Configuration\Repositories\PlatformsRepository;
use Modules\Configuration\Repositories\QuestionRepository;
use Modules\Report\Repositories\StepRemarksRepository;

class DashboardController extends Controller
{

    protected $districts, $stages, $provinces,
     $priorities, $questions, $thematicgroups,
      $tags, $locallevel, $vulnerability,$stepRemarks,$platforms;


    public function __construct(

        ProvinceRepository $provinces,
        StagesRepository $stages,
        DistrictVulnerabilityRepository $vulnerability,
        PlatformsRepository $platforms,
        DistrictRepository $districts,
        PriorityRepository $priorities,
        QuestionRepository $questions,
        LocalLevelRepository $locallevel,
        StepRemarksRepository $stepRemarks,

    ) {
        $this->provinces = $provinces;
        $this->stages = $stages;
        $this->districts = $districts;
        $this->priorities = $priorities;
        $this->questions = $questions;
        $this->locallevel = $locallevel;
        $this->vulnerability = $vulnerability;
        $this->stepRemarks = $stepRemarks;
        $this->platforms = $platforms;
    }

    public function index()
    {
        return view('pages/dashboard/dashboard');
    }
    public function documentation()
    {
        return view('pages/dashboard/documentation');
    }
    public function stageRecord(Request $request)
    {
        if ($request->has('did')) {
            $did = $request->query('did');
            $stages = $this->stages->get();
            $districtvulnerability = $this->vulnerability->where('district_id', '=', $did)->exists();
            $prioritystatus = $this->priorities->where('district_id', '=', $did)->exists();
            return view('pages/dashboard/toolscreate')
                ->withDistrictvulnerability($districtvulnerability)
                ->withPrioritystatus($prioritystatus)
                ->withStages($stages)
                ->withDistrictID($did);
        }


        $provinces = $this->provinces->with(['districts'])->get();
        // $this->authorize('manage-account-code');
        return view('pages/dashboard/dataentry')
            ->withProvinces($provinces);
    }

    public function stages(Request $request)
    {

        if ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 1) {
            $did = $request->query('did');
            $stageId = $request->query('stageId');
            
            // Fetch district profile
            $districtvulnerabilitystatus = $this->vulnerability->where('district_id', '=', $did)->exists();
            $stepRemarks = $this->stepRemarks->where('district_id', '=', $did)->where('stage_id', '=', 1)->first();
            $districtprofile = $this->districts->with(['province'])->find($did);
            $locallevel = $this->locallevel->where('district_id', '=', $did)->get();
            if ($districtvulnerabilitystatus) {

            $districtVulnerability = $this->vulnerability->with(['locallevel'])->where('district_id', $did)->get();
            return view('Report::DistrictContext.index')
                ->withDistrictVulnerability($districtVulnerability)
                ->withLocallevel($locallevel)
                ->withStepRemarks($stepRemarks)
                ->withDistrictprofile($districtprofile);
            }
            return view('Report::DistrictContext.create')
                ->withLocallevel($locallevel)
                ->withDistrictprofile($districtprofile);
        }



        if ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 2) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');
            $prioritystatus = $this->priorities->where('district_id', '=', $did)->exists();
            // Fetch district profile
            $districtprofile = $this->districts->with(['province'])->find($did);
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();
            $locallevel = $this->locallevel->where('district_id', '=', $did)->get();
            $province_id = $districtprofile->province->id;
            $stepRemarks = $this->stepRemarks->where('district_id', '=', $did)->where('stage_id', '=', 2)->first();

            // Fetch questions
            $questions = $this->questions->with([
                'thematicArea',
                'indicator' => function ($query) use ($province_id) { // Pass $province_id into the closure
                    $query->with(['provinceProfiles' => function ($query) use ($province_id) { // Pass $province_id into this closure too
                        $query->where('province_id', $province_id);
                    }]);
                },
                'targetGroup'
            ])->get();


            if ($prioritystatus) {
                // Fetch priorities with associated relationships
                $priorities = $this->priorities->with([
                    'thematicArea',
                    'targetGroup',
                    'question' => function ($query) use ($province_id) {
                        $query->with([
                            'indicator' => function ($query) use ($province_id) {
                                $query->with(['provinceProfiles' => function ($query) use ($province_id) {
                                    $query->where('province_id', $province_id);
                                }]);
                            }
                        ]);
                    }
                ])
                    ->where('district_id', '=', $did)
                    ->get();

                // Return view response if $prioritystatus is not true
                return view('Report::Priorities.index')
                    ->withDistrictprofile($districtprofile)
                    ->withDistrictVulnerability($districtVulnerability)
                    ->withLocallevel($locallevel)
                    ->withQuestions($questions)
                    ->withStepRemarks($stepRemarks)
                    ->withPriorities($priorities);
            }
            // Return the view with additional data
            return view('Report::Priorities.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withLocallevel($locallevel)
                ->withQuestions($questions);
        } elseif (
            $request->has('did') && $request->input('did') != '' &&
            $request->has('stageId') && $request->input('stageId') == 3
        ) {
            $did = $request->query('did');
            $stageId = $request->query('stageId');
            // Fetch district profile
            $districtprofile = $this->districts->with(['province'])->find($did);
            // Fetch priorities with associated relationships
            $priorities = $this->priorities->with(['thematicArea', 'targetGroup', 'question'])
                ->where('district_id', '=', $did)
                ->where('priority', '=', 1)
                ->get();
            $platforms=$this->platforms->get();
            $locallevel = $this->locallevel->where('district_id', '=', $did)->get();
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();

                     // Return the view with additional data
            return view('Report::Sbc.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withPlatforms($platforms)
                ->withLocallevel($locallevel)
                ->withPriorities($priorities);
        }
    }
}
