<?php

namespace Modules\Report\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\DistrictRepository;
use Modules\Configuration\Repositories\LocalLevelRepository;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Configuration\Repositories\QuestionRepository;
use Modules\Configuration\Repositories\TagsRepository;
use Modules\Configuration\Repositories\TargetGroupRepository;
use Modules\Report\Models\DistrictVulnerability;
use Modules\Report\Repositories\PrioritizedActivitiesRepository;
use Modules\Report\Repositories\PriorityRepository;
use Modules\Report\Repositories\StepRemarksRepository;
use Modules\Report\Requests\Priority\StoreRequest;
use Modules\Report\Requests\Priority\UpdateRequest;
use App\Traits\StageStatus;

class PriorityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  DistrictRepository $districts
     * @return void
     */
    protected $districts, $provinces, $priorities, $questions, $thematicgroups, $tags, $locallevel, $vulnerability, $stepRemarks,$prioritizedActivities;
    use StageStatus;

    public function __construct(

        DistrictRepository $districts,
        ProvinceRepository $provinces,
        PriorityRepository $priorities,
        QuestionRepository $questions,
        LocalLevelRepository $locallevel,
        DistrictVulnerability $vulnerability,
        StepRemarksRepository  $stepRemarks,
        PrioritizedActivitiesRepository $prioritizedActivities,

    ) {
        $this->districts = $districts;
        $this->provinces = $provinces;
        $this->priorities = $priorities;
        $this->questions = $questions;
        $this->locallevel = $locallevel;
        $this->vulnerability = $vulnerability;
        $this->stepRemarks = $stepRemarks;
        $this->prioritizedActivities = $prioritizedActivities;
    }

    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $did = $request->query('did');
        
        $stepRemarks = $this->stepRemarks->where('district_id', '=', $did)->where('stage_id', '=', 2)->where('stage_status', '=', 1)->first();
        // Fetch district profile
        $districtprofile = $this->districts->with(['province'])->find($did);
        $districtVulnerability = $this->vulnerability->where('district_id', $did)->get();
        $statuses = $this->getStatuses($did);
        // Check if district_vulnerability is empty
        if ($districtVulnerability->isEmpty()) {
            return redirect()->route('dataentrystage.create', ['stageId' => 1, 'did' => $did]); // Replace 'another.route.name' with the actual route name
        }
        if($statuses['prioritystatus']!=1){
            return redirect()->route('dataentrystage.create', ['stageId' => 2, 'did' => $did]); // Replace 'another.route.name' with the actual route name}
         }
          $province_id = $districtprofile->province->id;

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
            ->where('priority', '=', 1)
            ->get();

        // Return view response if $prioritystatus is not true
        return view('Report::Priorities.index')
            ->withDistrictprofile($districtprofile)
            ->withDistrictVulnerability($districtVulnerability)
            ->withIr1status($statuses['ir1status'])
            ->withQuestions($questions)
            ->withStepRemarks($stepRemarks)
            ->withPriorities($priorities);
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
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $targetGroups = $data['target_group_id'];
        $thematicAreas = $data['thematic_area_id'];
        $questions = $data['question_id'];
        $priorities = $data['priority'];
    
        // Check for existing step remarks
        $stepremarks = $this->stepRemarks->where('stage_id','=', 2)->where('district_id','=',$data['district_id'])->first();

        if ($stepremarks) {
            // Update existing record
            $inputs = [
                'notes' => $data['notes'],
                'stage_status' => 1,
            ];
            
            $stepremarks->update($inputs);
        } else {
            // Create a new record if no existing record is found
            $this->stepRemarks->create([
                'district_id' => $data['district_id'],
                'notes' => $data['notes'],
                'province_id' => $data['province_id'],
                'stage_id' => 2,
                'stage_status' => 1
            ]);
        }
    
        // Loop through target groups to update or create priorities
        for ($i = 0; $i < count($targetGroups); $i++) {
            $inputs = [
                'province_id' => $data['province_id'],
                'district_id' => $data['district_id'],
                'target_group_id' => $targetGroups[$i],
                'thematic_area_id' => $thematicAreas[$i],
                'question_id' => $questions[$i],
                'priority' => $priorities[$i],
            ];
    
            // Check if the record exists
            $existingRecord = $this->priorities
                ->where('district_id','=', $data['district_id'])
                ->where('question_id','=', $questions[$i])
                ->first(); // Use `first()` to get a single record
    
            if ($existingRecord) {
                // Update the existing record
                $existingRecord->update($inputs);
            } else {
                // Create a new record if it doesn't exist
                $this->priorities->create($inputs);
            }
        }
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Priorities have been successfully saved.');
    }
    

    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $did = $id;        
        $stepRemarks = $this->stepRemarks->where('district_id', '=', $did)->where('stage_id', '=', 2)->first();

        // Fetch district profile
        $districtprofile = $this->districts->with(['province'])->find($did);
        $districtVulnerability = $this->vulnerability->where('district_id', $did)->get();
        $statuses = $this->getStatuses($did);
        // Check if district_vulnerability is empty
        if ($districtVulnerability->isEmpty()) {
            return redirect()->route('dataentrystage.create', ['stageId' => 1, 'did' => $did]); // Replace 'another.route.name' with the actual route name
        }
        $province_id = $districtprofile->province->id;

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
            // return response()->json(['data' => $priorities  ], 422);
        // Return view response if $prioritystatus is not true
        return view('Report::Priorities.edit')
            ->withDistrictprofile($districtprofile)
            ->withDistrictVulnerability($districtVulnerability)
            ->withIr1status($statuses['ir1status'])
            ->withQuestions($questions)
            ->withStepRemarks($stepRemarks)
            ->withPriorities($priorities);

       
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
               
        // Retrieve the priority being updated
        $priorityToUpdate = $this->priorities->find($id);



        // Count the number of priorities with the same district_id
        $priorityCount = $this->priorities
            ->where('district_id', '=', $priorityToUpdate->district_id)
            ->where('priority', '=', 1)
            ->count();



        // Check if the number of priorities is less than or equal to five
        if ($request->input('priority') == 1 && $priorityCount >= 5) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'The number of priorities for this district exceeds the limit of five.');
        }

        // Proceed with the update
        $priorities = $this->priorities->update($id, $request->except('id'));

        if ($priorities) {
            return redirect()->back()->with('success', 'Priorities Updated successfully!');
        }

        // If update fails, redirect back with an error message
        return redirect()->back()->with('error', 'Priorities cannot be updated.');
    }


    public function updateBydistrict(UpdateRequest $request, $id)
    {
                
   
        // Retrieve the priority being updated
        $priorityToUpdate = $this->priorities->find($id);



        // Count the number of priorities with the same district_id
        $priorityCount = $this->priorities
            ->where('district_id', '=', $priorityToUpdate->district_id)
            ->where('priority', '=', 1)
            ->count();



        // Check if the number of priorities is less than or equal to five
        if ($request->input('priority') == 1 && $priorityCount >= 5) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'The number of priorities for this district exceeds the limit of five.');
        }

        // Proceed with the update
        $priorities = $this->priorities->update($id, $request->except('id'));

        if ($priorities) {
            return redirect()->back()->with('success', 'Priorities Updated successfully!');
        }

        // If update fails, redirect back with an error message
        return redirect()->back()->with('error', 'Priorities cannot be updated.');
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
        $flag = $this->priorities->destroy($id);
        if ($flag) {
            return redirect()->back()->with('success', 'Priorities has been deleted.');
        }
        return response()->json([
            'type' => 'error',
            'message' => 'District can not deleted.',
        ], 422);
    }
}
