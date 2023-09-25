<?php
namespace App\Http\Livewire;

use App\Mail\emailAmine;
use App\Models\Category;
use App\Models\demandes;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Mail\Mailable;

class DemandeComponent extends Component
{

    public function cancel($idDemande){
        demandes::destroy($idDemande);
        return redirect()->route('demande.page');
    }


    public function update($demande_id)
    {
        $demande = demandes::find($demande_id);
        $demande->state = 'Accepted';

        // Save the changes to the database
        $demande->save();
        $annonce = DB::table('demandes')
            ->join('annonces', 'annonces.id', '=', 'demandes.annonce_id')
            ->join('products', 'products.id', '=', 'annonces.products_id')
            ->select('products.*')
            ->where('demandes.id', '=', $demande_id)
            ->first();
        $annoncespub = DB::table('demandes')
            ->join('annonces', 'annonces.id', '=', 'demandes.annonce_id')
            ->select('annonces.*')
            ->where('demandes.id', '=', $demande_id)
            ->first();
        $pdf = PDF::loadView('pdf', [
            'objetLoue' => $annonce->title,
            'partenaire' => auth()->user()->name,
            'client' => $demande->user->name,
            'description' => $annonce->description,
            'short_description' => $annonce->short_description,
            'reservation_Ddate' => $demande->reservation_Ddate,
            'reservation_Fdate' => $demande->reservation_Fdate,
            'regular_price' => $annoncespub->regular_price,
            'city' => $annoncespub->city,
        ]);

        // Get the client email
        $client_email = DB::table('demandes')
            ->join('users', 'users.id', '=', 'demandes.user_id')
            ->select('users.email')
            ->where('demandes.id', '=', $demande_id)
            ->first()
            ->email;

        // Generate the PDF file
        $filename = 'contrat.pdf';
        Storage::put($filename, $pdf->output());

        // Send the email with the PDF attachment
        Mail::to(auth()->user()->email)
            ->cc($client_email)
            ->send(new emailAmine($client_email, $filename, $annonce->title, auth()->user()->name, $demande->user->name,$annonce->description,$annonce->short_description, $demande->reservation_Ddate, $demande->reservation_Fdate, $annoncespub->regular_price, $annoncespub->city));

        session()->flash('success_message', 'Demande confirmée');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('demande.page');
    }


    public function render()
    {
        $demandes = DB::table('demandes')
        ->join('annonces', 'annonces.id', '=', 'demandes.annonce_id')
        ->join('users', 'users.id', '=', 'demandes.user_id')
        ->join('products', 'products.id', '=', 'annonces.products_id')
        ->select('demandes.id as idD', 'demandes.user_id as UID', 'demandes.state', 'demandes.reservation_Ddate', 'demandes.reservation_Fdate', 'annonces.*','products.*', 'users.*')
        ->where('demandes.state','=','pending')
        ->where('annonces.user_id', '=', auth()->user()->id)
        ->paginate(5);
        // $demandes = demandes::with('annonces','products', 'User')
        // ->where('demandes.state','=','pending')
        // ->where('annonces.user_id', '=', auth()->user()->id)
        // ->paginate(5);       
        $categories=Category::orderBy('name','ASC')->get();
        $totalDemandes = $demandes->total();

        return view('livewire.demande-component',['demandes'=>$demandes,'categories'=>$categories,'totalDemandes'=>$totalDemandes]);
    }
}
