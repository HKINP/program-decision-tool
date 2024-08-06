<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\DistrictProfile;

class DistrictProfileRepository extends Repository
{
    public function __construct(DistrictProfile $districtprofile)
    {
        $this->model = $districtprofile;
    }
}