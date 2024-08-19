<?php

namespace Modules\Report\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Modules\Configuration\Models\District;
use Modules\Configuration\Models\Indicators;
use Modules\Configuration\Models\Province;
use Modules\Configuration\Models\Question;
use Modules\Configuration\Models\Stages;

class KeyBarrier extends Model
{
    use ModelEventLogger, UpdatedBy, SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'key_barriers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id', 
        'district_id', 
        'stage_id', 
        'indicator_id', 
        'key_barriers'
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

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function stage()
    {
        return $this->belongsTo(Stages::class);
    }
    public function indicator()
    {
        return $this->belongsTo(Indicators::class);
    }

}
