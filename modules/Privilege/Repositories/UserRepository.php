<?php

namespace Modules\Privilege\Repositories;

use App\Repositories\Repository;
use Modules\Privilege\Models\User;

use DB;
use Modules\Staff\ECF\Models\ECFRequest;

class UserRepository extends Repository
{
    public function __construct(
        User $user,
        PermissionRepository $permissions
    )
    {
        $this->model = $user;
        $this->permissions = $permissions;
    }

    public function all()
    {
        if (in_array(1, session()->get('roles'))) {
            return $this->model->with(['roles'])
                ->whereDoesntHave('roles', function ($query) {
                    $query->where('id', 1);
                })->get();
        }
        return $this->model->all();
    }

    public function lists()
    {
        return $this->model->pluck('full_name', 'id');
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->create($data);
            if (!empty($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }
            if (!empty($data['account_codes'])) {
                $user->accountCodes()->sync($data['account_codes']);
            }
            if (!empty($data['award_codes'])) {
                $user->awardCodes()->sync($data['award_codes']);
            }
            if (!empty($data['budget_codes'])) {
                $user->budgetCodes()->sync($data['budget_codes']);
            }
            if (!empty($data['monitoring_codes'])) {
                $user->monitoringCodes()->sync($data['monitoring_codes']);
            }
            DB::commit();
            return $user;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return false;
        }
    }

    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->findOrFail($id);
            $user->fill($data)->save();
            if (!empty($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }
            if (!empty($data['account_codes'])) {
                $user->accountCodes()->sync($data['account_codes']);
            }
            if (!empty($data['award_codes'])) {
                $user->awardCodes()->sync($data['award_codes']);
            }
            if (!empty($data['budget_codes'])) {
                $user->budgetCodes()->sync($data['budget_codes']);
            }
            if (!empty($data['monitoring_codes'])) {
                $user->monitoringCodes()->sync($data['monitoring_codes']);
            }
            DB::commit();
            return $user;
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            DB::rollback();
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->model->findorFail($id);
            $user->delete();
            return response()->json(['status' => 'ok', 'message' => 'User is deleted successfully.'], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => 'error', 'message' => 'User can not be deleted.'], 422);
        }
    }

    public function permissionBasedUsers($guardName, $array = [])
    {
        $permission = $this->permissions->findByField('guard_name', $guardName);
        if ($permission) {
            $roles = $permission->roles->pluck('id');
            $users = $this->model->where('is_active', '=', '1')
                ->where('support_staff', 0);
            if (!empty($array['office_id'])) {
                $users->whereIn('office_id', $array['office_id']);
            }
            return $users->whereHas('roles', function ($query) use ($roles) {
                $query->whereIn('id', $roles);
            })->whereDoesntHave('roles', function($query){
                $query->where('id', 1);
            })->orderby('full_name', 'asc')->get();
        }
        return [];
    }

}