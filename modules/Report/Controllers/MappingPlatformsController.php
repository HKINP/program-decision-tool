<?php

namespace Modules\Report\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\DistrictRepository;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Configuration\Repositories\QuestionRepository;
use Modules\Report\Repositories\PriorityRepository;
use Modules\Report\Requests\MappingPlatforms\StoreRequest;
use Modules\Report\Requests\MappingPlatforms\UpdateRequest;

class MappingPlatformsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  DistrictRepository $districts
     * @return void
     */
    protected $districts,$provinces,$priorities,$questions;
    

    public function __construct(

        DistrictRepository $districts,
        ProvinceRepository $provinces,
        PriorityRepository $priorities,
        QuestionRepository $questions,

    )
    {
        $this->districts = $districts;
        $this->provinces=$provinces;
        $this->priorities=$priorities;
        $this->questions=$questions;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        if ($request->has('did') && $request->input('did') != '' && $request->has('stageId') && $request->input('stageId') == 1){
            $did = $request->query('did');
            $stageId=$request->query('stageId');
            $districtprofile=$this->districts->with(['province'])->find($did);
            $questions=$this->questions->with(['stage', 'thematicArea','tag','targetGroup'])->where('stage_id','=',$stageId)->get();
           // Organize questions by target group and thematic area        
        // return response()->json(['status'=>'error','message'=>$questionsByTargetGroup], 422);
            return view('Report::Priorities.create')
            ->withDistrictprofile($districtprofile)
            ->withQuestions($questions)
            ->withPriorities($this->priorities->all()->toArray());
        }
        else{

            return redirect()->route('district.index')->with('failed', 'Unable to submit priority!');
        } 
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces=$this->provinces->all()->mapWithKeys(function($province) {
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
    public function store(StoreRequest $request)
    {
        // $this->authorize('manage-account-code');
        $district = $this->districts->create($request->all());
        if($district){
            return redirect()->route('district.index')->with('success', 'Added District successfully!');
        }
        return response()->json(['status'=>'error','message'=>'Account Code can not be added.'], 422);
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
