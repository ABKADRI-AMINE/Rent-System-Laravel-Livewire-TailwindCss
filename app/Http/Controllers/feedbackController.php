<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\demandes;
use Illuminate\Http\Request;
use App\Models\feedback_clients;
use App\Models\feedback_articles;

class feedbackController extends Controller
{
    public $clientHasFeedback = false;
    public $partnerHasFeedback = false;


    public function create($demandeId, $id)
    {
        if (auth()->user()->role == 1)
            return view("feedback/feedbackPartner", ['demandeId' => $demandeId, 'id' => $id]);

        if (auth()->user()->role == 2) {
            $demandes = demandes::join('annonces', 'annonces.id', '=', 'demandes.annonce_id')
                ->join('products', 'products.id', '=', 'annonces.products_id')
                ->select('annonces.*', 'products.*', 'demandes.*')
                ->where('demandes.id', '=', $demandeId)
                ->first();
            $feedback = feedback_articles::where('feedback_articles.product_id', '=', $demandes->annonces->product->id)->count();
            $feedback_info = feedback_articles::where('feedback_articles.product_id', '=', $demandes->annonces->product->id)->get();

            $stars_count=feedback_articles::where('feedback_articles.product_id', '=', $demandes->annonces->product->id)->sum('nb_stars');
            $stars1 = feedback_articles::where('product_id', $demandes->annonces->product->id)
            ->where('nb_stars', 1)
            ->count();
            $stars2 = feedback_articles::where('product_id', $demandes->annonces->product->id)
            ->where('nb_stars', 2)
            ->count();
            $stars3 = feedback_articles::where('product_id', $demandes->annonces->product->id)
            ->where('nb_stars', 3)
            ->count();
            $stars4 = feedback_articles::where('product_id', $demandes->annonces->product->id)
                           ->where('nb_stars', 4)
                           ->count();

                           $stars5 = feedback_articles::where('product_id', $demandes->annonces->product->id)
                           ->where('nb_stars', 5)
                           ->count();
            return view("feedback/feedbackClient", ['demandeId' => $demandeId, 'id' => $id, 'demandes' => $demandes, 'feedback' => $feedback, 'feedback_info' => $feedback_info, 'stars_count' => $stars_count, 'stars1' => $stars1, 'stars2' => $stars2, 'stars3' => $stars3, 'stars4' => $stars4, 'stars5' => $stars5]);
        }
    }
    public function store(Request $request)
    {
        if (auth()->user()->role == 1) {
            feedback_clients::create([
                'partner_id' => auth()->user()->id,
                'client_id' => $request['user_id'],
                'nb_stars' => $request['star'],
                'comment' => $request['comment'],
                'status' => $request['feedback'],// 0 positive - 1 negative
            ]);

            demandes::findOrFail($request['demande_id'])->update([
                'feedbackClient' => 'done',
            ]);

            return redirect()->route('home.index');
        }

        if (auth()->user()->role == 2) {
            feedback_articles::create([
                'product_id' => $request['product_id'],
                'user_id' => auth()->user()->id,
                'nb_stars' => $request['star'],
                'comment' => $request['comment'],
                'status' => $request['feedback'],// 0 positive - 1 negative 
            ]);

            demandes::findOrFail($request['demande_id'])->update([
                'feedbackArticle' => 'done',
            ]);

            return redirect()->route('home.index');
        }
    }
}
