<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Privilege\Repositories\PermissionRepository;
use Modules\Privilege\Repositories\RoleRepository;
use Modules\Privilege\Repositories\ModuleRepository;
use Modules\Privilege\Requests\Role\StoreRoleRequest;
use Modules\Privilege\Requests\Role\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * The role repository instance.
     *
     * @var RoleRepository
     */
    protected $roles;

    /**
     * The permission repository instance.
     *
     * @var PermissionRepository
     */
    protected $permissions;

    /**
     * Create a new controller instance.
     *
     * @param  RoleRepository $roles
     * @param  PermissionRepository $permissions
     * @return void
     */
    public function __construct(
        RoleRepository $roles,
        PermissionRepository $permissions
    )
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Privilege::Role.index')
            ->withRoles($this->roles->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Privilege::Role.add')
            ->withPermissions($this->permissions->with(['childrens'])->where('parent_id', '=', 0)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Privilege\Requests\Role\StoreRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = 1;
        $role = $this->roles->create($data);
        if($role){
            $this->roles->syncPermissions($role, $request->permissions);
            session()->flash('success_message', 'Role is successfully added.');
        } else {
            session()->flash('warning_message', 'Role can not be added.');
            return redirect()->back();
        }
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roles->find($id);
        return response()->json(['status' => 'ok', 'role' => $role], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $role = $this->roles->find($id);
            $permissions = $role->permissions()->get();
            $accessedPermissions = [];
            foreach ($permissions as $key => $permission) {
                $accessedPermissions[] = $permission->id;
            }

            return view('Privilege::Role.edit')
                ->withRole($this->roles->find($id))
                ->withRolePermissions($accessedPermissions)
                ->withPermissions($this->permissions->with(['childrens'])->where('parent_id', '=', 0)->get());
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return view('denied');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Privilege\Requests\Role\UpdateRoleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $permissions = $request->permissions ? $request->permissions : [];
        $role = $this->roles->update($id, $request->all());
        if($role){
            $this->roles->syncPermissions($role, $permissions);
            session()->flash('success_message', 'Role successfully updated.');
        } else {
            session()->flash('warning_message', 'Role can not be updated.');
            return redirect()->back();
        }
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->roles->destroy($id);
    }


    public function view($id)
    {
        $role = $this->roles->with(['users', 'permissions'])->find($id);
        return view('Privilege::Role.view')
            ->withRole($role);
    }

}
