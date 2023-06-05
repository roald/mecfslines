<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class UserInvitation extends Mailable
{
    use Queueable, SerializesModels;

    // The user to be invited
    public $user;

    // The temporary signed URL for the user to accept the invitation
    public $signedUrl;

    // The name of the sender
    public $sender;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->signedUrl = URL::temporarySignedRoute('invitation.accept', now()->addWeek(), ['token' => $user->invitation_token]);
        $this->sender = Auth::user()->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email, $this->user->name)
                    ->markdown('emails.invitation');
    }
}
