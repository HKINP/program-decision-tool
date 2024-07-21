<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\ThematicArea;

class ThematicAreaRepository extends Repository
{
    public function __construct(ThematicArea $thematicArea)
    {
        $this->model = $thematicArea;
    }

   
}