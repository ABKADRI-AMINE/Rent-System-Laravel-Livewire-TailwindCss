<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class emailAmine extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $filename;
    public $objetLoue;
    public $partenaire;
    public $client;
    public $description;
    public $short_description;
    public $reservation_Ddate;
    public $reservation_Fdate;
    public $reguler_price;
    public $city;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $filename, $objetLoue, $partenaire, $client,$description,$short_description,$reservation_Ddate,  $reservation_Fdate, $reguler_price,$city)
    {
        $this->user = $user;
        $this->filename = $filename;
        $this->objetLoue = $objetLoue;
        $this->partenaire = $partenaire;
        $this->client = $client;
        $this->description = $description;
        $this->short_description = $short_description;
        $this->reservation_Ddate = $reservation_Ddate;
        $this->reservation_Fdate = $reservation_Fdate;
        $this->reguler_price = $reguler_price;
        $this->city = $city;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = Storage::get($this->filename);
        return $this->markdown('emails.test')
            ->subject('Contrat')
            ->attachData($pdf, $this->filename, [
                'mime' => 'application/pdf',
            ])
            ->with([
                'objetLoue' => $this->objetLoue,
                'partenaire' => $this->partenaire,
                'client' => $this->client,
                'description' => $this->description,
                'short_description' => $this->short_description,
                'reservation_Ddate' => $this->reservation_Ddate,
                'reservation_Fdate' => $this->reservation_Fdate,
                'reguler_price' => $this->reguler_price,
                'city' => $this->city,
            ])
            ->with(['user' => $this->user]);
    }
}

