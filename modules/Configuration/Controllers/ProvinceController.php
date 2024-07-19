<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Configuration\Requests\Province\StoreRequest;
use Modules\Configuration\Requests\Province\UpdateRequest;

class ProvinceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  ProvinceRepository $provinces
     * @return void
     */
    protected $provinces;
    

    public function __construct(
        ProvinceRepository $provinces
    )
    {
        $this->provinces = $provinces;
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
             return view('Configuration::Province.index')
            ->withprovinces($this->provinces->orderby('province', 'asc')->get());
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
        $this->authorize('manage-account-code');
        $Province = $this->provinces->create($request->all());
        if($Province){
            return response()->json(['status' => 'ok',
                'Province' => $Province,
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
        $Province = $this->provinces->find($id);
        return response()->json(['status'=>'ok','Province'=>$Province], 200);
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
        return view('Configuration::Province.edit')
            ->withProvince($this->provinces->find($id));
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
        $this->authorize('manage-account-code');
        $Province = $this->provinces->update($request->get('id'), $request->except('id'));
        if($Province){
            return response()->json(['status' => 'ok',
                'Province' => $Province,
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
        $this->authorize('manage-account-code');
        $flag = $this->provinces->destroy($id);
        if($flag){
            return response()->json([
                'type'=>'success',
                'message'=>'Account Code is successfully deleted.',
            ], 200);
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Account Code can not deleted.',
        ], 422);
    }
}
