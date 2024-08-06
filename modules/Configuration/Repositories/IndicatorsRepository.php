<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Indicators;

class IndicatorsRepository extends Repository
{
    public function __construct(Indicators $indicators)
    {
        $this->model = $indicators;
    }

}