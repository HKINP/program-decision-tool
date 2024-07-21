<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\TargetGroup;

class TargetGroupRepository extends Repository
{
    public function __construct(TargetGroup $targetgroup)
    {
        $this->model = $targetgroup;
    }
}