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
        'thematic_area_id',
        'indicator_id',
        'target_group_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    

    public function thematicArea()
    {
        return $this->belongsTo(ThematicArea::class, 'thematic_area_id');
    }

    public function indicator()
    {
        return $this->belongsTo(Indicators::class, 'indicator_id');
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
