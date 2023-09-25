<?php

namespace App\Http\Livewire;

use App\Models\Demande;
use Livewire\Component;
use App\Models\demandes;

class FeedbackBell extends Component
{
    public function render()
    {

        //alert partner to comment client
        $Clientdemandes = demandes::with('annonces','products')->where([
            ['user_id', '=', auth()->user()->id],
            ['feedbackArticle', '=', 'pending'],
            ['state', '=', 'done'],
        ])->get();

        //alert client to comment partner
        $PartnerDemandes = [];

        $demandesP = demandes::with('annonces','products')->where([
            ['feedbackClient', '=', 'pending'],
            ['state', '=', 'done'],
        ])->get();

        foreach ($demandesP as $demande) {
            if ($demande->annonces->user_id == auth()->user()->id);
            array_push($PartnerDemandes, $demande);
        }

        if (auth()->User()->role == 1)
            $demandes = $PartnerDemandes;
        else
            $demandes = $Clientdemandes;


        return view('livewire.feedback-bell', [
            'demandes' => $demandes,
        ]);
        return view('livewire.feedback-bell');
    }
}