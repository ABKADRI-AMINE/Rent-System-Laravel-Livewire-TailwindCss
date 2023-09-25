<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;

class ReclamationController extends Controller
{
    public function create()
    {
        return view('partenaire.reclamation');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sujet' => 'required',
            'contenue' => 'required',
        ]);
    
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['status'] = false;
    
        $reclamation = Reclamation::create($validatedData);
    
        return redirect('/')->with('success', 'Complaint has been submitted.');
    }
}
