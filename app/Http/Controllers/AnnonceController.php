<?php

namespace App\Http\Controllers;

use App\Models\annonces;
use Illuminate\Http\Request;
use App\Models\AnnonceParticuliere;
use App\Models\Category;
use App\Models\feedback_articles;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.annonces') ; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all() ; 
        return view('partenaire.ajouterAnnonce' , compact('categories')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'object_id' => 'required',
            'ville' => 'required', 
            'jours_min' => 'required',
            'price' => 'required', 
            'date_debut' =>'required|date',
            'date_fin' => 'required|date|after:date_debut',  
            'disponibility' => 'nullable|array'
        ]);
    
        $validatedData['user_id'] = auth()->id();
        $date1 = Carbon::parse($validatedData['date_debut']);
        $date2 = Carbon::parse($validatedData['date_fin']);
        $diff = $date1->diffInDays($date2);
        // Create a new Annonce instance with validated form data
        if($date1->lt($date2) && $diff >= $validatedData['jours_min']){
            $annonce = new annonces([
                'products_id' => $validatedData['object_id'],
                'city' => $validatedData['ville'],
                'minday' => $validatedData['jours_min'],
                'regular_price' => $validatedData['price'],
                'sale_price' => $validatedData['price'],
                'from' => $validatedData['date_debut'],
                'to' => $validatedData['date_fin'],
                'user_id' => $validatedData['user_id'] 
            ]);
        }
        else {
            return redirect('/addAnnonce')->with('message' , 'une probleme dans les dates selectionnés!') ; 
        }
    
        // Save the Annonce instance to the database
        $annonce->save();
        
        if ($annonce) {
            // Get the number of annonces with a status of "enlign"
            $enlignCount = Annonces::where('stat', 1)->where('user_id' , auth()->id())->count();
    
            // Check if there are fewer than 5 annonces with a status of "enlign"
            if ($enlignCount <= 5) {
                // Set the status of the new annonce to "enlign"
                $annonce->stat = 1;
            } else {
                // Set the status of the new annonce to "en attente"
                $annonce->stat = 2;
            }
    
            // Save the updated status to the database
            $annonce->save();
    
            // Check if the annonce is a particuliere annonce
            if (!empty($validatedData['disponibility'])) {
                // Create a new AnnonceParticuliere instance with validated form data
                $annonce->premium = '1';
                $annonceParticuliere = new AnnonceParticuliere([
                    'annonces_id' => $annonce->id,
                    'disponible_days' => json_encode($validatedData['disponibility'])
                ]);
                $annonce->save();
                // Save the AnnonceParticuliere instance to the database
                $annonceParticuliere->save();
            }
    
            return redirect('/mesAnnonces')->with('message' , 'Annonce postée avec succès !');
        }
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(annonces $annonce){
        if($annonce->premium =='1'){
            $annonce_particulire = $annonce->annonceParticuliere(); 
        }
        $objects = Product::where('user_id' , auth()->id())->get() ; 
        $feedback = feedback_articles::where('feedback_articles.product_id', '=', $annonce->product->id)->count();
        $feedback_info = feedback_articles::where('feedback_articles.product_id', '=', $annonce->product->id)->get();

        $stars_count = feedback_articles::where('feedback_articles.product_id', '=', $annonce->product->id)->sum('nb_stars');
        $stars1 = feedback_articles::where('product_id', $annonce->product->id)
            ->where('nb_stars', 1)
            ->count();
        $stars2 = feedback_articles::where('product_id', $annonce->product->id)
            ->where('nb_stars', 2)
            ->count();
        $stars3 = feedback_articles::where('product_id', $annonce->product->id)
            ->where('nb_stars', 3)
            ->count();
        $stars4 = feedback_articles::where('product_id', $annonce->product->id)
            ->where('nb_stars', 1)
            ->count();

        $stars5 = feedback_articles::where('product_id', $annonce->product->id)
            ->where('nb_stars', 5)
            ->count();
        return view('partenaire.showAnnonce', [
            'annonce' => $annonce ,'objects' => $objects,  'feedback' => $feedback, 'feedback_info' => $feedback_info, 'stars_count' => $stars_count, 'stars1' => $stars1, 'stars2' => $stars2, 'stars3' => $stars3, 'stars4' => $stars4, 'stars5' => $stars5 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(annonces $annonce)
    {
        return view('partenaire.editAnnonce' , ['annonce' => $annonce]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Retrieve the Annonce to be updated
       $annonce = annonces::findOrFail($id);
        // Validate form data
        $validatedData = $request->validate([
        'object_id' => 'required',
        'ville' => 'required', 
        'jours_min' => 'required',
        'price' => 'required', 
        'date_debut' =>'required|date',
        'date_fin' => 'required|date|after:date_debut',  
        'disponibility' => 'nullable|array'
        ]);
        $validatedData['user_id'] = auth()->id();
        $date1 = Carbon::parse($validatedData['date_debut']);
        $date2 = Carbon::parse($validatedData['date_fin']);

        // Get the old start and end dates
        $old_start_date = Carbon::parse($annonce->from);
        $old_end_date = Carbon::parse($annonce->to);
        $diff = $date1->diffInDays($date2);

            // Check if the new dates overlap with the old dates
        // if ($date1 < $old_end_date && $date2 > $old_start_date) {
        //     return redirect()->back()->with('message', 'The new dates conflict with the old dates.');
        // }

        // Check if the new dates overlap with the reserved dates
        $reserved_dates = json_decode($annonce->reserved_dates, true) ?? [];
        foreach ($reserved_dates as $reserved_date) {
            $reserved_start_date = Carbon::parse($reserved_date['start_date']);
            $reserved_end_date = Carbon::parse($reserved_date['end_date']);

            if ($date1 < $reserved_end_date && $date2 > $reserved_start_date) {
                return redirect()->back()->with('message', 'The new dates conflict with the reserved dates.');
            }
        }
        // Updated Annonce instance with validated form data
        if($date1->lt($date2) && $diff >= $validatedData['jours_min']){
            $annonce->products_id = $validatedData['object_id'] ; 
            $annonce->city = $validatedData['ville'] ; 
            $annonce->minday = $validatedData['jours_min'] ; 
            $annonce->regular_price = $validatedData['price'] ; 
            $annonce->sale_price = $validatedData['price'] ; 
            $annonce->from = $validatedData['date_debut'] ; 
            $annonce->to = $validatedData['date_fin'] ; 
            $annonce->user_id = $validatedData['user_id'] ; 
            $annonce->save(); 
        }
        else {
            return redirect('/mesAnnonces/'.$id)->with('message' , 'une probleme dans les dates selectionnés!') ; 
        }

        // Check if the annonce is a particuliere annonce
        if($annonce->premium == '0') {
            if (!empty($validatedData['disponibility'])) {
                // Create a new AnnonceParticuliere instance with validated form data
                $annonce->premium = '1';
                $annonceParticuliere = new AnnonceParticuliere([
                    'annonces_id' => $annonce->id,
                    'disponible_days' => json_encode($validatedData['disponibility'])
                ]);
                $annonce->save();
                // Save the AnnonceParticuliere instance to the database
                $annonceParticuliere->save();
                return redirect('/mesAnnonces/'.$id)->with('message' , 'Annonce updated Succecefuly!') ; 
            }
            else {
                return redirect('/mesAnnonces/'.$id)->with('message' , 'Annonce updated Succecefuly!') ; 
            }
        }
        else { 
            if (!empty($validatedData['disponibility'])) {
                // Create a new AnnonceParticuliere instance with validated form data
                $annonce->annonceParticuliere->disponible_days = json_encode($validatedData['disponibility']); 
                $annonce->save();
                // Save the Updated AnnonceParticuliere 
                $annonce->annonceParticuliere->save() ; 
                return redirect('/mesAnnonces/'.$id)->with('message' , 'Annonce updated Succecefuly!') ; 
            }
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //make the annonce offline : 
    public function offline(Request $request, $id) {
        $annonce = annonces::findOrFail($id);
        $annonce->stat = 0;
        $annonce->save() ;               
        // Get the number of annonces with a status of "enlign"
        $enlignCount = annonces::where('stat', 1)->where('user_id' , $annonce->user_id)->count();
        // dd($enlignCount);
        
        // Check if there are fewer than 5 annonces with a status of "enlign"
        if ($enlignCount <= 5) {
            // Set the status of the new annonce to "enlign"
            $annonceEnAt = annonces::where('stat', 2)->where('user_id' , $annonce->user_id)->first() ; 
            if($annonceEnAt) {
                $annonceEnAt->update(['stat' => 1]);
            }      
        } else {
            // Set the status of the new annonce to "en attente"
            // $annonce->stat = 2;
        }
        return redirect()->back()->with('message', 'Annonce offline now and an other annonce will be online!'); 
    }
    public function destroy($id) 
    {
        $annonce = annonces::findOrFail($id);
        $annonce->delete();
        return redirect('/mesAnnonces')->with('message' , 'Annonce deleted Succecefuly!') ; 

    }
}
