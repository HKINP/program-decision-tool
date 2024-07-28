<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Actors;

class ActorsRepository extends Repository
{
    public function __construct(Actors $actors)
    {
        $this->model = $actors;
    }

}