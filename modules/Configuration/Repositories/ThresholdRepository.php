<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Threshold;

class ThresholdRepository extends Repository
{
    public function __construct(Threshold $threshold)
    {
        $this->model = $threshold;
    }


}