<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;

class Threshold extends Model
{
    use ModelEventLogger, UpdatedBy, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'thresholds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'stage_id', 
        'min_value', 
        'max_value', 
        'color', 
        'recommendation',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stages::class);
    }
}
