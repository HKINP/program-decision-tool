<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Tags;

class TagsRepository extends Repository
{
    public function __construct(Tags $tags)
    {
        $this->model = $tags;
    }
}