<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ActivitiesRepository;
use Modules\Configuration\Repositories\OutcomesRepository;
use Modules\Configuration\Requests\Activities\StoreRequest;
use Modules\Configuration\Requests\Activities\UpdateRequest;

class ActivitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  PlatformsRepository $districts
     * @return void
     */
    protected $activities,$outcomes;
    

    public function __construct(
        ActivitiesRepository $activities,
        OutcomesRepository $outcomes

    )
    {
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
       $ir=[
        1=>'IR1. Activities',
        2=>'IR2. Activities',
        3=>'IR3. Activities',
        4=>'IR4. Activities',        
        ] ;
        
       $activities=$this->activities->with(['outcomes'])->orderby('id', 'asc')->get();
       
       return view('Configuration::Activities.index')
            ->withIr($ir)
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
        $ir=[
            1=>'Intermediate Result 1. Improved Household Nutrition Practices',
            2=>'Intermediate Result 2: Improved quality and coverage of nutrition services',
            3=>'Intermediate Result 3: Improved access to safe, diverse, and nutritious foods ',
            4=>'Intermediate Result 4: Strengthened national and subnational government capacity for multi-sectoral nutrition programming',            
            ];
        return view('Configuration::Activities.create')
        ->withIr($ir)
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
        // $this->authorize('manage-account-code');
        $activities = $this->activities->create($request->all());
        if($activities){
            return redirect()->route('activities.index')->with('success', 'Added Activities successfully!');
        }
        return response()->json(['status'=>'error',
            'message'=>'Platforms can not be added.'], 422);
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
        return response()->json(['status'=>'ok','actors'=>$activities], 200);
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
        $outcomes = $this->outcomes->all()->pluck('outcome', 'id')->toArray();
        $ir=[
            1=>'Intermediate Result 1. Improved Household Nutrition Practices',
            2=>'Intermediate Result 2: Improved quality and coverage of nutrition services',
            3=>'Intermediate Result 3: Improved access to safe, diverse, and nutritious foods ',
            4=>'Intermediate Result 4: Strengthened national and subnational government capacity for multi-sectoral nutrition programming',            
            ];
            
        return view('Configuration::Activities.edit')
            ->withActivities($this->activities->find($id))
            ->withIr($ir)
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
        // $this->authorize('manage-account-code');
     
      $data=$request->all();
        $activities = $this->activities->update($id, $data);
        if($activities){
           
            return redirect()->route('activities.index')->with('success', 'Activities Updated successfully!');
        }
        return response()->json(['status'=>'error',
            'message'=>'Actors can not be updated.'], 422);
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
        if($flag){
            return redirect()->route('activities.index')->with('success', 'Activities is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Actors can not deleted.',
        ], 422);
    }
}
