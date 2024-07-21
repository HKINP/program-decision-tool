<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Stages;

class StagesRepository extends Repository
{
    public function __construct(Stages $stages)
    {
        $this->model = $stages;
    }
}