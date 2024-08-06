<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\ProvinceProfile;

class ProvinceProfileRepository extends Repository
{
    public function __construct(ProvinceProfile $provinceprofile)
    {
        $this->model = $provinceprofile;
    }
}