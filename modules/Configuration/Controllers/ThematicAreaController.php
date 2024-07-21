<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\TargetGroupRepository;
use Modules\Configuration\Repositories\ThematicAreaRepository;
use Modules\Configuration\Requests\ThematicArea\StoreRequest;
use Modules\Configuration\Requests\ThematicArea\UpdateRequest;

class ThematicAreaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  ThematicAreaRepository $thematicareas
     * @return void
     */
    protected $thematicareas,$targetgroups;
    

    public function __construct(
        ThematicAreaRepository $thematicareas,
        TargetGroupRepository $targetgroups,

    )
    {
        $this->thematicareas= $thematicareas;
        $this->targetgroups=$targetgroups;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        
       $thematicareas=$this->thematicareas->with(['targetGroup'])->orderby('thematic_area', 'asc')->get();
    
        // $this->authorize('manage-account-code');
             return view('Configuration::ThematicArea.index')
            ->withThematicareas($thematicareas);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $targetgroups=$this->targetgroups->all()->mapWithKeys(function($targetgroup) {
            return [$targetgroup->id => $targetgroup->target_group];
        })->toArray();
     

        return view('Configuration::ThematicArea.create')
        ->withTargetGroups($targetgroups);
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
        $district = $this->thematicareas->create($request->all());
        if($district){
            return redirect()->route('thematicarea.index')->with('success', 'Added Thematic Area successfully!');
        }
        return response()->json(['status'=>'error',
            'message'=>'Account Code can not be added.'], 422);
    }

    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thematicarea = $this->thematicareas->find($id);
        return response()->json(['status'=>'ok','thematicarea'=>$thematicarea], 200);
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
        $targetgroups=$this->targetgroups->all()->mapWithKeys(function($targetgroup) {
            return [$targetgroup->id => $targetgroup->target_group];
        })->toArray();
      
        return view('Configuration::ThematicArea.edit')
            ->withThematicArea($this->thematicareas->find($id))
            ->withTargetGroups($targetgroups);
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
     
        
        $thematicareas = $this->thematicareas->update($id, $request->except('id'));
       
        if($thematicareas){
            return redirect()->route('thematicarea.index')->with('success', 'Thematic Area Updated successfully!');
        }
        return response()->json(['status'=>'error',
            'message'=>'Account Code can not be updated.'], 422);
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
        $flag = $this->thematicareas->destroy($id);
        if($flag){
            return redirect()->route('thematicarea.index')->with('success', 'Thematic Area is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'District can not deleted.',
        ], 422);
    }
}
