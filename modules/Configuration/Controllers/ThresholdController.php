<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ThresholdRepository;
use Modules\Configuration\Requests\Threshold\StoreRequest;
use Modules\Configuration\Requests\Threshold\UpdateRequest;

class ThresholdController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  DistrictRepository $districts
     * @return void
     */
    protected $threshold;
    

    public function __construct(
        ThresholdRepository $threshold,

    )
    {
        $this->threshold = $threshold;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getThresholdbyQuestionId($id)
    {
        
       $threshold=$this->threshold->where('question_id',"=",$id)->orderby('id', 'asc')->get();
    
        // $this->authorize('manage-account-code');
             return view('Configuration::Threshold.index')
            ->withThreshold($threshold);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('Configuration::Threshold.create');
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
        $district = $this->districts->create($request->all());
        if($district){
            return redirect()->route('district.index')->with('success', 'Added District successfully!');
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
        $District = $this->districts->find($id);
        return response()->json(['status'=>'ok','district'=>$district], 200);
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
        $provinces=$this->provinces->all()->mapWithKeys(function($province) {
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
        // $this->authorize('manage-account-code');
     
        
        $District = $this->districts->update($id, $request->except('id'));
       
        if($District){
            return redirect()->route('district.index')->with('success', 'District Updated successfully!');
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
        $flag = $this->districts->destroy($id);
        if($flag){
            return redirect()->route('district.index')->with('success', 'District is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'District can not deleted.',
        ], 422);
    }
}
