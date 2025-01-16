<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\ActivitiesAttributeData;

class ActivitiesAttributeDataRepository extends Repository
{
    public function __construct(ActivitiesAttributeData $data)
    {
        $this->model = $data;
    }

}