<?php

namespace Modules\Report\Repositories;

use App\Repositories\Repository;
use Modules\Report\Models\StepRemarks;

class StepRemarksRepository extends Repository
{
    public function __construct(StepRemarks $remarks)
    {
        $this->model = $remarks;
    }

    // Additional repository methods can be added here if needed
}
