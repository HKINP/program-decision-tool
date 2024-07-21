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
    protected $fillable = ['question'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function stages()
    {
        return $this->belongsToMany(Stages::class, 'question_stage');
    }
    
}
