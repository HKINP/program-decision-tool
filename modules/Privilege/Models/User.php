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
        'role_id',
        'office_id',
        'department_id',
        'full_name',
        'email_address',
        'phone_number',
        'password',
        'employee_code',
        'designation',
        'profile_pic',
        'signature',
        'reset_token',
        'join_date',
        'is_active',
        'support_staff',
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
    public function logs(){
        return $this->hasMany('App\Log', 'user_id');
    }

    public function updatedBy(){
        return $this->belongsTo('Modules\Privilege\Models\User', 'updated_by');
    }

    /*
     * Get roles of the user
     */
    public function roles(){
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

    /*
     * Get departments of the user
     */
    public function departments(){
        return $this->belongsToMany('Modules\Configuration\Models\Department', 'user_departments');
    }

    /*
     * Get office of the user
     */
    public function office(){
        return $this->belongsTo('Modules\Configuration\Models\Office', 'office_id');
    }

    /*
     * Get department of the user
     */
    public function department(){
        return $this->belongsTo('Modules\Configuration\Models\Department', 'department_id');
    }

    /*
     * Get guidelines of the user
     */
    public function guidelines()
    {
        return $this->belongsToMany(Guideline::class, 'user_guidelines', 'user_id', 'guideline_id');
    }

    /**
     * Get the supervisor1 that owns the user.
     */
    public function supervisor1(){
        return $this->belongsTo('Modules\Privilege\Models\User', 'first_supervisor_id');
    }

    /**
     * Get the supervisor2 that owns the user.
     */
    public function supervisor2(){
        return $this->belongsTo('Modules\Privilege\Models\User', 'second_supervisor_id');
    }

    /**
     * Get the first associates for the user.
     */
    public function firstAssociates(){
        return $this->hasMany('Modules\Privilege\Models\User', 'first_supervisor_id');
    }

    /**
     * Get the second associates for the user.
     */
    public function secondAssociates(){
        return $this->hasMany('Modules\Privilege\Models\User', 'second_supervisor_id');
    }

    /**
     * Get assets of the user
     */
    public function assetAllocations()
    {
        return $this->hasMany(AssetAllocation::class, 'assigned_user_id')
            ->orderby('allocation_date', 'desc');
    }

    /**
     * Get award codes of the user
     */
    public function awardCodes()
    {
        return $this->belongsToMany(AwardCode::class, 'user_award_codes','user_id', 'award_code_id');
    }

    /**
     * Get account codes of the user
     */
    public function accountCodes()
    {
        return $this->belongsToMany(AccountCode::class, 'user_account_codes', 'user_id', 'account_code_id');
    }

    /**
     * Get budget codes of the user
     */
    public function budgetCodes()
    {
        return $this->belongsToMany(BudgetCode::class, 'user_budget_codes','user_id', 'budget_code_id');
    }

    /**
     * Get monitoring codes of the user
     */
    public function monitoringCodes()
    {
        return $this->belongsToMany(MonitoringCode::class, 'user_monitoring_codes','user_id', 'monitoring_code_id');
    }

    public function leaves()
    {
        return $this->hasMany(UserLeave::class, 'user_id');
    }

    public function approvedLeaves($param)
    {
        $fiscal_year = FiscalYear::where('start_date', '<=', date('Y-m-d'))
                    ->where('end_date', '>=', date('Y-m-d'))
                    ->first();

        if(isset($param['fiscal_year_id'])){
            $fiscal_year = FiscalYear::find($param['fiscal_year_id']);
        }

        $leaves = $this->hasMany(LeaveRequest::class, 'requester_id')->where('start_date','>=',$fiscal_year->start_date)->where('end_date','<=',$fiscal_year->end_date)->where('status',6)
        ->when(isset($param['leave_type_id']),function($query) use($param){
            $query->where('leave_type_id',$param['leave_type_id']);
        })
        ->pluck('start_date','end_date');
        
        return $leaves;
    }

    public function isDeveloperOrSuperAdmin()
    {
        return in_array(1, $this->roles()->pluck('role_id')->toArray()) || in_array(2, $this->roles()->pluck('role_id')->toArray());
    }

    public function getName()
    {
        return $this->full_name;
    }

    public function getDesignation()
    {
        return $this->designation;
    }

    public function getDepartmentName()
    {
        return $this->department ? $this->department->department_name : "";
    }

    public function getOfficeName()
    {
        return $this->office ? $this->office->office_name : "";
    }

    public function getGuidelineReadStatus($guideline)
    {
        return $this->guidelines()->where('id', $guideline->id)->first()  ? 'read' : 'unread';
    }

    public function isFromCO()
    {
        return $this->office->isCO() ? true : false;   
    }
}
