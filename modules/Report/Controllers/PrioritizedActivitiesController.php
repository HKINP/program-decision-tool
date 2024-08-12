<?php

namespace Modules\Report\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    protected $districts, $provinces, $priorities, $questions, $prioritizedactivities, $stepRemarks, $vulnerability;

    public function __construct(

        DistrictRepository $districts,
        ProvinceRepository $provinces,
        PriorityRepository $priorities,
        QuestionRepository $questions,
        PrioritizedActivitiesRepository $prioritizedactivities,
        StepRemarksRepository $stepRemarks,
        DistrictVulnerabilityRepository $vulnerability,

    ) {
        $this->districts = $districts;
        $this->provinces = $provinces;
        $this->priorities = $priorities;
        $this->questions = $questions;
        $this->prioritizedactivities = $prioritizedactivities;
        $this->vulnerability = $vulnerability;
        $this->stepRemarks = $stepRemarks;
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
                ->with(['targetGroup', 'thematicArea', 'indicator', 'platforms'])
                ->where('district_id', $did)
                ->where('stage_id', $stageId)
                ->get();

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
        $proposed_activities = $data['proposed_activities'];
        $targeted_for = $data['targeted_for'];
        $platforms_id = $data['platforms_id'];
        $remarks = $data['remarks'];
        $did = $data['district_id'];
        $stageid = $data['stage_id'];

        $stepremarks = $this->stepRemarks->where('stage_id', '=', $stageid)->first();

        if ($stepremarks) {
            // Update existing record
            $inputs = [
                'district_id' => $did,
                'notes' => $data['notes'],
                'key_barriers' => $data['key_barriers'],
                'province_id' => $data['province_id'],
            ];

            $this->stepRemarks->update($stepremarks->id, $inputs);
        } else {
            // Create a new record if no existing record is found
            $remarks = $this->stepRemarks->create([
                'district_id' => $data['district_id'],
                'notes' => $data['notes'],
                'key_barriers' => $data['key_barriers'],
                'province_id' => $data['province_id'],
                'stage_id' => $data['stage_id'] // Ensure stage_id is set for new records
            ]);
        }


        for ($i = 0; $i < count($data['proposed_activities']); $i++) {

            $inputs = [
                'province_id' => $data['province_id'],
                'district_id' => $data['district_id'],
                'stage_id' => $data['stage_id'],
                'target_group_id' => $data['target_group_id'] ?? null,
                'thematic_area_id' => $data['thematic_area_id'] ?? null,
                'indicator_id' => $data['indicator_id'] ?? null,
                'proposed_activities' => $proposed_activities[$i],
                'targeted_for' => $targeted_for[$i],
                'platforms_id' => $platforms_id[$i],
                'remarks' => $remarks[$i],
            ];

            $this->prioritizedactivities->create($inputs);
        }
        // Redirect or return response
        // Redirect or return response
        return redirect()->route('prioritizedActivities.index', ['stageId' => $stageid, 'did' => $did])
            ->with('success', 'Activities added successfully!');
    }
    public function compiledReport(Request $request)
    {
        if ($request->has('did')) {
            $did = $request->query('did');
            $prioritizedActivities = $this->prioritizedactivities
            ->with(['targetGroup', 'thematicArea', 'indicator', 'platforms'])
            ->where('district_id', $did)
            ->get();
        
        // Group activities by stage_id
        $groupedByStage = $prioritizedActivities->groupBy('stage_id');
        
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
                ->withActivities($structuredData);
        }
    }
}
