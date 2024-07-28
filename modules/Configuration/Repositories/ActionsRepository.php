<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Actions;

class ActionsRepository extends Repository
{
    public function __construct(Actions $actions)
    {
        $this->model = $actions;
    }

}