<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ActivitiesRepository;
use Modules\Configuration\Repositories\OutcomesRepository;
use Modules\Configuration\Requests\Activities\StoreRequest;
use Modules\Configuration\Requests\Activities\UpdateRequest;
use App\Constants;
use Modules\Configuration\Repositories\DistrictRepository;
use Modules\Configuration\Repositories\ProvinceRepository;

class ActivitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  PlatformsRepository $districts
     * @return void
     */
    protected $activities, $outcomes, $provinces, $districts;


    public function __construct(
        ActivitiesRepository $activities,
        OutcomesRepository $outcomes,
        ProvinceRepository $provinces,
        DistrictRepository $districts

    ) {
        $this->activities = $activities;
        $this->outcomes = $outcomes;
        $this->districts = $districts;
        $this->provinces = $provinces;
    }

    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $activitytype = Constants::ACTIVITIESTYPE;
        $activities = $this->activities->with(['outcomes'])->orderby('activity_type', 'asc')->get();

        // Convert comma-separated partner values into text
        $activities->transform(function ($activity) use ($partners) {
            // Split the comma-separated partner values
            $partnerIds = explode(',', $activity->partner);

            // Replace the IDs with the corresponding text values from the PARTNERS constant
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);

            // Join the partner names back into a string
            $activity->partner = implode(', ', $partnerNames);

            return $activity;
        });

        return view('Configuration::Activities.index')
            ->withIr($ir)
            ->withPartners($partners)
            ->withImplementor($implementor)
            ->withActivityTypeid(0)
            ->withActivityTypes($activitytype)
            ->withActivities($activities);
    }
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function workPlan()
    {
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $activitytype = Constants::ACTIVITIESTYPE;
        $provinces = $this->provinces->get();
        $programactivities = $this->activities->where('activity_type', '=', 1)->orderby('id', 'asc')->get();
        $financeandoperation = $this->activities->where('activity_type', '=', 2)->orderby('id', 'asc')->get();

        $programactivities->transform(function ($activity) use ($partners, $implementor, $activitytype, $provinces) {
            // Transform partners
            $partnerIds = explode(',', $activity->partner);
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);
            $activity->partner = implode(', ', $partnerNames);

            // Transform implementors
            $implementorIds = explode(',', $activity->implemented_by);
            $implementorNames = array_map(function ($id) use ($implementor) {
                return $implementor[$id] ?? $id; // Use the ID if no matching implementor is found
            }, $implementorIds);
            $activity->implemented_by = implode(', ', $implementorNames);

            // Count provinces
            $provinceIds = $activity->province_ids ? explode(',', $activity->province_ids) : [];
            $activity->province_count = count($provinceIds);
            // Count districts
            $districtIds = $activity->district_ids ? explode(',', $activity->district_ids) : [];
            $activity->district_count = count(array_filter($districtIds)); // Filtering out any empty values

            return $activity;
        });
        $budgetPA = $programactivities->sum('total_budget');


        $financeandoperation->transform(function ($activity) use ($partners, $implementor, $activitytype, $provinces) {
            // Transform partners
            $partnerIds = explode(',', $activity->partner);
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);
            $activity->partner = implode(', ', $partnerNames);

            // Transform implementors
            $implementorIds = explode(',', $activity->implemented_by);
            $implementorNames = array_map(function ($id) use ($implementor) {
                return $implementor[$id] ?? $id; // Use the ID if no matching implementor is found
            }, $implementorIds);
            $activity->implemented_by = implode(', ', $implementorNames);

            // Count provinces
            $provinceIds = $activity->province_ids ? explode(',', $activity->province_ids) : [];
            $activity->province_count = count($provinceIds);
            // Count districts
            $districtIds = $activity->district_ids ? explode(',', $activity->district_ids) : [];
            $activity->district_count = count(array_filter($districtIds)); // Filtering out any empty values

            return $activity;
        });
        $budgetFAO = $financeandoperation->sum('total_budget');
        // dd($programactivities);


        $outcomes = $this->outcomes->with(['activities' => function ($query) {
            $query->where('activity_type', 3);
        }])->get();
        $irOutcomesact = $outcomes->groupBy('ir_id')->map(function ($irOutcomes) use ($partners, $implementor) {
            return $irOutcomes->groupBy('id')->map(function ($outcomeActivities) use ($partners, $implementor) {
                return $outcomeActivities->map(function ($outcome) use ($partners, $implementor) {
                    // Assuming activities is a relationship on outcome
                    $activities = $outcome->activities;

                    // Transform activities within each outcome
                    $transformedActivities = $activities->map(function ($activity) use ($partners, $implementor) {
                        // Transform partners
                        $partnerIds = explode(',', $activity->partner);
                        $partnerNames = array_map(function ($id) use ($partners) {
                            return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
                        }, $partnerIds);
                        $activity->partner = implode(', ', $partnerNames);

                        // Transform implementors
                        $implementorIds = explode(',', $activity->implemented_by);
                        $implementorNames = array_map(function ($id) use ($implementor) {
                            return $implementor[$id] ?? $id; // Use the ID if no matching implementor is found
                        }, $implementorIds);
                        $activity->implemented_by = implode(', ', $implementorNames);

                        // Count provinces
                        $provinceIds = $activity->province_ids ? explode(',', $activity->province_ids) : [];
                        $activity->province_count = count($provinceIds);
                        // Count districts
                        $districtIds = $activity->district_ids ? explode(',', $activity->district_ids) : [];
                        $activity->district_count = count(array_filter($districtIds)); // Filtering out any empty values

                        return $activity;
                    });

                    // Optionally, if you need to return the transformed outcome
                    $outcome->activities = $transformedActivities;

                    return [
                        'outcome' => $outcome->toArray(),
                    ];
                });
            });
        });
        // return response()->json(['status' => 'ads', 'data' => $irOutcomesact], 200);

        return view('Report::Workplan.index')
            ->withIr($ir)
            ->withProvinces($provinces)
            ->withPartners($partners)
            ->withImplementor($implementor)
            ->withActivityTypes($activitytype)
            ->withBudgetPA($budgetPA)
            ->withBudgetFAO($budgetFAO)
            ->withIrOutcomes($irOutcomesact)
            ->withFinanceandoperation($financeandoperation)
            ->withProgramactivities($programactivities);
    }


    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $outcomes = $this->outcomes->all()->pluck('outcome', 'id')->toArray();
        $activity_id = $request->query('activity_id');

        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $year = Constants::Year;
        $activityTypes  = Constants::ACTIVITIESTYPE;

        if ($activity_id !== null && isset($activityTypes[$activity_id])) {
            $activitytype = [
                $activity_id => $activityTypes[$activity_id]
            ];
    }else {
        $activitytype = $activityTypes;
    }

        $months = Constants::MONTHS;
        $districts = $this->districts->all();
        $provinces = $this->provinces->all();
        return view('Configuration::Activities.create')
            ->withIr($ir)
            ->withPartners($partners)
            ->withImplementor($implementor)
            ->withYear($year)
            ->withActivitytype($activitytype)
            ->withDistricts($districts)
            ->withProvinces($provinces)
            ->withMonths($months)
            ->withOutcomes($outcomes);
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

        // dd($request->all());
        try {
            // Exclude 'partner' from the input and process it separately
            $input = $request->except(['partner', 'implemented_by', 'month', 'province_id', 'district_id']);
            $input['partner'] = implode(',', $request->input('partner', []));
            $input['implemented_by'] = implode(',', $request->input('implemented_by', []));
            $input['months'] = implode(',', $request->input('months', []));
            $input['province_ids'] = implode(',', $request->input('province_ids', []));
            $input['district_ids'] = implode(',', $request->input('district_ids', []));

            // Attempt to create the activity

            $activities = $this->activities->create($input);

            // If successful, redirect with a success message
            if ($activities) {

                $message = "Added Activities successfully!";
                return $this->redirectBasedOnActivityType($activities, $message);
            }
        } catch (\Exception $e) {
            // If an error occurs, redirect back with the error message
            return redirect()->back()->with('error', 'Failed to add Activities: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activities = $this->activities->find($id);

        return response()->json(['status' => 'ok', 'actors' => $activities], 200);
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
        // Fetch the necessary data
        $outcomes = $this->outcomes->all()->pluck('outcome', 'id')->toArray();
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $activitytype = Constants::ACTIVITIESTYPE;
        $implementor = Constants::IMPLEMENTOR;
        $year = Constants::Year;
        $months = Constants::MONTHS;
        $activity = $this->activities->find($id);

        // Convert CSV strings to arrays with fallback for null values
        $activity->partner = explode(',', $activity->partner ?? '');
        $activity->implemented_by = explode(',', $activity->implemented_by ?? '');
        $activity->months = explode(',', $activity->months ?? '');
        $activity->province_ids = explode(',', $activity->province_ids ?? '');
        $activity->district_ids = explode(',', $activity->district_ids ?? '');

        $districts = $this->districts->all();
        $provinces = $this->provinces->all();

        return view('Configuration::Activities.edit')
            ->withActivity($activity)
            ->withActivitytype($activitytype)
            ->withIr($ir)
            ->withYear($year)
            ->withDistricts($districts)
            ->withProvinces($provinces)
            ->withPartners($partners)
            ->withImplementor($implementor)
            ->withMonths($months)
            ->withOutcomes($outcomes);
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
        try {
            // Prepare the data except for 'partner'
            $input = $request->except(['partner', 'implemented_by', 'month', 'province_id', 'district_id']);
            $activitytype = $input['activity_type'] ?? '';
            if ($activitytype != 3) {
                $input['ir_id']  = null;
                $input['outcomes_id']  = null;
            }

            // Convert the 'partner' array to a comma-separated string
            $input['partner'] = implode(',', $request->input('partner', []));
            $input['implemented_by'] = implode(',', $request->input('implemented_by', []));
            $input['months'] = implode(',', $request->input('months', []));
            $input['province_ids'] = implode(',', $request->input('province_ids', []));
            $input['district_ids'] = implode(',', $request->input('district_ids', []));

            // Attempt to update the activity
            $activities = $this->activities->find($id);

            if (!$activities) {
                return redirect()->back()->with('error', 'Activity not found.');
            }

            $activities->update($input);
            $message = "Activities updated successfully!";
            return $this->redirectBasedOnActivityType($activities, $message);
        } catch (\Exception $e) {
            // Handle any errors that occur during the update
            return redirect()->back()->with('error', 'Failed to update activities: ' . $e->getMessage());
        }
    }
    private function redirectBasedOnActivityType($activity, $message)
    {
        switch ($activity->activity_type) {
            case 1:
                $route = 'activities.program';
                break;
            case 2:
                $route = 'activities.finance';
                break;
            case 3:
                $route = 'activities.ir';
                break;
            case 4:
                $route = 'activities.gid';
                break;
            case 5:
                $route = 'activities.merl';
                break;
            case 6:
                $route = 'activities.rsr';
                break;
            case 7:
                $route = 'activities.diverse';
                break;
            case 8:
                $route = 'activities.sbcc';
                break;

            default:
                $route = 'activities.index'; // Default route if activity_type doesn't match any case
                break;
        }

        return redirect()->route($route)->with('success', $message);
    }

    public function programActivities()
    {
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $activitytype = Constants::ACTIVITIESTYPE;
        $activities = $this->activities->with(['outcomes'])->where('activity_type', 1)->orderby('id', 'asc')->get();

        // Convert comma-separated partner values into text
        $activities->transform(function ($activity) use ($partners) {
            // Split the comma-separated partner values
            $partnerIds = explode(',', $activity->partner);

            // Replace the IDs with the corresponding text values from the PARTNERS constant
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);

            // Join the partner names back into a string
            $activity->partner = implode(', ', $partnerNames);

            return $activity;
        });

        return view('Configuration::Activities.index')
            // ->withIr($ir)
            ->withPartners($partners)
            ->withImplementor($implementor)
            // ->withActivityTypes($activitytype)
            ->withActivityType($activitytype[1])
            ->withActivityTypeid(1)
            ->withActivities($activities);
    }

    public function irActivities()
    {
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $activitytype = Constants::ACTIVITIESTYPE;
        $activities = $this->activities->with(['outcomes'])->where('activity_type', 3)->orderby('id', 'asc')->get();

        // Convert comma-separated partner values into text
        $activities->transform(function ($activity) use ($partners) {
            // Split the comma-separated partner values
            $partnerIds = explode(',', $activity->partner);

            // Replace the IDs with the corresponding text values from the PARTNERS constant
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);

            // Join the partner names back into a string
            $activity->partner = implode(', ', $partnerNames);

            return $activity;
        });

        return view('Configuration::Activities.index')
            ->withIr($ir)
            ->withPartners($partners)
            ->withImplementor($implementor)
            // ->withActivityTypes($activitytype)
            ->withActivityType($activitytype[3])
            ->withActivityTypeid(3)
            ->withActivities($activities);
    }

    public function financeActivities()
    {
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $activitytype = Constants::ACTIVITIESTYPE;
        $activities = $this->activities->with(['outcomes'])->where('activity_type', 2)->orderby('id', 'asc')->get();

        // Convert comma-separated partner values into text
        $activities->transform(function ($activity) use ($partners) {
            // Split the comma-separated partner values
            $partnerIds = explode(',', $activity->partner);

            // Replace the IDs with the corresponding text values from the PARTNERS constant
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);

            // Join the partner names back into a string
            $activity->partner = implode(', ', $partnerNames);

            return $activity;
        });

        return view('Configuration::Activities.index')
            // ->withIr($ir)
            ->withPartners($partners)
            ->withImplementor($implementor)
            // ->withActivityTypes($activitytype)
            ->withActivityType($activitytype[2])
            ->withActivityTypeid(2)
            ->withActivities($activities);
    }

    public function gidActivities()
    {
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $activitytype = Constants::ACTIVITIESTYPE;
        $activities = $this->activities->with(['outcomes'])->where('activity_type', 4)->orderby('id', 'asc')->get();

        // Convert comma-separated partner values into text
        $activities->transform(function ($activity) use ($partners) {
            // Split the comma-separated partner values
            $partnerIds = explode(',', $activity->partner);

            // Replace the IDs with the corresponding text values from the PARTNERS constant
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);

            // Join the partner names back into a string
            $activity->partner = implode(', ', $partnerNames);

            return $activity;
        });

        return view('Configuration::Activities.index')
            // ->withIr($ir)
            ->withPartners($partners)
            ->withImplementor($implementor)
            // ->withActivityTypes($activitytype)
            ->withActivityType($activitytype[4])
            ->withActivityTypeid(4)
            ->withActivities($activities);
    }

    public function merlActivities()
    {
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $activitytype = Constants::ACTIVITIESTYPE;
        $activities = $this->activities->with(['outcomes'])->where('activity_type', 5)->orderby('id', 'asc')->get();

        // Convert comma-separated partner values into text
        $activities->transform(function ($activity) use ($partners) {
            // Split the comma-separated partner values
            $partnerIds = explode(',', $activity->partner);

            // Replace the IDs with the corresponding text values from the PARTNERS constant
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);

            // Join the partner names back into a string
            $activity->partner = implode(', ', $partnerNames);

            return $activity;
        });

        return view('Configuration::Activities.index')
            // ->withIr($ir)
            ->withPartners($partners)
            ->withImplementor($implementor)
            // ->withActivityTypes($activitytype)
            ->withActivityType($activitytype[5])
            ->withActivityTypeid(5)
            ->withActivities($activities);
    }

    public function rsrActivities()
    {
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $activitytype = Constants::ACTIVITIESTYPE;
        $activities = $this->activities->with(['outcomes'])->where('activity_type', 6)->orderby('id', 'asc')->get();

        // Convert comma-separated partner values into text
        $activities->transform(function ($activity) use ($partners) {
            // Split the comma-separated partner values
            $partnerIds = explode(',', $activity->partner);

            // Replace the IDs with the corresponding text values from the PARTNERS constant
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);

            // Join the partner names back into a string
            $activity->partner = implode(', ', $partnerNames);

            return $activity;
        });

        return view('Configuration::Activities.index')
            // ->withIr($ir)
            ->withPartners($partners)
            ->withImplementor($implementor)
            // ->withActivityTypes($activitytype)
            ->withActivityType($activitytype[6])
            ->withActivityTypeid(6)
            ->withActivities($activities);
    }

    public function diverseActivities()
    {
        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        $implementor = Constants::IMPLEMENTOR;
        $activitytype = Constants::ACTIVITIESTYPE;
        $activities = $this->activities->with(['outcomes'])->where('activity_type', 7)->orderby('id', 'asc')->get();

        // Convert comma-separated partner values into text
        $activities->transform(function ($activity) use ($partners) {
            // Split the comma-separated partner values
            $partnerIds = explode(',', $activity->partner);

            // Replace the IDs with the corresponding text values from the PARTNERS constant
            $partnerNames = array_map(function ($id) use ($partners) {
                return $partners[$id] ?? $id; // Use the ID if no matching partner name is found
            }, $partnerIds);

            // Join the partner names back into a string
            $activity->partner = implode(', ', $partnerNames);

            return $activity;
        });

        return view('Configuration::Activities.index')
            // ->withIr($ir)
            ->withPartners($partners)
            ->withImplementor($implementor)
            // ->withActivityTypes($activitytype)
            ->withActivityType($activitytype[7])
            ->withActivityTypeid(7)
            ->withActivities($activities);
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
        $flag = $this->activities->destroy($id);
        if ($flag) {
            return redirect()->route('activities.index')->with('success', 'Activities is successfully deleted.');
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Actors can not deleted.',
        ], 422);
    }
}
