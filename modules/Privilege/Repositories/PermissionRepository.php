<?php
namespace Modules\Privilege\Repositories;

use App\Repositories\Repository;
use Modules\Privilege\Models\Permission;

use DB;

class PermissionRepository extends Repository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function lists()
    {
        return $this->model->pluck('name', 'id');
    }
}