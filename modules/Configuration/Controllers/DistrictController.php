<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\DistrictRepository;
use Modules\Configuration\Requests\District\StoreRequest;
use Modules\Configuration\Requests\District\UpdateRequest;

class DistrictController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  DistrictRepository $districts
     * @return void
     */
    protected $districts;
    

    public function __construct(
        DistrictRepository $districts
    )
    {
        $this->districts = $districts;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        
       $districts=$this->districts->with(['province'])->orderby('district', 'asc')->get();
    
        // $this->authorize('manage-account-code');
             return view('Configuration::District.index')
            ->withdistricts($districts);
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
     * @param  \Modules\Configuration\Requests\District\StoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('manage-account-code');
        $district = $this->districts->create($request->all());
        if($district){
            return response()->json(['status' => 'ok',
                'District' => $District,
                'message' => 'Account Code is successfully added.'], 200);
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
        return response()->json(['status'=>'ok','District'=>$District], 200);
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
        return view('Configuration::District.edit')
            ->withDistrict($this->districts->find($id));
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
        $this->authorize('manage-account-code');
        $District = $this->districts->update($request->get('id'), $request->except('id'));
        if($District){
            return response()->json(['status' => 'ok',
                'District' => $District,
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
        $flag = $this->districts->destroy($id);
        if($flag){
            return response()->json([
                'type'=>'success',
                'message'=>'District is successfully deleted.',
            ], 200);
        }
        return response()->json([
            'type'=>'error',
            'message'=>'District can not deleted.',
        ], 422);
    }
}
