<?php

namespace Modules\Report\Models;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Configuration\Models\District;
use Modules\Configuration\Models\Indicators;
use Modules\Configuration\Models\Platforms;
use Modules\Configuration\Models\Province;
use Modules\Configuration\Models\Question;
use Modules\Configuration\Models\TargetGroup;
use Modules\Configuration\Models\ThematicArea;

class PrioritizedActivities extends Model
{
    use ModelEventLogger, UpdatedBy, SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prioritized_activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id',
        'district_id',
        'stage_id',
        'target_group_id',
        'thematic_area_id',
        'indicator_id',
        'platforms_id',
        'proposed_activities',
        'targeted_for',
        'remarks',
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
    public function targetGroup()
    {
        return $this->belongsTo(TargetGroup::class);
    }

    public function thematicArea()
    {
        return $this->belongsTo(ThematicArea::class);
    }

    public function indicator()
    {
        return $this->belongsTo(Indicators::class);
    }
    public function platforms()
    {
        return $this->belongsTo(Platforms::class);
    }

}
