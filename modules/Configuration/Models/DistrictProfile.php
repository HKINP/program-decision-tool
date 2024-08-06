<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistrictProfile extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'district_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'district_id',
        'indicator_id',
        'all_value',
        'source',
        'displayinreport',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
  
    public function indicator()
    {
        return $this->belongsTo(Indicators::class);
    }
   
}
