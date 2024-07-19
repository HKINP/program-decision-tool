<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\District;

class DistrictRepository extends Repository
{
    public function __construct(District $district)
    {
        $this->model = $district;
    }

    public function getProvinces(){

        return $this->model->getProvinces();
    }
}