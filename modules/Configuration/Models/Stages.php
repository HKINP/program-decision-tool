<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stages extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['stages'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

   
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_stage');
    }
}
