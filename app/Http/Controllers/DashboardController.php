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
use Modules\Report\Repositories\PrioritizedActivitiesRepository;
use Modules\Report\Repositories\StepRemarksRepository;
use App\Traits\StageStatus;

class DashboardController extends Controller
{

    protected $districts, $stages, $provinces,
        $priorities, $questions, $thematicgroups,
        $tags, $locallevel, $vulnerability, $stepRemarks, $platforms, $prioritizedActivities;
    use StageStatus;

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
        PrioritizedActivitiesRepository $prioritizedActivities,

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
        $this->prioritizedActivities = $prioritizedActivities;
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
            // Retrieve stage information (route and tick) for each stage
            $stageInfo = $stages->map(function ($stage) use ($did) {
                return array_merge(
                    ['stage' => $stage], // Include the stage object
                    $this->getStageInfo($stage->id, $did) // Get route and tick status
                );
            });
            return view('pages/dashboard/toolscreate')
                ->withStageInfo($stageInfo)
                ->withDistrictID($did);
        }
        
        $provinces = $this->provinces->with(['districts'])->get();
        // $this->authorize('manage-account-code');
        return view('pages/dashboard/dataentry')
            ->withProvinces($provinces);
    }

    public function stages(Request $request)
    {

        if ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 1) 
        {
            $did = $request->query('did');
            $datastatus=$this->getStatuses($did);
           
            
            $stepRemarks = $this->stepRemarks->where('district_id', '=', $did)->where('stage_id', '=', 1)->first();
            $districtprofile = $this->districts->with(['province','locallevel'])->find($did);            
            
            if ($datastatus['districtvulnerability']==1) {
                return redirect()->route('districtvulnerability.index', ['stageId' => 1, 'did' => $did]); 
            }
            return view('Report::DistrictContext.create')
                ->withDistrictprofile($districtprofile);
        }



        if ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 2) {

            $did = $request->query('did');
            $datastatus=$this->getStatuses($did);

            if($datastatus['prioritystatus']==1){
                return redirect()->route('priority.index', ['stageId' => 2, 'did' => $did]);
            }
        
            $districtprofile = $this->districts->with(['province','locallevel'])->find($did);
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();
            // Check if district_vulnerability is empty
            if ($districtVulnerability->isEmpty()) {
                return redirect()->route('dataentrystage.create', ['stageId' => 1, 'did' => $did])
                    ->with('error', 'District vulnerability data is missing.');
            }

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

            // Return the view with additional data
            return view('Report::Priorities.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withQuestions($questions);


        } 



        elseif ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 3) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');            
            $datastatus=$this->getStatuses($did);
          
            if($datastatus['prioritystatus']==0){
                return redirect()->route('dataentrystage.create', ['stageId' => 2, 'did' => $did]) 
                ->with('error', 'Prioritization steps is incomplete');
            }
            if($datastatus['ir1status']==1){
                return redirect()->route('prioritizedActivities.index', ['stageId' => $stageId, 'did' => $did]);
            }

            // Fetch district profile
            $districtprofile = $this->districts->with(['province','locallevel'])->find($did);
            // Fetch priorities with associated relationships
            $priorities = $this->priorities->with(['thematicArea', 'targetGroup', 'question'])
                ->where('district_id', '=', $did)
                ->where('priority', '=', 1)
                ->get();
            $platforms = $this->platforms->get();
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();

            // Return the view with additional data
            return view('Report::Sbc.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withPlatforms($platforms)
                ->withPriorities($priorities);
        } 

        elseif ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 4) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');            
            $datastatus=$this->getStatuses($did);
          
            if($datastatus['prioritystatus']==0){
                return redirect()->route('dataentrystage.create', ['stageId' => 2, 'did' => $did]) 
                ->with('error', 'Prioritization steps is incomplete');
            }
            if($datastatus['ir2status']==1){
                return redirect()->route('prioritizedActivities.index', ['stageId' => $stageId, 'did' => $did]);
            }

            // Fetch district profile
            $districtprofile = $this->districts->with(['province','locallevel'])->find($did);
            // Fetch priorities with associated relationships
            $priorities = $this->priorities->with(['thematicArea', 'targetGroup', 'question'])
                ->where('district_id', '=', $did)
                ->where('priority', '=', 1)
                ->get();
            $platforms = $this->platforms->get();
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();

            // Return the view with additional data
            return view('Report::HealthNutrition.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withPlatforms($platforms)
                ->withPriorities($priorities);
        }
        elseif ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 5) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');            
            $datastatus=$this->getStatuses($did);
          
            if($datastatus['prioritystatus']==0){
                return redirect()->route('dataentrystage.create', ['stageId' => 2, 'did' => $did]) 
                ->with('error', 'Prioritization steps is incomplete');
            }
            if($datastatus['ir3status']==1){
                return redirect()->route('prioritizedActivities.index', ['stageId' => $stageId, 'did' => $did]);
            }

            // Fetch district profile
            $districtprofile = $this->districts->with(['province','locallevel'])->find($did);
            // Fetch priorities with associated relationships
            $priorities = $this->priorities->with(['thematicArea', 'targetGroup', 'question'])
                ->where('district_id', '=', $did)
                ->where('priority', '=', 1)
                ->get();
            $platforms = $this->platforms->get();
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();

            // Return the view with additional data
            return view('Report::FoodSystem.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withPlatforms($platforms)
                ->withPriorities($priorities);
        }
        elseif ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 6) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');            
            $datastatus=$this->getStatuses($did);
          
            
            if($datastatus['ir4status']==1){
                return redirect()->route('prioritizedActivities.index', ['stageId' => $stageId, 'did' => $did]);
            }

            // Fetch district profile
            $districtprofile = $this->districts->with(['province','locallevel'])->find($did);
            // Fetch priorities with associated relationships
            $priorities = $this->priorities->with(['thematicArea', 'targetGroup', 'question'])
                ->where('district_id', '=', $did)
                ->where('priority', '=', 1)
                ->get();
            $platforms = $this->platforms->get();
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();

            // Return the view with additional data
            return view('Report::EnablingEnvironment.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withPlatforms($platforms)
                ->withPriorities($priorities);
        }
    }
}
