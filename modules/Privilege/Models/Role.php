<?php

namespace Modules\Privilege\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UpdatedBy;
use App\Traits\ModelEventLogger;

class Role extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'updated_by',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get all users that belong to the role.
     */
    public function users(){
    	return $this->belongsToMany('Modules\Privilege\Models\User', 'user_roles');
    }

    /**
     * Get all permissions that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany('Modules\Privilege\Models\Permission', 'role_permissions', 'role_id', 'permission_id');
    }
    public function updatedBy()
    {
        return $this->belongsTo('Modules\Privilege\Models\User', 'updated_by');
    }
}
