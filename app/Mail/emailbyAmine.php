<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailbyAmine extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $annonces;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $annonces)
    {
        $this->user = $user;
        $this->annonces = $annonces;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.testing')
            ->subject('Nouvelle demande de location de votre objet')
            ->with(['user' => $this->user, 'annonces' => $this->annonces]);
    }
}
