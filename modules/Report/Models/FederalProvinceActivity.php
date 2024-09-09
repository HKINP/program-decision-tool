<?php

namespace Modules\Report\Models;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Configuration\Models\Activities;
use Modules\Configuration\Models\Outcomes;
use Modules\Configuration\Models\Province;

class FederalProvinceActivity extends Model
{
    use ModelEventLogger, UpdatedBy, SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'federal_province_activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id',
        'ir_id',
        'outcomes_id',
        'activity_id',
        'proposed_activities',
        'months',
        'year',
        'total_target',
        'implemented_by',
        'remarks',
        'updated_by',
    ];

    // Cast months and year as JSON objects
    protected $casts = [
        'months' => 'array',
        'year' => 'array',
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

    public function outcomes()
    {
        return $this->belongsTo(Outcomes::class, 'outcomes_id');
    }

    public function activity()
    {
        return $this->belongsTo(Activities::class, 'activity_id');
    }
    

}
