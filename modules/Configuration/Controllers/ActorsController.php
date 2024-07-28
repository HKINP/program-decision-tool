<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ActorsRepository;
use Modules\Configuration\Requests\Actors\StoreRequest;
use Modules\Configuration\Requests\Actors\UpdateRequest;

class ActorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  PlatformsRepository $districts
     * @return void
     */
    protected $actors;
    

    public function __construct(
        ActorsRepository $actors

    )
    {
        $this->actors = $actors;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        
       $actors=$this->actors->with(['parents'])->orderby('id', 'asc')->where('id','!=',1)->get();
             return view('Configuration::Actors.index')
            ->withActors($actors);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $actors = $this->actors->all()->pluck('actors', 'id')->toArray();
        return view('Configuration::Actors.create')
        ->withActors($actors);
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
        $actors = $this->actors->create($request->all());
        if($actors){
            return redirect()->route('actors.index')->with('success', 'Added platforms successfully!');
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
        $actors = $this->actors->find($id);
        return response()->json(['status'=>'ok','actors'=>$actors], 200);
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
     
        
        $actors = $this->actors->update($id, $request->except('id'));
       
        if($actors){
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
        $flag = $this->actors->destroy($id);
        if($flag){
            return redirect()->route('actors.index')->with('success', 'Actors is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Actors can not deleted.',
        ], 422);
    }
}
