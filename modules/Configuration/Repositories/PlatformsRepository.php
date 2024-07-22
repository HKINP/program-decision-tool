<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Platforms;

class PlatformsRepository extends Repository
{
    public function __construct(Platforms $platforms)
    {
        $this->model = $platforms;
    }

}