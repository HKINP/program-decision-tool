<?php

namespace Modules\Report\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Configuration\Repositories\ActivitiesRepository;
use Modules\Configuration\Repositories\DistrictRepository;
use Modules\Configuration\Repositories\OutcomesRepository;
use Modules\Configuration\Repositories\PlatformsRepository;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Configuration\Repositories\QuestionRepository;
use Modules\Report\Repositories\DistrictVulnerabilityRepository;
use Modules\Report\Repositories\KeyBarrierRepository;
use Modules\Report\Repositories\PrioritizedActivitiesRepository;
use Modules\Report\Repositories\PriorityRepository;
use Modules\Report\Repositories\StepRemarksRepository;
use Modules\Report\Requests\PrioritizedActivities\StoreRequest;
use Modules\Report\Requests\PrioritizedActivities\UpdateRequest;
use App\Constants;

class PrioritizedActivitiesController extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @param  DistrictRepository $districts
     * @return void
     */
    protected $mapactivities, $districts, $provinces, $priorities, $outcomes,
        $questions, $prioritizedactivities, $stepRemarks, $vulnerability, $keyBarriers, $platforms;

    public function __construct(

        DistrictRepository $districts,
        ProvinceRepository $provinces,
        PriorityRepository $priorities,
        QuestionRepository $questions,
        PrioritizedActivitiesRepository $prioritizedactivities,
        StepRemarksRepository $stepRemarks,
        DistrictVulnerabilityRepository $vulnerability,
        ActivitiesRepository $mapactivities,
        KeyBarrierRepository $keyBarriers,
        PlatformsRepository $platforms,
        OutcomesRepository $outcomes,

    ) {
        $this->districts = $districts;
        $this->provinces = $provinces;
        $this->priorities = $priorities;
        $this->questions = $questions;
        $this->prioritizedactivities = $prioritizedactivities;
        $this->vulnerability = $vulnerability;
        $this->stepRemarks = $stepRemarks;
        $this->mapactivities = $mapactivities;
        $this->keyBarriers = $keyBarriers;
        $this->platforms = $platforms;
        $this->outcomes = $outcomes;
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
                ->with(['targetGroup', 'thematicArea', 'indicator', 'activity'])
                ->where('district_id', $did)
                ->where('stage_id', $stageId)
                ->get();

            //  return response()->json(['status'=>'ads','data'=>$prioritizedActivities], 200);
            foreach ($prioritizedActivities as $activity) {
                $activity->platforms; // This will trigger the accessor and load related platforms

            }
            // Group activities by 'targeted_for'
            $groupedActivities = $prioritizedActivities->groupBy('targeted_for');
            $allActivities = $groupedActivities->get('All', collect()); // Default to empty collection
            $vulnerableActivities = $groupedActivities->get('Vulnerable', collect()); // Default to empty collection


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
            $keybarrier = $this->keyBarriers->with(['indicator'])->where('district_id', '=', $did)->where('stage_id', $stageId)->get();


            // Return the view with data
            return view($view)
                ->withDistrictprofile($districtprofile)
                ->withDistrictVulnerability($districtVulnerability)
                ->withAllActivities($allActivities)
                ->withVulnerableActivities($vulnerableActivities)
                ->withKeybarriers($keybarrier)
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
    // public function store(Request $request)
    // {
    //     $data = $request->all();
    //     $did = $data['district_id'];
    //     $stageid = $data['stage_id'];

    //     // Extract common data
    //     $commonInputs = [
    //         'province_id' => $data['province_id'],
    //         'district_id' => $did,
    //         'notes' => $data['notes'],
    //         'stage_id' => $stageid,
    //     ];

    //     // Process specific data based on stage_id
    //     if ($stageid == 6) {
    //         $activity_id = $data['activity_id'];
    //         $platforms_id = $data['platforms_id'];
    //         $targeted_for = $data['targeted_for'];
    //         $remarksdata = $data['remarks'];
    //     } else {
    //         $proposed_activities = $data['proposed_activities'];
    //         $targeted_for = $data['targeted_for'];
    //         $platforms_id = $data['platforms_id'];
    //         $remarksdata = $data['remarks'];
    //         $indicator_id = $data['indicator_id'];
    //         $keybarrier = $data['key_barriers'];
    //     }

    //     $groupedPlatforms = [];
    //     foreach ($platforms_id as $key => $platformsArray) {
    //         array_push($groupedPlatforms, $platformsArray);
    //     }

    //     // Handle existing record or create a new one
    //     $stepremarks = $this->stepRemarks->where('stage_id', '=', $stageid)->first();
    //     if ($stepremarks) {
    //         $this->stepRemarks->update($stepremarks->id, $commonInputs);
    //     } else {
    //         $this->stepRemarks->create($commonInputs);
    //     }

    //     // Determine the count and iterate over activities
    //     $activities = $stageid == 6 ? $activity_id : $proposed_activities;
    //     for ($i = 0; $i < count($activities); $i++) {
    //         $platforms = implode(',', $groupedPlatforms[$i]);

    //         $keybarrierInputs = [
    //             'key_barrier' => $keybarrier[$i],
    //             'stage_id' => $stageid,
    //             'district_id' => $did,
    //             'province_id' => $data['province_id'],
    //             'indicator_id' => $indicator_id[$i] ?? null,
    //         ];


    //         $keybarrier = $this->keyBarriers->create($keybarrierInputs);

    //         $inputs = [
    //             'province_id' => $data['province_id'],
    //             'district_id' => $data['district_id'],
    //             'stage_id' => $data['stage_id'],
    //             'target_group_id' => $data['target_group_id'] ?? null,
    //             'thematic_area_id' => $data['thematic_area_id'] ?? null,
    //             'indicator_id' => $indicator_id[$i] ?? null,
    //             'proposed_activities' => $proposed_activities[$i] ?? '',
    //             'targeted_for' => $targeted_for[$i],
    //             'platforms_id' => $platforms,
    //             'activity_id' => $activity_id[$i] ?? null,
    //             'remarks' => $remarksdata[$i],
    //         ];
    //         $this->prioritizedactivities->create($inputs);
    //     }

    //     // Redirect or return response
    //     return redirect()->route('prioritizedActivities.index', ['stageId' => $stageid, 'did' => $did])
    //         ->with('success', 'Activities added successfully!');
    // }
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $did = $data['district_id'];
            $stageid = $data['stage_id'];
            $keyBarriersAdded = false;
            $activitiesAdded = false;

            // Handle Key Barriers
            if (isset($data['key_barriers_id']) && $data['key_barriers_id']) {
                $id = $data['key_barriers_id'];
                $inputs = ['key_barriers' => $data['key_barriers']];
                $this->keyBarriers->update($id, $inputs);
                $keyBarriersUpdated = true;
            } elseif (!empty($data['key_barriers'])) {
                $keybarrierInputs = [
                    'key_barriers' => $data['key_barriers'],
                    'stage_id' => $stageid,
                    'district_id' => $did,
                    'province_id' => $data['province_id'],
                    'indicator_id' => $data['indicator_id'],
                ];
                $this->keyBarriers->create($keybarrierInputs);
                $keyBarriersAdded = true;
            }

            // Handle Activities
            if ((isset($data['proposed_activities']) && !empty($data['proposed_activities'])) || (isset($data['activity_id']) && !empty($data['activity_id']))) {
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
                }

                $groupedPlatforms = [];
                foreach ($platforms_id as $key => $platformsArray) {
                    array_push($groupedPlatforms, $platformsArray);
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
                        'indicator_id' => $data['indicator_id'] ?? null,
                        'proposed_activities' => $proposed_activities[$i] ?? '',
                        'targeted_for' => $targeted_for[$i],
                        'platforms_id' => $platforms,
                        'activity_id' => $activity_id[$i] ?? null,
                        'remarks' => $remarksdata[$i],
                    ];

                    try {
                        $this->prioritizedactivities->create($inputs);
                        $activitiesAdded = true;
                    } catch (\Exception $e) {
                        \Log::error('Error creating prioritized activities: ' . $e->getMessage());
                        return redirect()->back()->with('error', 'An error occurred while creating prioritized activities. Please try again.');
                    }
                }
            }

            // Determine success message based on what was added
            if ($keyBarriersAdded && $activitiesAdded) {
                return redirect()->back()->with('success', 'Key Barriers and Activities added successfully!');
            } elseif ($keyBarriersAdded) {
                return redirect()->back()->with('success', 'Key Barriers added successfully!');
            } elseif ($keyBarriersUpdated) {
                return redirect()->back()->with('success', 'Key Barriers Updated successfully!');
            } elseif ($activitiesAdded) {
                return redirect()->back()->with('success', 'Activities added successfully!');
            } else {
                return redirect()->back()->with('success', 'No Key Barriers or Activities were added.');
            }
        } catch (\Exception $e) {
            // Log the error message
            \Log::error('Error in storing activities: ' . $e->getMessage());

            // Redirect or return an error response
            return redirect()->back()->with('error', 'An error occurred while adding activities. Please try again.');
        }
    }

    public function stepRemarksadd(Request $request)
    {
        try {
            $data = $request->all();
            $data['stage_status'] = 1;

            // Fetch the step remark for the given district and stage
            $stepRemark = $this->stepRemarks
                ->where('district_id', '=', $data['district_id'])
                ->where('stage_id', '=', $data['stage_id'])
                ->first();

            // If stepRemark exists, update it; otherwise, create a new one
            if ($stepRemark) {
                $this->stepRemarks->update($stepRemark->id, $data);
            } else {
                $this->stepRemarks->create($data);
            }

            return redirect()->route('prioritizedActivities.index', [
                'stageId' => $data['stage_id'],
                'did' => $data['district_id']
            ])->with('success', 'Activities updated successfully!');
        } catch (\Exception $e) {
            // Handle the exception (e.g., log it, display an error message)
            return redirect()->back()->withErrors('An error occurred while adding activities.');
        }
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
        $activityId = $data['activity_id'];
        $id = $data['id'];
        $districtId = $data['district_id'];

        // Check if the record exists with both activity_id and district_id
        $existingRecord = $this->prioritizedactivities
            ->where('id', '=', $id)
            ->where('district_id', '=', $districtId)
            ->first();

        if ($existingRecord) {
            // If the record exists, update it
            $inputs = [
                'activity_id' => $activityId,
                'year' => $request->input('year'),
                'months' => json_encode($request->input('months')),
                'total_target' => $request->input('total_target'),
            ];

            $this->prioritizedactivities->update($existingRecord->id, $inputs);

            return redirect()->route('compiledreport.district', ['did' => $districtId])
                ->with('success', 'Activities updated successfully!');
        } else {
            // Handle the case where the record doesn't exist
            return redirect()->back()->with('error', 'Record not found for the given activity and district.');
        }
    }

    public function rollbackactivityMapping(Request $request, $id)
    {
       
       
        // Retrieve the existing record
        $existingRecord = $this->prioritizedactivities
            ->where('id', '=', $id)
            ->first();

        if ($existingRecord) {
            // Update the existing record to set specific columns to null
            $inputs = [
                'activity_id' =>null,
                'year' => null,
                'months' =>null,
                'total_target' => null,
            ];

            $this->prioritizedactivities->where('id','=', $id)
                ->update($inputs);

            return redirect()->back()->with('success', 'Activity rollback completed successfully!');
        } else {
            // Handle the case where the record doesn't exist
            return redirect()->back()->with('error', 'Record not found for the given activity and district.');
        }
    }


    public function showAddForm(Request $request, $id)
    {
        $prioritizedActivities = $this->prioritizedactivities->find($id);
        $stage_id = $prioritizedActivities->stage_id;

        $ir_id = match ($stage_id) {
            3 => 1,
            4 => 2,
            5 => 3,
            6 => 4,
            default => null, // or handle unexpected stage_id values if needed
        };

        if ($ir_id !== null) {
            $activities = $this->mapactivities->where('ir_id','=', $ir_id)->get();
        } else {
            $activities = collect(); // return an empty collection if ir_id is not set
        }
        $districtprofile = $this->districts
            ->with(['province', 'locallevel'])
            ->find($prioritizedActivities->district_id);

        return view('Report::compiled.mapping')
            ->withDistrictprofile($districtprofile)
            ->withPrioritizedActivities($prioritizedActivities)
            ->withId($id)
            ->withActivities($activities);
    }


    // Method to show the form for editing activities
    public function showEditForm(Request $request, $id)
    {
      $prioritizedActivities = $this->prioritizedactivities->find($id);
        $stage_id = $prioritizedActivities->stage_id;

        $ir_id = match ($stage_id) {
            3 => 1,
            4 => 2,
            5 => 3,
            6 => 4,
            default => null, // or handle unexpected stage_id values if needed
        };

        if ($ir_id !== null) {
            $activities = $this->mapactivities->where('ir_id','=', $ir_id)->get();
        } else {
            $activities = collect(); // return an empty collection if ir_id is not set
        }
        $districtprofile = $this->districts
            ->with(['province', 'locallevel'])
            ->find($prioritizedActivities->district_id);

        return view('Report::compiled.mapping')
            ->withDistrictprofile($districtprofile)
            ->withPrioritizedActivities($prioritizedActivities)
            ->withId($id)
            ->withActivities($activities);
    }

    // Method to show the form for rollback activities
    public function showRollbackForm(Request $request, $id)
    {
        $districtId = $request->input('district_id');
    }

    public function edit($id)
    {
        $data = $this->prioritizedactivities->find($id);
        $stageId = $data->stage_id;
        $platforms = $this->platforms->get();
        $activities = $this->mapactivities->where('ir_id', '=', 4)->get();

        switch ($stageId) {
            case 3:
                $title = "Step 3. SBC Activities (IR1)";
                break;
            case 4:

                $title = "Step 4. Health and Nutrition Service Activities (IR2)";
                break;
            case 5:

                $title = "Step 5. Food Systems Activities (IR3)";
                break;
            case 6:

                $title = "Step 6. Enabling Environment Activities(IR4)";
                break;
            default:

                $title = "";
                break;
        }

        return view('Report::edit')->withData($data)
            ->withTitle($title)
            ->withActivities($activities)
            ->withPlatforms($platforms);
    }
    public function update(Request $request, $id)
    {
        // Find the existing prioritized activity by ID
        $prioritizedActivity = $this->prioritizedactivities->find($id);

        if (!$prioritizedActivity) {
            return redirect()->back()->with('error', 'Prioritized activity not found.');
        }

        $did = $prioritizedActivity->district_id;
        $stageId = $prioritizedActivity->stage_id;

        // Define validation rules based on the stage ID
        $rules = [
            'targeted_for' => 'required|string',
            'platforms_id' => 'required|array',
            'remarks' => 'nullable|string',
        ];

        if ($stageId == 6) {
            $rules['activity_id'] = 'required|integer';
        } else {
            $rules['proposed_activities'] = 'required|string';
        }

        // Validate the incoming data
        $request->validate($rules);

        // Convert the platforms_id array into a comma-separated string
        $platforms = implode(',', $request->input('platforms_id'));

        // Prepare data for update
        $data = [
            'targeted_for' => $request->input('targeted_for'),
            'platforms_id' => $platforms,
            'remarks' => $request->input('remarks'),
        ];

        if ($stageId == 6) {
            $data['activity_id'] = $request->input('activity_id');
        } else {
            $data['proposed_activities'] = $request->input('proposed_activities');
        }

        // Update the prioritized activity with the new data
        $prioritizedActivity->update($data);

        // Redirect back with a success message
        return redirect()->route('dataentrystage.create', ['stageId' => $stageId, 'did' => $did])
            ->with('success', 'Prioritized activity updated successfully.');
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
        return view('Report::Compiled.province')
            ->withProvince($province)
            ->withActivities($structuredData);
    }





    public function workPlanReport(Request $request)
    {
        // Retrieve the input parameters
        $districtId = $request->input('did');
        $provinceId = $request->input('pid');
        
         // Assuming provinceId is passed with key 'pid'

        // Define the query
        $query = $this->outcomes->with(['activities' => function ($query) use ($districtId, $provinceId) {
            if ($districtId) {
                // Filter by districtId
                $query->with(['prioritiesActivities' => function ($query) use ($districtId) {
                    $query->where('district_id', $districtId);
                }])->whereHas('prioritiesActivities', function ($query) use ($districtId) {
                    $query->where('district_id', $districtId);
                });
            } elseif ($provinceId) {
                // Filter by provinceId
                $query->whereHas('prioritiesActivities', function ($query) use ($provinceId) {
                    $query->where('province_id', $provinceId);
                });
            }
        }]);
        
        // Execute the query and get results
        $outcomes = $query->get();
        $partners = Constants::PARTNERS;
        $allprovince=$this->provinces->get();
        $province=$this->provinces->where('id','=',$provinceId)->first();
        $districts=$this->districts->get();
        $groupedData = $outcomes->groupBy('ir_id')->map(function ($irOutcomes) use ($partners) {
            return $irOutcomes->groupBy('id')->map(function ($outcomeActivities) use ($partners) {
                return $outcomeActivities->map(function ($outcome) use ($partners) {
                    // Filter activities to only include those with prioritiesActivities
                    $filteredActivities = $outcome->activities->filter(function ($activity) {
                        return $activity->prioritiesActivities->isNotEmpty();
                    });

                    return [
                        'outcome' => $outcome->toArray(),
                        'activities' => $filteredActivities->map(function ($activity) use ($partners) {
                            // Convert partner IDs to partner names
                            $partnerIds = explode(',', $activity->partner); // Split the partner CSV string into an array
                            $partnerNames = array_map(function ($id) use ($partners) {
                                return $partners[$id] ?? 'NA'; // Replace IDs with partner names
                            }, $partnerIds);

                            // Replace the partner IDs with the names in the activity array
                            $activityArray = $activity->toArray();
                            $activityArray['partner'] = implode(', ', $partnerNames);

                            // Group prioritiesActivities by targeted_for
                            $groupedPrioritiesActivities = $activity->prioritiesActivities->groupBy('targeted_for');

                            return [
                                'activity' => $activityArray,
                                'prioritiesActivities' => $groupedPrioritiesActivities->map(function ($group) {
                                    return $group->toArray();
                                })->toArray()
                            ];
                        })->toArray()
                    ];
                });
            });
        });

        $districtprofile = $this->districts
            ->with(['province', 'locallevel'])
            ->find($districtId);
            // return response()->json(['status' => 'ads', 'data' => $groupedData], 200);
        return view('Report::Workplan.district')
            ->withDistrictprofile($districtprofile)
            ->withProvince($province)
            ->withDistricts($districts)
            ->withProvinces($allprovince)
            ->withData($groupedData);
    }

    public function destroy($id)
    {
        // $this->authorize('manage-account-code');
        $flag = $this->prioritizedactivities->destroy($id);
        if ($flag) {
            return redirect()->back()->with('success', 'Sub Activities has been deleted.');
        }

        return redirect()->back()->with('error', 'An error occurred while deleting sub activities. Please try again.');
    }
}
