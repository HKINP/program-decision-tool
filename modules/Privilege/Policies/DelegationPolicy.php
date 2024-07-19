<?php

namespace Modules\Privilege\Policies;

use Modules\Privilege\Models\User;
use Modules\Privilege\Models\UserDelegation;
use Illuminate\Auth\Access\HandlesAuthorization;

class DelegationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the delegation can view the delegation.
     *
     * @param  \Modules\Privilege\Models\User  $user
     * @param  \Modules\Privilege\Models\UserDelegation  $delegation
     * @return mixed
     */
    public function view(User $user, UserDelegation $delegation)
    {
        return $user->id === $delegation->from_user || $user->id === $delegation->to_user;
    }

    /**
     * Determine if the given delegation can be updated by the user.
     *
     * @param  \Modules\Privilege\Models\User  $user
     * @param  \Modules\Privilege\Models\UserDelegation  $delegation
     * @return bool
     */
    public function update(User $user, UserDelegation  $delegation)
    {
        return $user->id === $delegation->from_user;
    }

    /**
     * Determine if the given delegation can be deleted by the user.
     *
     * @param  \Modules\Privilege\Models\User  $user
     * @param  \Modules\Privilege\Models\UserDelegation  $delegation
     * @return bool
     */
    public function delete(User $user, UserDelegation  $delegation)
    {
        return $user->id === $delegation->from_user;
    }
}
