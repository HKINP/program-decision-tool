<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\StagesRepository;
use Modules\Configuration\Requests\Stages\StoreRequest;
use Modules\Configuration\Requests\Stages\UpdateRequest;
use Modules\Report\Repositories\StepRemarksRepository;

class StagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  StagesRepository $stages
     * @return void
     */
    protected $stages,$stepRemarks;
    

    public function __construct(
        StagesRepository $stages,
        StepRemarksRepository $stepRemarks
    )
    {
        $this->stages = $stages;
        $this->stepRemarks = $stepRemarks;
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
             return view('Configuration::Stages.index')
            ->withStages($this->stages->orderby('stages', 'asc')->get());
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
      
        $stages = $this->stages->create($request->all());
        if($stages){
            return redirect()->route('stages.index')->with('success', 'Stages added  successfully!');
        }
        return response()->json(['status'=>'error',
            'message'=>'Account Code can not be added.'], 422);
    }

    public function resetStageStatus(Request $request)
    {
        $data=$request->all();
        $did=$data['district_id'];
        $stageId=$data['stage_id'];
        $resetStatus=$this->stepRemarks->where('stage_id','=', $stageId)->where('district_id','=', $did)->update(['stage_status' => 0]);
       if($resetStatus){
        
        return redirect()->route('dataentrystage.create', ['stageId' => $stageId, 'did' => $did])
        ->with('success', 'Enabled edit access successfully!');
       }else{
        return redirect()->back()->with('error', 'Failed to enable edit access!');
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
        $stages = $this->stages->find($id);
        return response()->json(['status'=>'ok','stages'=>$stages], 200);
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
        $this->authorize('manage-account-code');
        return view('Configuration::stages.edit')
            ->withStages($this->stages->find($id));
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
       
        $stages = $this->stages->update($request->get('id'), $request->except('id'));
        if($stages){
            return response()->json(['status' => 'ok',
                'stages' => $stages,
                'message' => 'Stage successfully updated.'], 200);
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
        $flag = $this->stages->destroy($id);
        if($flag){
            return redirect()->route('stages.index')->with('success', 'Province is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Account Code can not deleted.',
        ], 422);
    }
}
