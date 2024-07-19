<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Province;

class ProvinceRepository extends Repository
{
    public function __construct(Province $province)
    {
        $this->model = $province;
    }
}