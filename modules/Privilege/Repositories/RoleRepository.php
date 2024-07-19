<?php
namespace Modules\Privilege\Repositories;

use App\Repositories\Repository;
use Modules\Privilege\Models\Role;

class RoleRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function lists()
    {
        $user = auth()->user();
        if($user->role_id != 1){
            return $this->model->where('id', '<>', 1)->pluck('role', 'id');
        }
        return $this->model->pluck('role', 'id');
    }

    public function getModules($id)
    {
        return $this->model->findOrFail($id)->modules()->get();
    }

    public function syncPermissions($role, $permissions)
    {
        return $role->permissions()->sync($permissions);
    }

    public function all()
    {
        $user = auth()->user();
        if($user->role_id != 1){
            return $this->model->where('id', '<>', 1)->get();
        }
        return $this->model->all();
    }
}