<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;

class District extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'districts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id',
        'district',
        'updated_by',
        'vulnerable_municipality',
        'ecological_zone',
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function districtProfiles()
    {
        return $this->hasMany(DistrictProfile::class);
    }
    public function locallevel()
    {
        return $this->hasMany(LocalLevel::class);
    }
}
