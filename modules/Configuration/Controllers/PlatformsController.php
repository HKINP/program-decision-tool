<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\PlatformsRepository;
use Modules\Configuration\Repositories\StagesRepository;
use Modules\Configuration\Requests\Platforms\StoreRequest;
use Modules\Configuration\Requests\Platforms\UpdateRequest;

class PlatformsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  PlatformsRepository $districts
     * @return void
     */
    protected $platforms,$stages;
    

    public function __construct(
        PlatformsRepository $platforms,
        StagesRepository $stages

    )
    {
        $this->stages = $stages;
        $this->platforms=$platforms;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        
       $districts=$this->platforms->with(['stages'])->orderby('platforms', 'asc')->get();
    
        // $this->authorize('manage-account-code');
             return view('Configuration::Platforms.index')
            ->withplatforms($districts);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $stages = $this->stages->all()->pluck('stages', 'id')->toArray();
        return view('Configuration::Platforms.create')
        ->withstages($stages);
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
        $platform = $this->platforms->create($request->all());
        if($platform){
            return redirect()->route('platform.index')->with('success', 'Added platforms successfully!');
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
        $platforms = $this->platforms->find($id);
        return response()->json(['status'=>'ok','platforms'=>$platforms], 200);
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
        $stages = $this->stages->all()->pluck('stages', 'id')->toArray();
        return view('Configuration::Platforms.edit')
            ->withPlatforms($this->platforms->find($id))
            ->withStages($stages);
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
     
        
        $District = $this->platforms->update($id, $request->except('id'));
       
        if($District){
            return redirect()->route('platform.index')->with('success', 'Platform Updated successfully!');
        }
        return response()->json(['status'=>'error',
            'message'=>'Platform can not be updated.'], 422);
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
        $flag = $this->platforms->destroy($id);
        if($flag){
            return redirect()->route('platform.index')->with('success', 'Platform is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Platform can not deleted.',
        ], 422);
    }
}
