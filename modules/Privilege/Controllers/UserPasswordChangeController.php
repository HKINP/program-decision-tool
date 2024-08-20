<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Modules\Privilege\Repositories\UserRepository;

use Modules\Privilege\Mail\PasswordChanged;

class UserPasswordChangeController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(
        UserRepository $users
    ) {
        $this->users = $users;
    }

    /**
     * Get Change password form for the specified user from storage.
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function getChangePassword(Request $request, $id)
    {
        $user = $this->users->find($id);
        return view('Privilege::User.change-password')
            ->withUser($user);
    }

    /**
     * Change password of the specified user from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
       
        $user = $this->users->find($request->user_id);
        $data['password'] = bcrypt($request->password);
        $user->update($data);
        if ($user) {
            // if ($request->send_email != null) {
            //     Mail::to($user->email_address)
            //         ->send(new PasswordChanged($user, $request->password));
            // }

            return redirect()->route('user.index')
                ->with('success', 'Password of the selected user is changed successfully.');
        } else {
            return redirect()->route('user.index')
                ->with('error', 'Unable to change password of the selected user.');
        }
    }
}
