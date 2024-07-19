<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Privilege\Repositories\UserRepository;

class UserInventoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository $users
     * @return void
     */
    public function __construct(
        UserRepository $users
    )
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the delegation.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('Privilege::Inventory.index')
            ->withProducts($user->inventoryProducts)
            ->withUser($user);
    }
}
