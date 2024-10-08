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
use Modules\Configuration\Repositories\ActivitiesRepository;
use Modules\Report\Repositories\KeyBarrierRepository;

class DashboardController extends Controller
{

    protected $districts, $stages, $provinces,
        $priorities, $questions, $thematicgroups,
        $tags, $locallevel, $vulnerability, $stepRemarks, $activities, $platforms, $prioritizedActivities, $keybarriers;
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
        ActivitiesRepository $activities,
        KeyBarrierRepository $keybarriers,

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
        $this->keybarriers = $keybarriers;
        $this->prioritizedActivities = $prioritizedActivities;
        $this->activities = $activities;
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
            $district = $this->districts->where('id', '=', $did)->first();
            return view('pages/dashboard/toolscreate')
                ->withStageInfo($stageInfo)
                ->withDistrictID($did)
                ->withDistrict($district);
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
            $datastatus = $this->getStatuses($did);


            $stepRemarks = $this->stepRemarks->where('district_id', '=', $did)->where('stage_id', '=', 1)->first();
            $districtprofile = $this->districts->with(['province', 'locallevel'])->find($did);

            if ($datastatus['districtvulnerability'] == 1) {
                return redirect()->route('districtvulnerability.index', ['stageId' => 1, 'did' => $did]);
            }
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();
            return view('Report::DistrictContext.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability);
        }



        if ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 2) {


            $did = $request->query('did');
            $datastatus = $this->getStatuses($did);

            if ($datastatus['prioritystatus'] == 1) {
                return redirect()->route('priority.index', ['stageId' => 2, 'did' => $did]);
            }


            $districtprofile = $this->districts->with(['province', 'province.provinceProfiles', 'locallevel'])->find($did);


            if (count($districtprofile->province->provinceProfiles) === 0) {
                return redirect()->route('provinceprofile.create')->with('error', 'Please create a province profile for ' . $districtprofile->province->province);
            }




            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();
            // Check if district_vulnerability is empty
            if ($districtVulnerability->isEmpty()) {
                return redirect()->route('dataentrystage.create', ['stageId' => 1, 'did' => $did])
                    ->with('error', 'District vulnerability data is missing.');
            }

            $province_id = $districtprofile->province->id;
            $stepRemarks = $this->stepRemarks->where('district_id', '=', $did)->where('stage_id', '=', 2)->first();

            $questions = $this->questions->with([
                'thematicArea',
                'indicator' => function ($query) use ($province_id, $did) {
                    $query->with([
                        'provinceProfiles' => function ($query) use ($province_id) {
                            $query->where('province_id', $province_id);
                        },
                        'districtProfiles' => function ($query) use ($did) {
                            $query->where('district_id', $did);
                        }
                    ]);
                },
                'targetGroup'
            ])->where('target_group_id', '!=', 5)->get();
            //  return response()->json(['status'=>'ads','data'=>$questions[0]->indicator->provinceProfiles[0]], 200);



            $priorities = $this->priorities->where('district_id', '=', $did)->get();

            // Return the view with additional data
            return view('Report::Priorities.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withStepRemarks($stepRemarks)
                ->withPriorities($priorities)
                ->withQuestions($questions);



        } elseif ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 3) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');
            $datastatus = $this->getStatuses($did);

            if ($datastatus['prioritystatus'] == 0) {
                return redirect()->route('dataentrystage.create', ['stageId' => 2, 'did' => $did])
                    ->with('error', 'Prioritization steps is incomplete');
            }
            if ($datastatus['ir1status'] == 1) {
                return redirect()->route('prioritizedActivities.index', ['stageId' => $stageId, 'did' => $did]);
            }

            // Fetch district profile
            $districtprofile = $this->districts->with(['province', 'locallevel'])->find($did);
            // Fetch priorities with associated relationships
            $priorities = $this->priorities->with(['thematicArea', 'targetGroup', 'question'])
                ->where('district_id', '=', $did)
                ->where('priority', '=', 1)
                ->get();
            $platforms = $this->platforms->get();
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();

            // Fetch prioritized activities
            $subactivities = $this->prioritizedActivities
                ->with(['targetGroup', 'thematicArea', 'indicator', 'activity'])
                ->where('district_id', $did)
                ->where('stage_id', 3)
                ->get();


            //  return response()->json(['status'=>'ads','data'=>$prioritizedActivities], 200);
            foreach ($subactivities as $activity) {
                $activity->platforms; // This will trigger the accessor and load related platforms

            }
            $subactivities = $subactivities->groupBy('indicator_id');
            $keybarriers = $this->keybarriers
                ->where('district_id', '=', $did)
                ->where('stage_id', 3)
                ->get()
                ->groupBy('indicator_id');

            $stepRemarks = $this->stepRemarks
                ->where('district_id', '=', $did)
                ->where('stage_id', '=', 3)
                ->get()->first();

            // Return the view with additional data
            return view('Report::Sbc.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withPlatforms($platforms)
                ->withSubactivities($subactivities)
                ->withStepRemarks($stepRemarks)
                ->withKeybarriers($keybarriers)
                ->withPriorities($priorities);
        } elseif ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 4) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');
            $datastatus = $this->getStatuses($did);

            if ($datastatus['prioritystatus'] == 0) {
                return redirect()->route('dataentrystage.create', ['stageId' => 2, 'did' => $did])
                    ->with('error', 'Prioritization steps is incomplete');
            }
            if ($datastatus['ir2status'] == 1) {
                return redirect()->route('prioritizedActivities.index', ['stageId' => $stageId, 'did' => $did]);
            }

            // Fetch district profile
            $districtprofile = $this->districts->with(['province', 'locallevel'])->find($did);
            // Fetch priorities with associated relationships
            $priorities = $this->priorities->with(['thematicArea', 'targetGroup', 'question'])
                ->where('district_id', '=', $did)
                ->where('priority', '=', 1)
                ->get();
               
            $keybarriers = $this->keybarriers
                ->where('district_id', '=', $did)
                ->where('stage_id', $stageId)
                ->get()
                ->groupBy('indicator_id');

            $stepRemarks = $this->stepRemarks
                ->where('district_id', '=', $did)
                ->where('stage_id', '=', 4)
                ->get()->first();


            $subactivities = $this->prioritizedActivities
                ->with(['targetGroup', 'thematicArea', 'indicator', 'activity'])
                ->where('district_id', $did)
                ->where('stage_id', $stageId)
                ->get();
            //  return response()->json(['status'=>'ads','data'=>$prioritizedActivities], 200);
            foreach ($subactivities as $activity) {
                $activity->platforms; // This will trigger the accessor and load related platforms

            }
            $subactivities = $subactivities->groupBy('indicator_id');


            $platforms = $this->platforms->get();
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();

            // Return the view with additional data
            return view('Report::HealthNutrition.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withPlatforms($platforms)
                ->withSubactivities($subactivities)
                ->withStepRemarks($stepRemarks)
                ->withKeybarriers($keybarriers)
                ->withPriorities($priorities);
        } elseif ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 5) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');
            $datastatus = $this->getStatuses($did);

            if ($datastatus['prioritystatus'] == 0) {
                return redirect()->route('dataentrystage.create', ['stageId' => 2, 'did' => $did])
                    ->with('error', 'Prioritization steps is incomplete');
            }
            if ($datastatus['ir3status'] == 1) {
                return redirect()->route('prioritizedActivities.index', ['stageId' => $stageId, 'did' => $did]);
            }

            $keybarriers = $this->keybarriers
                ->where('district_id', '=', $did)
                ->where('stage_id', $stageId)
                ->get()
                ->groupBy('indicator_id');

            $stepRemarks = $this->stepRemarks
                ->where('district_id', '=', $did)
                ->where('stage_id', '=', 5)
                ->get()->first();


            $subactivities = $this->prioritizedActivities
                ->with(['targetGroup', 'thematicArea', 'indicator', 'activity'])
                ->where('district_id', $did)
                ->where('stage_id', $stageId)
                ->get();
            //  return response()->json(['status'=>'ads','data'=>$prioritizedActivities], 200);
            foreach ($subactivities as $activity) {
                $activity->platforms; // This will trigger the accessor and load related platforms

            }
            $subactivities = $subactivities->groupBy('indicator_id');

            // Fetch district profile
            $districtprofile = $this->districts->with(['province', 'locallevel'])->find($did);
            // Fetch priorities with associated relationships
            $priorities = $this->priorities->with(['thematicArea', 'targetGroup', 'question', 'question.indicator'])
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
                ->withSubactivities($subactivities)
                ->withStepRemarks($stepRemarks)
                ->withKeybarriers($keybarriers)
                ->withPriorities($priorities);
        } elseif ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 6) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');
            $datastatus = $this->getStatuses($did);


            if ($datastatus['ir4status'] == 1) {
                return redirect()->route('prioritizedActivities.index', ['stageId' => $stageId, 'did' => $did]);
            }

            $keybarriers = $this->keybarriers
                ->where('district_id', '=', $did)
                ->where('stage_id', $stageId)
                ->get()
                ->groupBy('indicator_id');

            // return response()->json(['data'=>'error','data'=>$keybarriers], 422);

            $stepRemarks = $this->stepRemarks
                ->where('district_id', '=', $did)
                ->where('stage_id', '=', 6)
                ->get()->first();


            $subactivities = $this->prioritizedActivities
                ->with(['targetGroup', 'thematicArea', 'indicator', 'activity'])
                ->where('district_id', $did)
                ->where('stage_id', $stageId)
                ->get();
            foreach ($subactivities as $activity) {
                $activity->platforms; // This will trigger the accessor and load related platforms

            }
            $subactivities = $subactivities->groupBy('indicator_id');

            // Fetch district profile
            $districtprofile = $this->districts->with(['province', 'locallevel'])->find($did);
            $activities = $this->activities->where('ir_id', '=', '4')->get();

            // Fetch priorities with associated relationships
            $priorities = $this->questions->with(['thematicArea', 'targetGroup'])
                ->where('target_group_id', '=', 5) // Assuming 'target_group_id' is the correct column name
                ->get();

            // return response()->json(['status' => 'ads', 'data' => $keybarriers], 200);
            $platforms = $this->platforms->get();
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();

            // Return the view with additional data
            return view('Report::EnablingEnvironment.create')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withActivities($activities)
                ->withPlatforms($platforms)
                ->withSubactivities($subactivities)
                ->withStepRemarks($stepRemarks)
                ->withKeybarriers($keybarriers)
                ->withPriorities($priorities);
        } elseif ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 7) {

            $did = $request->query('did');
            $stageId = $request->query('stageId');
            $datastatus = $this->getStatuses($did);

            $allStatusesAreOne = array_reduce($datastatus, fn($carry, $status) => $carry && $status === 1, true);

            if ($allStatusesAreOne) {
                return redirect()->route('compiledreport.district', ['did' => $did]);
            } else {
                return redirect()->route('steplist.create', ['did' => $did])
                    ->with('error', "Compiled Report generation failed. Please complete all data entry steps.");
            }
        }
    }
}
