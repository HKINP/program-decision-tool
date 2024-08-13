<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\OutcomesRepository;
use Modules\Configuration\Requests\Outcomes\StoreRequest;
use Modules\Configuration\Requests\Outcomes\UpdateRequest;

class OutcomesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  OutcomesRepository $activities
     * @return void
     */
    protected $outcomes;
    

    public function __construct(
        OutcomesRepository $outcomes

    )
    {
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
       $outcomes=$this->outcomes->orderby('id', 'asc')->get();
       return view('Configuration::outcomes.index')
            ->withIr($ir)
            ->withOutcomes($outcomes);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $outcomes = $this->outcomes->all()->pluck('activities', 'id')->toArray();
        $ir=[
            1=>'IR1. Activities',
            2=>'IR2. Activities',
            3=>'IR3. Activities',
            4=>'IR4. Activities',
            
            ] ;
        return view('Configuration::outcomes.create')
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
        $outcomes = $this->outcomes->create($request->all());
        if($outcomes){
            return redirect()->route('outcomes.index')->with('success', 'Added Activities successfully!');
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
        $outcomes = $this->outcomes->find($id);
        return response()->json(['status'=>'ok','actors'=>$outcomes], 200);
    }

    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getOutcomesByIrid($id)
    {
        $outcomes = $this->outcomes->where('ir_id','=',$id)->get();
        return response()->json($outcomes);
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
        $outcomes = $this->outcomes->all()->pluck('outcomes', 'id')->toArray();
        $ir=[
            1=>'IR1. Activities',
            2=>'IR2. Activities',
            3=>'IR3. Activities',
            4=>'IR4. Activities',            
            ];
            
        return view('Configuration::outcomes.edit')
            ->withOutcomes($this->outcomes->find($id))
            ->withIr($ir)
            ->withOutcomesList($outcomes);
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
     
        
        $activities = $this->outcomes->update($id, $request->except('id'));
       
        if($activities){
            return redirect()->route('outcomes.index')->with('success', 'Outcomes Updated successfully!');
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
        $flag = $this->outcomes->destroy($id);
        if($flag){
            return redirect()->route('outcomes.index')->with('success', 'Outcomes is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Actors can not deleted.',
        ], 422);
    }
}
