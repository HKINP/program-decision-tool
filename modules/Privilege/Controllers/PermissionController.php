<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Privilege\Repositories\PermissionRepository;
use Modules\Privilege\Requests\Permission\StoreRequest;
use Modules\Privilege\Requests\Permission\UpdateRequest;

class PermissionController extends Controller
{
    /**
     * The permission repository instance.
     *
     * @var PermissionRepository
     */
    protected $permissions;

    /**
     * Create a new controller instance.
     *
     * @param  PermissionRepository  $permissions
     * @return void
     */
    public function __construct(PermissionRepository $permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Privilege::Permission.index')
            ->withPermissions($this->permissions->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Privilege::Permission.add')
            ->withPermissions($this->permissions->where('parent_id', '=', 0)->pluck('permission_name', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Privilege\Requests\Permission\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $permission = $this->permissions->create($request->all());
       
        if ($permission) {
            return redirect()->route('permission.index')->with('success', 'Permission is successfully added.');
        }
        return redirect()->route('permission.index')->with('error', 'Permission can not be added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->permissions->find($id);
        return response()->json(['status' => 'ok', 'permission' => $permission], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Privilege::Permission.edit')
            ->withPermission($this->permissions->find($id))
            ->withPermissions($this->permissions->where('parent_id', '=', 0)->pluck('permission_name', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Privilege\Requests\Permission\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $permission = $this->permissions->update($id, $request->except('id'));
       
        if ($permission) {
            return redirect()->route('permission.index')->with('success', 'Permission is successfully updated.');
        }
        return redirect()->route('permission.index')->with('error', 'Permission can not be updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flag = $this->permissions->destroy($id);
       
        if ($flag) {
            return redirect()->route('permission.index')->with('success', 'Permission is successfully deleted.');
        }
        return redirect()->route('permission.index')->with('error', 'Permission cannot be deleted.');

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return mixed
     */
    public function view($id)
    {
        $permission = $this->permissions->with(['roles', 'roles.users', 'roles.users.office'])->find($id);
        return view('Privilege::Permission.view')
            ->withPermission($permission);
    }
}
