<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\ModelEventLogger;
use App\Traits\UpdatedBy;

class District extends Model
{
    use ModelEventLogger, UpdatedBy,SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'districts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id',
        'district',
        'updated_by',
        'adolescent_girls',
        'children_under_5',
        'hospitals',
        'hps',
        'otcs',
        'phccs',
        'pregnant_women',
        'wra',
        'chus',
        'fchvs',
        'uhcs',
        'akc',
        'vhlc',
        'children_0_to_23_months',
        'epi_clinics',
        'hmg',
        'low_equity_quintile_municipalities',
        'birthing_centers',
        'schools',
        'orc',
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
   
}
