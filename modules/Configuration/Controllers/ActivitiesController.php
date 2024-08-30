<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ActivitiesRepository;
use Modules\Configuration\Repositories\OutcomesRepository;
use Modules\Configuration\Requests\Activities\StoreRequest;
use Modules\Configuration\Requests\Activities\UpdateRequest;
use App\Constants;

class ActivitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  PlatformsRepository $districts
     * @return void
     */
    protected $activities, $outcomes;


    public function __construct(
        ActivitiesRepository $activities,
        OutcomesRepository $outcomes

    ) {
        $this->activities = $activities;
        $this->outcomes = $outcomes;
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
        $activities = $this->activities->with(['outcomes'])->orderby('id', 'asc')->get();

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
            ->withActivities($activities);
    }


    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $outcomes = $this->outcomes->all()->pluck('outcome', 'id')->toArray();

        $ir = Constants::IR;
        $partners = Constants::PARTNERS;
        return view('Configuration::Activities.create')
            ->withIr($ir)
            ->withPartners($partners)
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
        try {
            // Exclude 'partner' from the input and process it separately
            $input = $request->except('partner');
            $partnerCsv = implode(',', $request['partner']);
            $input['partner'] = $partnerCsv;

            // Attempt to create the activity
            $activities = $this->activities->create($input);

            // If successful, redirect with a success message
            if ($activities) {
                return redirect()->route('activities.index')->with('success', 'Added Activities successfully!');
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

        // Find the activity by ID
        $activity = $this->activities->find($id);

        // Convert the comma-separated partner string into an array
        $partnerArray = explode(',', $activity->partner);

        // Replace the partner field in the activity with the array
        $activity->partner = $partnerArray;

        return view('Configuration::Activities.edit')
            ->withActivities($activity)
            ->withIr($ir)
            ->withPartners($partners)
            ->withActivitiesList($outcomes);
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
            $data = $request->except('partner');

            // Convert the 'partner' array to a comma-separated string
            $partnerCsv = implode(',', $request['partner']);
            $data['partner'] = $partnerCsv;

            // Attempt to update the activity
            $activities = $this->activities->find($id);

            if (!$activities) {
                return redirect()->back()->with('error', 'Activity not found.');
            }

            $activities->update($data);

            // If successful, redirect with a success message
            return redirect()->route('activities.index')->with('success', 'Activities updated successfully!');
        } catch (\Exception $e) {
            // Handle any errors that occur during the update
            return redirect()->back()->with('error', 'Failed to update activities: ' . $e->getMessage());
        }
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
