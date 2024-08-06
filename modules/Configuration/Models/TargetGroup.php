<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class TargetGroup extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'target_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['target_group'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function thematicAreas()
    {
        return $this->belongsToMany(ThematicArea::class, 'thematic_area_target_group');
    }
}
