<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Event\Models\Event;
use App\Traits\ModelLog;
use Modules\Configuration\Models\District;
use Modules\Configuration\Models\Province;

class LocalLevel extends Model{
    use SoftDeletes,ModelLog;
    protected $table = 'llevels';

    protected $fillable =[
        'province_id',
        'district_id',
        'lgname',
    ];

    protected $hidden = ['created_at','updated_at','deleted_at','province_id','district_id'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }

    public function getProvinceName(){
        return $this->province ? $this->province->province_en:"";
    }

    public function getDistrictName(){
        return $this->district ? $this->district->district_en:"";
    }

}
