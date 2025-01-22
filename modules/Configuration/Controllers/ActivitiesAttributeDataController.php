<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ActivitiesAttributeDataRepository;
use Modules\Configuration\Requests\ActivitiesAttributeData\StoreRequest;
use Modules\Configuration\Requests\ActivitiesAttributeData\UpdateRequest;
use App\Constants;

class ActivitiesAttributeDataController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  PlatformsRepository $districts
     * @return void
     */
    protected $activitiesAttributeData;


    public function __construct(
        ActivitiesAttributeDataRepository $activitiesAttributeData

    ) {
        $this->activitiesAttributeData = $activitiesAttributeData;
    }

    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {

        //    $actors=$this->actors->with(['parents'])->orderby('id', 'asc')->where('id','!=',1)->get();
        //          return view('Configuration::Actors.index')
        //         ->withActors($actors);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $actors = $this->actors->all()->pluck('actors', 'id')->toArray();
        // return view('Configuration::Actors.create')
        // ->withActors($actors);
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

        // Prepare the attributes data as a JSON object
        $attributesData = json_encode($data['attributes']); // Convert the attributes array to JSON

        // Create the main activity attribute data record
        $activitiesAttributeData = $this->activitiesAttributeData->create([
            'activity_id' => $data['activity_id'],
            'event_date' => $data['event_date'],
            'event_location' => $data['event_location'],
            'province_id' => $data['province_id'],
            'district_id' => $data['district_id'],
            'attributes_data' => $attributesData,  // Store the attributes as JSON
        ]);

        // Check if the record was created successfully
        if ($activitiesAttributeData) {
            return redirect()->route('activities.attributes.view',$data['activity_id'])->with('success', 'Activities attributes added successfully!');
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
        $attributedata = $this->activitiesAttributeData->with([
            'province',
            'district',
            'activity',
            'activity.outcomes',
            'activity.outcomes'
        ])
            ->where("activity_id", '=', $id)->get();
        $attributes = Constants::ATTRIBUTES;
        // return response()->json([
        //     'data' => $attributedata,
        //     'message' => 'Actors can not be updated.'
        // ], 422);

        return view('Configuration::Activities.AttributeData.view')
            ->withAttributes($attributes)
            ->withAttributedata($attributedata);
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
        $actors = $this->actors->all()->pluck('actors', 'id')->toArray();
        return view('Configuration::Actors.edit')
            ->withActors($this->actors->find($id))
            ->withActorsList($actors);
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
        $data=$request->all();
        // Prepare the attributes data as a JSON object
        $attributesData = json_encode($data['attributes']); // Convert the attributes array to JSON

        // Find the existing record to update
        $activitiesAttributeData = $this->activitiesAttributeData->find($id); // Use the record ID from $data

        if ($activitiesAttributeData) {
            // Update the record with new data
            $updated = $activitiesAttributeData->update([
                'activity_id' => $data['activity_id'],
                'event_date' => $data['event_date'],
                'event_location' => $data['event_location'],
                'province_id' => $data['province_id'],
                'district_id' => $data['district_id'],
                'attributes_data' => $attributesData, // Update the attributes as JSON
            ]);

            // Check if the update was successful
            if ($updated) {
                return redirect()->route('activities.attributes.view',$data['activity_id'])->with('success', 'Activities Attributes updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to update attributes: ' . $e->getMessage());
            }
        } else {
            return redirect()->route('indicators.index')->with('error', 'Record not found.');
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
        $flag = $this->actors->destroy($id);
        if ($flag) {
            return redirect()->route('actors.index')->with('success', 'Actors is successfully deleted.');
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Actors can not deleted.',
        ], 422);
    }
}
