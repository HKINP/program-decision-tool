<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ActivitiesAttributeDataRepository;
use Modules\Configuration\Requests\ActivitiesAttributeData\StoreRequest;
use Modules\Configuration\Requests\ActivitiesAttributeData\UpdateRequest;

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
       $data=$request->all();
     
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
            return redirect()->route('indicators.index')->with('success', 'Indicator added successfully!');
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
        dd('here');

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
        // $this->authorize('manage-account-code');


        $activitiesAttributeData = $this->actors->update($id, $request->except('id'));

        if ($actors) {
            return redirect()->route('actors.index')->with('success', 'Actors Updated successfully!');
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Actors can not be updated.'
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
