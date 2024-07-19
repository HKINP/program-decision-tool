<?php
namespace Modules\Privilege\Repositories;

use App\Repositories\Repository;
use Modules\Privilege\Models\UserDelegation;

class UserDelegationRepository extends Repository
{
    public function __construct(UserDelegation $delegation)
    {
        $this->model = $delegation;
    }
}