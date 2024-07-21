<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\TargetGroupRepository;
use Modules\Configuration\Requests\TargetGroup\StoreRequest;
use Modules\Configuration\Requests\TargetGroup\UpdateRequest;

class TargetGroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  TargetGroupRepository $targetgroups
     * @return void
     */
    protected $targetgroups;
    

    public function __construct(
        TargetGroupRepository $targetgroups
    )
    {
        $this->targetgroups = $targetgroups;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        
        // $this->authorize('manage-account-code');
             return view('Configuration::TargetGroup.index')
            ->withTargetGroups($this->targetgroups->orderby('target_group', 'asc')->get());
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Modules\Configuration\Requests\Province\StoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        // $this->authorize('manage-account-code');
      
        
        $targetgroups = $this->targetgroups->create($request->all());
        if($targetgroups){
            return redirect()->route('targetgroup.index')->with('success', 'Target Area added  successfully!');
        }
        return response()->json(['status'=>'error',
            'message'=>'Target Area can not be added.'], 422);
    }

    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $targetarea = $this->targetgroups->find($id);
        return response()->json(['status'=>'ok','targetgroup'=>$targetarea], 200);
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
        
        return view('Configuration::Province.edit')
            ->withTargetGroups($this->targetgroups->find($id));
    }

    /**
     * Update the specified account head in storage.
     *
     * @param  \Modules\Configuration\Requests\Province\UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, $id)
    {
        
        $targetgroup = $this->targetgroups->update($request->get('id'), $request->except('id'));
        if($targetgroup){
            return response()->json(['status' => 'ok',
                'Province' => $targetgroup,
                'message' => 'Account Code is successfully updated.'], 200);
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
        $flag = $this->targetgroups->destroy($id);
        if($flag){
            return redirect()->route('targetgroup.index')->with('success', 'Target Area is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Account Code can not deleted.',
        ], 422);
    }
}
