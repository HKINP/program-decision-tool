<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Activities;

class ActivitiesRepository extends Repository
{
    public function __construct(Activities $activities)
    {
        $this->model = $activities;
    }

}