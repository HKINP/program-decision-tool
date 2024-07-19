<?php

namespace Modules\Privilege\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Privilege\Models\User;

class PasswordChanged extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;

    protected $password;

    protected $authUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        User $user,
        $password
    ){
        $this->user = $user;
        $this->password = $password;
        $this->authUser = auth()->user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Privilege::Emails.change-password')
            ->subject('Password Changed.')
            ->with([
                'user' => $this->user,
                'password' => $this->password,
                'authUser'=> $this->authUser
            ]);
    }
}
