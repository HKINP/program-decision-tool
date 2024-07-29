<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'stage_id',
        'thematic_area_id',
        'tag_id',
        'target_group_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    public function stage()
    {
        return $this->belongsTo(Stages::class, 'stage_id');
    }

    public function thematicArea()
    {
        return $this->belongsTo(ThematicArea::class, 'thematic_area_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tags::class, 'tag_id');
    }

    public function targetGroup()
    {
        return $this->belongsTo(TargetGroup::class, 'target_group_id');
    }
    public function thresholds()
    {
        return $this->hasMany(Threshold::class);
    }

    

    
}
