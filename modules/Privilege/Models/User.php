<?php

namespace Modules\Privilege\Models;

use App\Traits\UpdatedBy;
use App\Traits\ModelEventLogger;
use Modules\Leave\Models\UserLeave;
use Illuminate\Auth\Authenticatable;
use Modules\Leave\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Notifications\Notifiable;
use Modules\Configuration\Models\AwardCode;
use Modules\Configuration\Models\Guideline;
use Modules\Configuration\Models\BudgetCode;
use Modules\Configuration\Models\FiscalYear;
use Modules\Configuration\Models\AccountCode;
use Modules\Inventory\Models\AssetAllocation;
use Illuminate\Auth\Passwords\CanResetPassword;
use Modules\Configuration\Models\MonitoringCode;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Modules\Configuration\Models\District;
use Modules\Configuration\Models\Province;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, ModelEventLogger, Notifiable, UpdatedBy;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'assignedProvince',
        'assignedDistrict',
        'assignedLocallevel',
        'password',
        'status',
        'updated_by'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /*
     * Get logs of the user
     */
    public function logs()
    {
        return $this->hasMany('App\Log', 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('Modules\Privilege\Models\User', 'updated_by');
    }

    /*
     * Get roles of the user
     */
    public function roles()
    {
        return $this->belongsToMany('Modules\Privilege\Models\Role', 'user_roles');
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('role', $role)->first();
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('role', $roles)->first();
    }


    public function isDeveloperOrSuperAdmin()
    {
        return in_array(1, $this->roles()->pluck('role_id')->toArray()) || in_array(2, $this->roles()->pluck('role_id')->toArray());
    }
    
   // Convert province_ids CSV to an array
   public function getProvincesArray($provincesCsv = null)
   {
       if ($provincesCsv) {
           return array_map('intval', explode(',', $provincesCsv));
       }

       // Fallback to CSV from model property
       return $this->province_id ? array_map('intval', explode(',', $this->province_id)) : [];
   }

   // Convert district_ids CSV to an array
   public function getDistrictsArray($districtsCsv = null)
   {
       if ($districtsCsv) {
           return array_map('intval', explode(',', $districtsCsv));
       }

       // Fallback to CSV from model property
       return $this->district_id ? array_map('intval', explode(',', $this->district_id)) : [];
   }

}
