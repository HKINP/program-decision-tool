<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Modules\Report\Models\PrioritizedActivities;

class Activities extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ir_id','outcomes_id', 'activities','partner','unit','total_budget'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function outcomes()
    {
        return $this->belongsTo(Outcomes::class, 'outcomes_id');
    }
    public function prioritiesActivities()
    {
        return $this->hasMany(PrioritizedActivities::class, 'activity_id');
    }
    
    
   
}
