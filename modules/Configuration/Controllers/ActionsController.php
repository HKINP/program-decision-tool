<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ActionsRepository;
use Modules\Configuration\Requests\Actions\StoreRequest;
use Modules\Configuration\Requests\Actions\UpdateRequest;

class ActionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  PlatformsRepository $districts
     * @return void
     */
    protected $actions;
    

    public function __construct(
        ActionsRepository $actions

    )
    {
        $this->actions = $actions;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        
       $actions=$this->actions->with(['parents'])->orderby('id', 'asc')->where('id','!=',1)->get();
       return view('Configuration::Actions.index')
            ->withActions($actions);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $actions = $this->actions->all()->pluck('actors', 'id')->toArray();
        return view('Configuration::Actions.create')
        ->withActions($actions);
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
        $actions = $this->actions->create($request->all());
        if($actions){
            return redirect()->route('actions.index')->with('success', 'Added platforms successfully!');
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
        $actions = $this->actions->find($id);
        return response()->json(['status'=>'ok','actors'=>$actions], 200);
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
        $actions = $this->actions->all()->pluck('actors', 'id')->toArray();
        return view('Configuration::Actions.edit')
            ->withActions($this->actions->find($id))
            ->withActionsList($actions);
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
     
        
        $actions = $this->actions->update($id, $request->except('id'));
       
        if($actions){
            return redirect()->route('actors.index')->with('success', 'Actors Updated successfully!');
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
        $flag = $this->actions->destroy($id);
        if($flag){
            return redirect()->route('actors.index')->with('success', 'Actors is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Actors can not deleted.',
        ], 422);
    }
}
