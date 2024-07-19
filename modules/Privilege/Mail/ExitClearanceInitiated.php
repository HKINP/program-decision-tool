<?php

namespace Modules\Privilege\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Privilege\Models\User;

class ExitClearanceInitiated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;

    protected $resi_eff_date;

    protected $authUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        User $user,
        $resi_eff_date
    ){
        $this->user = $user;
        $this->resi_eff_date = $resi_eff_date;
        $this->authUser = auth()->user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Privilege::Emails.exit-clearance-initiate')
            ->subject('Exit Clearance Request Initiated.')
            ->with([
                'user' => $this->user,
                'resignation_effective_date' => $this->resi_eff_date,
                'authUser'=> $this->authUser
            ]);
    }
}
