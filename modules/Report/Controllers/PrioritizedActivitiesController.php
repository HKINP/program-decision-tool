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
        if ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 3) {
            $did = $request->query('did');
            $stageId = $request->query('stageId');
            $prioritizedActivities = $this->prioritizedactivities->with(['targetGroup','thematicArea','indicator','platforms'])
                ->where('district_id', '=', $request->did)
                ->where('stage_id', '=', $stageId)
                ->get();

            // Group activities by the 'targetted_for' column
            $groupedActivities = $prioritizedActivities->groupBy('targeted_for');

            // Retrieve specific groups
            $allActivities = $groupedActivities->get('all', collect()); // default to empty collection if 'all' key doesn't exist
            $vulnerableActivities = $groupedActivities->get('vulnerable', collect()); // default to empty collection if 'other' key doesn't exist

            $stepRemarks = $this->stepRemarks->where('district_id', '=', $did)->where('stage_id', '=', 3)->first();
            $districtprofile = $this->districts->with(['province', 'locallevel'])->find($did);
            $districtVulnerability = $this->vulnerability->where('district_id', '=', $did)->get();

            // Return the view with additional data
            return view('Report::Sbc.index')
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withAllActivities($allActivities)
                ->withVulnerableActivities($vulnerableActivities)
                ->withStepRemarks($stepRemarks);
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

        $stepremarks = $this->stepRemarks->where('stage_id', '=', $data['stage_id'])->first();

        if ($stepremarks) {
            // Update existing record
            $inputs = [
                'district_id' => $data['district_id'],
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
                'target_group_id' => $data['target_group_id'],
                'thematic_area_id' => $data['thematic_area_id'],
                'indicator_id' => $data['indicator_id'],
                'proposed_activities' => $proposed_activities[$i],
                'targeted_for' => $targeted_for[$i],
                'platforms_id' => $platforms_id[$i],
                'remarks' => $remarks[$i],
            ];

            $this->prioritizedactivities->create($inputs);
        }
        // Redirect or return response
        return redirect()->route('prioritizedactivities.index')
            ->with('success', 'Prioritized Activities added successfully!');
    }

    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $District = $this->districts->find($id);
        return response()->json(['status' => 'ok', 'district' => $district], 200);
    }

    /**
     * Show the form for editing the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        // $this->authorize('manage-account-code');
        $provinces = $this->provinces->all()->mapWithKeys(function ($province) {
            return [$province->id => $province->province];
        })->toArray();

        return view('Configuration::District.edit')
            ->withDistrict($this->districts->find($id))
            ->withProvinces($provinces);
    }

    /**
     * Update the specified account head in storage.
     *
     * @param  \Modules\Configuration\Requests\District\UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, $id)
    {
        // $this->authorize('manage-account-code');


        $District = $this->districts->update($id, $request->except('id'));

        if ($District) {
            return redirect()->route('district.index')->with('success', 'District Updated successfully!');
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Account Code can not be updated.'
        ], 422);
    }

    /**
     * Remove the specified account head from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        // $this->authorize('manage-account-code');
        $flag = $this->districts->destroy($id);
        if ($flag) {
            return redirect()->route('district.index')->with('success', 'District is successfully deleted.');
        }
        return response()->json([
            'type' => 'error',
            'message' => 'District can not deleted.',
        ], 422);
    }
}
