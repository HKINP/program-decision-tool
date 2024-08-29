<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;

class Outcomes extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'outcomes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ir_id','outcome','total_budget'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function activities()
    {
        return $this->hasMany(Activities::class, 'outcomes_id');
    }

    
}
