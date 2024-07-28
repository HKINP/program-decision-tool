<?php

namespace Modules\Report\Repositories;

use App\Repositories\Repository;
use Modules\Report\Models\MappingResponse;

class MappingResponseRepository extends Repository
{
    public function __construct(MappingResponse $mappingResponse)
    {
        $this->model = $mappingResponse;
    }

    // Additional repository methods can be added here if needed
}
