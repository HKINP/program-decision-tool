<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicators extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'indicators';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stage_id',
        'thematic_area_id',
        'indicator_name',
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
    
    public function districtProfiles()
    {
        return $this->hasMany(DistrictProfile::class);
    }

    public function provinceProfiles()
    {
        return $this->hasMany(ProvinceProfile::class);
    }

    
}
