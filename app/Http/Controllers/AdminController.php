<?php

namespace App\Http\Controllers;

use App\Models\annonces;
use App\Models\Category;
use App\Models\demandes;
use App\Models\feedback_clients;
use DateTime;
use App\Models\User;
use App\Models\Reclamation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '<>', 0)->get();
        return view('admin.GestionUser',compact('users'));
    }

    public function banUser($id)
    {
        $user = User::findOrFail($id);
        $user->isBan = 1;
        $user->save();
        return redirect()->back();
    }

    public function unbanUser($id)
    {
        $user = User::findOrFail($id);
        $user->isBan = 0;
        $user->save();
        return redirect()->back();
    }

    public function voirRec()
{
    $reclamations = Reclamation::all() ;
    foreach($reclamations as $reclmation) {
        $date_rec = date("Y-m-d", strtotime($reclmation->created_at));
        $dateTimeStr = $reclmation->created_at;
        $dateTime = new DateTime($dateTimeStr);
        $currentDateTime = new DateTime();
        $interval = $currentDateTime->diff($dateTime);
        $ilya = $interval->format('%a d, %h h, %i m, %s s') ;
    }
    if(isset($ilya)) {
        return view('admin.listeReclamations',compact('reclamations' , 'ilya', 'date_rec'));
    }
    else {
        return view('admin.listeReclamations',compact('reclamations'));
    }
}

public function voirRecDetail($id) {
    $reclamation = Reclamation::findOrFail($id);
    return view('admin.reclamationDetails' , compact('reclamation')) ;
}

public function storeRec(Request $request, $id) {
    $reclamation = Reclamation::findOrFail($id);
    $reclamation->reponse = $request->input('response');
    $reclamation->status = 1; // Update the status of the reclamation
    $reclamation->save();
    return redirect()->back()->with('success', 'Complaint response has been submitted successfully.');
}

    public function cat()
    {
        //$Categ = Category::all();
        $Categ = Category::withCount('products')->get();
        return view('admin.GestionCategories',compact('Categ'));
    }

    public function annonces()
    {
        // $users = User::where('role', '<>', 0)->get();
        $annonces = annonces::with('product.image','user','AnnonceParticuliere')->get();
        // $annonces_particulier = AnnonceParticuliere::with('product','user')->get();

        return view('admin.GestionAnnonces',compact('annonces'));
    }
    public function delete($id)
    {
        $annonce = annonces::find($id);

        if (!$annonce) {
            return redirect()->back()->with('error', 'Annonce not found.');
        }

        $annonce->delete();

        return redirect()->back()->with('success', 'Annonce deleted successfully.');
    }

    public function viewdetails($id)
    {
        $user = User::findOrFail($id);
        $annoncesCount = annonces::where('user_id', $id)->count();
        $ReclamationCount = Reclamation::where('user_id', $id)->count();
        $demandeCount = demandes::where('user_id', $id)->count();

        $feedback = feedback_clients::where('id', $id)->first(); // récupérer le feedback correspondant à l'ID donné
        if(isset($feedback)){
            $partnerRating = $feedback->nb_stars;
            return view('admin.DetailsUser', compact('user', 'annoncesCount','ReclamationCount','demandeCount' ,'partnerRating'));
        }
        else {
            return view('admin.DetailsUser', compact('user', 'annoncesCount','ReclamationCount','demandeCount'));
        }
    }

}
