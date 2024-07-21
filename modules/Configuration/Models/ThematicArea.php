<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;

class ThematicArea extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'thematic_areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['target_group_id', 'thematic_area'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function targetGroup()
{
    return $this->belongsTo(TargetGroup::class, 'target_group_id');
}
   
}
