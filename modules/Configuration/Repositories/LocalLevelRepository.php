<?php

namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\LocalLevel;

class LocalLevelRepository extends Repository
{
    public function __construct(LocalLevel $llevel)
    {
        $this->model = $llevel;
    }

}