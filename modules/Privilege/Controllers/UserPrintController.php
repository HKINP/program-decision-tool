<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Privilege\Repositories\UserDelegationRepository;
use Modules\Privilege\Repositories\UserRepository;

use Image;

class UserPrintController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository $users
     * @param  UserDelegationRepository $userDelegations
     * @return void
     */
    public function __construct(
        UserRepository $users,
        UserDelegationRepository $userDelegations
    )
    {
        $this->users = $users;
        $this->userDelegations = $userDelegations;
        $this->destinationPath = 'users/';
        $this->thumb_width = 300;
        $this->thumb_height = 300;
        $this->thumb_extension = '.jpg';
    }

    /**
     * [printLeaveSummary description]
     * @return [type] [description]
     */
    public function printLeaveSummary()
    {   
        $user = auth()->user();
        return view('Privilege::Print.show')
            ->withUser($user)
            ->withPrintType('leavesummary')
            ->withOriginalUser(session()->get('original_user'));
    }

    /**
     * [printInventories description]
     * @return [type] [description]
     */
    public function printInventories()
    {
        $user = auth()->user();
        return view('Privilege::Print.show')
            ->withUser($user)
            ->withPrintType('inventories')
            ->withOriginalUser(session()->get('original_user'));
    }

}
