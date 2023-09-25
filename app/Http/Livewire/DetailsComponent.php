<?php

namespace App\Http\Livewire;

use App\Mail\emailbyAmine;
use App\Models\carts;
use App\Models\Product;
use Livewire\Component;

use App\Models\annonces;
use App\Models\Category;
use App\Models\demandes;
use Illuminate\Support\Carbon;
use App\Models\feedback_articles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DetailsComponent extends Component
{
    public $slug;
    public $productId;

    // public $startDate;
    // public $endDate;

    // public $available_days = 0;
    // public $available_dates = [];

    public function mount($slug, $id)
    {
        $this->slug = $slug;
        $this->productId = $id;
        // $this->endDate = annonces::find($id)->to;
        // $this->startDate = annonces::find($id)->from;
    }
    public function store($product_id, $product_name, $product_price)
    {   
        carts::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in cart');
        return redirect()->route('shop.cart');
    }

    public function render()
    {
        $categories=Category::orderBy('name','ASC')->get();
        $product = Product::with('category')->where('slug', $this->slug)->first();
        $annonce_price = annonces::with('product')
        ->find($this->productId);
        $annonce = annonces::where('id' , $this->productId)->first() ; 
        $annonces = annonces::with('product')
            ->join('products', 'annonces.products_id', '=', 'products.id')
            ->where('products.slug', '=', $this->slug)
            // ->where('annonces.products_id', '=', $this->productId)
            ->select('annonces.*')
            ->first();

        $feedback = feedback_articles::where('feedback_articles.product_id', '=', $annonces->product->id)->count();
        $feedback_info = feedback_articles::where('feedback_articles.product_id', '=', $annonces->product->id)->get();

        $stars_count = feedback_articles::where('feedback_articles.product_id', '=', $annonces->product->id)->sum('nb_stars');
        $stars1 = feedback_articles::where('product_id', $annonces->product->id)
            ->where('nb_stars', 1)
            ->count();
        $stars2 = feedback_articles::where('product_id', $annonces->product->id)
            ->where('nb_stars', 2)
            ->count();
        $stars3 = feedback_articles::where('product_id', $annonces->product->id)
            ->where('nb_stars', 3)
            ->count();
        $stars4 = feedback_articles::where('product_id', $annonces->product->id)
            ->where('nb_stars', 1)
            ->count();

        $stars5 = feedback_articles::where('product_id', $annonces->product->id)
            ->where('nb_stars', 5)
            ->count();
        $rproducts = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts = Product::latest()->take(4)->get();
        return view('livewire.details-component', ['product' => $product, 'rproducts' => $rproducts, 'nproducts' => $nproducts, 'feedback' => $feedback, 'feedback_info' => $feedback_info, 'stars_count' => $stars_count, 'stars1' => $stars1, 'stars2' => $stars2, 'stars3' => $stars3, 'stars4' => $stars4, 'stars5' => $stars5,'annonce_price'=>$annonce_price,'categories'=>$categories , 'annonce'=>$annonce]);
    }
}


/*
public function index(Request $request)
{
    $query = Annonce::query();

    // Check for any overlapping reservation dates and exclude those annonces
    if ($request->has('start_date') && $request->has('end_date')) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $
        // Retrieve annonces where the reserved_dates array is null or does not overlap with the selected dates
        $query->where(function ($query) use ($start_date, $end_date) {
            $query->whereNull('reserved_dates')
                  ->orWhere(function ($query) use ($start_date, $end_date) {
                      $query->where('reserved_dates', 'not like', '%"start_date":"' . $start_date . '%"')
                            ->orWhere('reserved_dates', 'not like', '%"end_date":"' . $end_date . '%"');
                  });
        });
    }

    $annonces = $query->get();

    return view('annonces.index', compact('annonces'));
}
*/