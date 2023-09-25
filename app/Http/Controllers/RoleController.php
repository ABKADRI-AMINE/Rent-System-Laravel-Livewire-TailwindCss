<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function updateRole($newRole)
    {
        //Mettre à jour le rôle de l'utilisateur connecté dans la base de données
        //auth()->user()->update(['role' => $newRole]);
    
        //Vérifier si l'utilisateur existe
        $user = User::find(auth()->id());
        if ($user) {
            // Mettre à jour le rôle de l'utilisateur dans la base de données
            $user->update(['role' => $newRole]); // Remplacez 2 par le nouveau rôle que vous souhaitez attribuer
    
        } else {
    
        }
    
       // Rediriger vers une page appropriée
        return redirect()->back(); // ou toute autre page que vous souhaitez rediriger
    }
}
