<?php

namespace Modules\Report\Repositories;

use App\Repositories\Repository;
use Modules\Report\Models\KeyBarrier;

class KeyBarrierRepository extends Repository
{
    public function __construct(KeyBarrier $keybarrier)
    {
        $this->model = $keybarrier;
    }

}
