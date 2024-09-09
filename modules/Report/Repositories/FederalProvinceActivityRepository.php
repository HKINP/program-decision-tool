<?php

namespace Modules\Report\Repositories;

use App\Repositories\Repository;
use Modules\Report\Models\FederalProvinceActivity;

class FederalProvinceActivityRepository extends Repository
{
    public function __construct(FederalProvinceActivity $federalproviceactivity)
    {
        $this->model = $federalproviceactivity;
    }

    
}
