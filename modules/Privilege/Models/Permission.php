<?php

namespace Modules\Privilege\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UpdatedBy;
use App\Traits\ModelEventLogger;

class Permission extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'permission_name',
        'guard_name',
        'updated_by',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at','updated_at'];

    /**
     * Get parent permission of the child permission
     */
    public function parent()
    {
        return $this->belongsTo('Modules\Privilege\Models\Permission', 'parent_id');
    }

    /**
     * Get childrens permission of the permission
     */
    public function childrens()
    {
        return $this->hasMany('Modules\Privilege\Models\Permission', 'parent_id');
    }

    /**
     * Get all roles that belong to the permission.
     */
    public function roles()
    {
        return $this->belongsToMany('Modules\Privilege\Models\Role', 'role_permissions', 'permission_id', 'role_id');
    }
    public function updatedBy()
    {
        return $this->belongsTo('Modules\Privilege\Models\User', 'updated_by');
    }
}
