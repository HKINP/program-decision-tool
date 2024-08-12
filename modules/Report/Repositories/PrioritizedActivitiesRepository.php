<?php

namespace Modules\Report\Repositories;

use App\Repositories\Repository;
use Modules\Report\Models\PrioritizedActivities;

class PrioritizedActivitiesRepository extends Repository
{
    public function __construct(PrioritizedActivities $prioritizedActivities)
    {
        $this->model = $prioritizedActivities;
    }

    
}
