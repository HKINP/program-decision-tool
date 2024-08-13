<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Outcomes;

class OutcomesRepository extends Repository
{
    public function __construct(Outcomes $outcome)
    {
        $this->model = $outcome;
    }

}