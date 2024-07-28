<?php

namespace Modules\Report\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Modules\Configuration\Models\District;
use Modules\Configuration\Models\Province;
use Modules\Configuration\Models\Question;
use Modules\Configuration\Models\Tags;
use Modules\Configuration\Models\Stages;

class MappingResponse extends Model
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
        'stage_id',
        'province_id',
        'district_id',
        'lgid',
        'tag_id',
        'question_id',
        'response_all',
        'response_underserved',
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

    public function tags()
    {
        return $this->belongsTo(Tags::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function stages()
    {
        return $this->belongsTo(Stages::class);
    }

}
