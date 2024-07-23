<?php

namespace Modules\Report\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Modules\Configuration\Models\District;
use Modules\Configuration\Models\Province;
use Modules\Configuration\Models\Question;
use Modules\Configuration\Models\TargetGroup;
use Modules\Configuration\Models\ThematicArea;

class Priority extends Model
{
    use ModelEventLogger, UpdatedBy, SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'priorities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id',
        'district_id',
        'lgid',
        'target_group_id',
        'thematic_area_id',
        'question_id',
        'response_all',
        'response_underserved',
        'priority',
        'updated_by'
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

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
