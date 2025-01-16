<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Modules\Report\Models\PrioritizedActivities;

class ActivitiesAttributeData  extends Model
{
    use ModelEventLogger, UpdatedBy, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activities_attributes_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'district_id',
        'province_id',
        'event_date',
        'event_location',
        'activity_id',
        'attributes_data',
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
    public function activity()
    {
        return $this->belongsTo(Activities::class, 'activity_id');
    }
}
