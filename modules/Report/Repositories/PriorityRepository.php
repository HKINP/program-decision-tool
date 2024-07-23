<?php

namespace Modules\Report\Repositories;

use App\Repositories\Repository;
use Modules\Report\Models\Priority;

class PriorityRepository extends Repository
{
    public function __construct(Priority $priority)
    {
        $this->model = $priority;
    }

    // Additional repository methods can be added here if needed
}
