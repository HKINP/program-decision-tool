<?php

namespace Modules\Report\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Configuration\Repositories\ActivitiesRepository;
use Modules\Configuration\Repositories\DistrictRepository;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Configuration\Repositories\QuestionRepository;
use Modules\Report\Repositories\DistrictVulnerabilityRepository;
use Modules\Report\Repositories\PrioritizedActivitiesRepository;
use Modules\Report\Repositories\PriorityRepository;
use Modules\Report\Repositories\StepRemarksRepository;
use Modules\Report\Requests\PrioritizedActivities\StoreRequest;
use Modules\Report\Requests\PrioritizedActivities\UpdateRequest;

class PrioritizedActivitiesController extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @param  DistrictRepository $districts
     * @return void
     */
    protected $mapactivities, $districts, $provinces, $priorities,
        $questions, $prioritizedactivities, $stepRemarks, $vulnerability;

    public function __construct(

        DistrictRepository $districts,
        ProvinceRepository $provinces,
        PriorityRepository $priorities,
        QuestionRepository $questions,
        PrioritizedActivitiesRepository $prioritizedactivities,
        StepRemarksRepository $stepRemarks,
        DistrictVulnerabilityRepository $vulnerability,
        ActivitiesRepository $mapactivities,

    ) {
        $this->districts = $districts;
        $this->provinces = $provinces;
        $this->priorities = $priorities;
        $this->questions = $questions;
        $this->prioritizedactivities = $prioritizedactivities;
        $this->vulnerability = $vulnerability;
        $this->stepRemarks = $stepRemarks;
        $this->mapactivities = $mapactivities;
    }

    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        if ($request->has('did') && $request->input('did') != '' && $request->has('stageId')) {
            $did = $request->query('did');
            $stageId = $request->query('stageId');

            // Determine the view to use based on stageId
            $view = $this->getViewBasedOnStageId($stageId);

            // Fetch prioritized activities
            $prioritizedActivities = $this->prioritizedactivities
                ->with(['targetGroup', 'thematicArea', 'indicator','activities'])
                ->where('district_id', $did)
                ->where('stage_id', $stageId)
                ->get();
            foreach ($prioritizedActivities as $activity) {
                $activity->platforms; // This will trigger the accessor and load related platforms

            }



            // Group activities by 'targeted_for'
            $groupedActivities = $prioritizedActivities->groupBy('targeted_for');
            $allActivities = $groupedActivities->get('all', collect()); // Default to empty collection
            $vulnerableActivities = $groupedActivities->get('vulnerable', collect()); // Default to empty collection


            // Fetch additional data
            $stepRemarks = $this->stepRemarks
                ->where('district_id', '=', $did)
                ->where('stage_id', $stageId)
                ->first();
            $districtprofile = $this->districts
                ->with(['province', 'locallevel'])
                ->find($did);
            $districtVulnerability = $this->vulnerability
                ->where('district_id', '=', $did)
                ->get();

            // Return the view with data
            return view($view)
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withAllActivities($allActivities)
                ->withVulnerableActivities($vulnerableActivities)
                ->withStepRemarks($stepRemarks);
        }

        // Handle the case where 'did' or 'stageId' is not present or invalid
        return redirect()->back()->withErrors('Invalid parameters.');
    }


    private function getViewBasedOnStageId($stageId)
    {
        switch ($stageId) {
            case 3:
                return 'Report::Sbc.index';
            case 4:
                return 'Report::HealthNutrition.index';
            case 5:
                return 'Report::FoodSystem.index';
            case 6:
                return 'Report::EnablingEnvironment.index';
            default:
                return 'Report::default.index'; // Handle other cases or default view
        }
    }
    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = $this->provinces->all()->mapWithKeys(function ($province) {
            return [$province->id => $province->province];
        })->toArray();

        return view('Configuration::District.create')
            ->withProvinces($provinces);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Modules\Configuration\Requests\District\StoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
{
    $data = $request->all();
    $did = $data['district_id'];
    $stageid = $data['stage_id'];

    // Extract common data
    $commonInputs = [
        'province_id' => $data['province_id'],
        'district_id' => $did,
        'notes' => $data['notes'],
        'key_barriers' => $data['key_barriers'],
        'stage_id' => $stageid,
    ];

    // Process specific data based on stage_id
    if ($stageid == 6) {
        $activity_id = $data['activity_id'];
        $platforms_id = $data['platforms_id'];
        $targeted_for = $data['targeted_for'];
        $remarksdata = $data['remarks'];
    } else {
        $proposed_activities = $data['proposed_activities'];
        $targeted_for = $data['targeted_for'];
        $platforms_id = $data['platforms_id'];
        $remarksdata = $data['remarks'];
        $indicator_id = $data['indicator_id'];
    }

    $groupedPlatforms = [];
    foreach ($platforms_id as $key => $platformsArray) {
        array_push($groupedPlatforms, $platformsArray);
    }


    // Handle existing record or create a new one
    $stepremarks = $this->stepRemarks->where('stage_id','=', $stageid)->first();
    if ($stepremarks) {
        $this->stepRemarks->update($stepremarks->id, $commonInputs);
    } else {
        $this->stepRemarks->create($commonInputs);
    }

    // Determine the count and iterate over activities
    $activities = $stageid == 6 ? $activity_id : $proposed_activities;
    for ($i = 0; $i < count($activities); $i++) {
        $platforms = implode(',', $groupedPlatforms[$i]);         

        $inputs = [
            'province_id' => $data['province_id'],
            'district_id' => $data['district_id'],
            'stage_id' => $data['stage_id'],
            'target_group_id' => $data['target_group_id'] ?? null,
            'thematic_area_id' => $data['thematic_area_id'] ?? null,
            'indicator_id' => $indicator_id[$i] ?? null,
            'proposed_activities' => $proposed_activities[$i] ?? '',
            'targeted_for' => $targeted_for[$i],
            'platforms_id' => $platforms,
            'activity_id' => $activity_id[$i] ?? null,
            'remarks' => $remarksdata[$i],
        ];



        $this->prioritizedactivities->create($inputs);
    }

    // Redirect or return response
    return redirect()->route('prioritizedActivities.index', ['stageId' => $stageid, 'did' => $did])
        ->with('success', 'Activities added successfully!');
}



    public function compiledReport(Request $request)
    {
        if ($request->has('did')) {
            $did = $request->query('did');
            $prioritizedActivities = $this->prioritizedactivities
                ->with(['targetGroup', 'thematicArea', 'indicator'])
                ->where('district_id', $did)
                ->get();

                foreach ($prioritizedActivities as $activity) {
                    $activity->platforms; // This will trigger the accessor and load related platforms
    
                }
    

            // Group activities by stage_id
            $groupedByStage = $prioritizedActivities->groupBy('stage_id');

            $mapactivities = $this->mapactivities->all();

            // Further group each stage's activities by targeted_for
            $structuredData = $groupedByStage->map(function ($activities) {
                return $activities->groupBy('targeted_for');
            });

            // return response()->json(['status'=>'ads','data'=>$structuredData], 200);

            $districtprofile = $this->districts
                ->with(['province', 'locallevel'])
                ->find($did);

            return view('Report::Compiled.district')
                ->withDistrictprofile($districtprofile)

                ->withMappingActivities($mapactivities)
                ->withActivities($structuredData);
        }
    }

    public function activityMapping(Request $request)
    {
        $data = $request->all();
        $id = $data['activity_id'];
        $did = $data['district_id'];

        $inputs = [
            'activity_id' => $data['activities'],
        ];

        $this->prioritizedactivities->update($id, $inputs);
        return redirect()->route('prioritizedActivities.index', ['stageId' => 6, 'did' => $did])
            ->with('success', 'Activities added successfully!');
    }


    public function compiledReportProvince($id)
    {

        $prioritizedActivities = $this->prioritizedactivities
            ->with(['targetGroup', 'thematicArea', 'indicator', 'platforms', 'province'])
            ->where('province_id', $id)
            ->get();

        // Group activities by stage_id
        $groupedByStage = $prioritizedActivities->groupBy('stage_id');
        $province = $this->provinces->where('id', '=', $id)->first();
        // Further group each stage's activities by targeted_for
        $structuredData = $groupedByStage->map(function ($activities) {
            return $activities->groupBy('targeted_for');
        });

        // return response()->json(['status'=>'ads','data'=>$structuredData], 200);


        return view('Report::Compiled.province')
            ->withProvince($province)
            ->withActivities($structuredData);
    }
}
