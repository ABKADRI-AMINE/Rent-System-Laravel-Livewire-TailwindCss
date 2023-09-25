<?php

namespace App\Http\Livewire;

use App\Models\notifications;
use Livewire\Component;

class NotificationBell extends Component
{
    protected $listeners = ['demandeTraited' => 'hydrate'];
    
    public function hydrate(){
        $this->render();
    }
    public function render()
    {
        $clientNotifications = [];
        $notifications = notifications::all();
        foreach($notifications as $notification){
            if($notification->demande->user->id == auth()->user()->id){
                array_push($clientNotifications,$notification);
            }
        }

        return view('livewire.notification-bell',[
            'notifications' => $clientNotifications,
        ]);
    }
}