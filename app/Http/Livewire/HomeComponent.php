<?php

namespace App\Http\Livewire;

use App\Models\annonces;
use App\Models\carts;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class HomeComponent extends Component
{
    use WithPagination;
    public $pageSize =12;
    public $orderBy="Default Sorting";
    public $min_value=0;
    public $max_value=1000;
    public function store($product_id, $product_name, $product_price, $from, $to)
    {
        // Récupérer le produit correspondant à l'ID
        $product = \App\Models\Product::find($product_id);

        // Générer une liste de dates entre les dates 'from' et 'to'
        $dates = collect([]);
        $start_date = Carbon::createFromFormat('Y-m-d', $from);
        $end_date = Carbon::createFromFormat('Y-m-d', $to);
        while ($start_date->lte($end_date)) {
            $dates->push($start_date->format('Y-m-d'));
            $start_date->addDay();
        }

        // Ajouter le produit et ses dates disponibles dans le panier
        $cartItem = Cart::instance('cart')->add($product_id, $product_name, 1, $product_price, ['from' => $from, 'to' => $to, 'dates' => $dates]);

        // Afficher le message de succès et rediriger vers la page du panier
        session()->flash('success_message', 'Item added in Cart');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('shop.cart');
    }
    public function changePageSize($size){
        $this->pageSize=$size;
    }
    public function changeOrderBy($order){
        $this->orderBy=$order;
    }
    public function addToWishlist($product_id,$product_name,$product_price){
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-icon-component','refreshComponent');
    }
    public function removeFromWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $witem )
        {
            if($witem->id==$product_id){
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-icon-component','refreshComponent');
                return;
            }
        }
    }
    public function render()
    {
        // if($this->orderBy== 'Price: Low to High'){
        //     $annonces = DB::table('annonces')
        //     ->join('products', 'products.id', '=', 'annonces.products_id')
        //     ->select('annonces.*', 'products.*')
        //     ->where('annonces.stat','=',1)
        //     ->whereBetween('regular_price', [$this->min_value, $this->max_value])
        //     ->orderBy('regular_price', 'ASC')
        //     ->paginate($this->pageSize);
        // }
        // else if($this->orderBy== 'Price: High to Low'){
        //     $annonces = DB::table('annonces')
        //     ->join('products', 'products.id', '=', 'annonces.products_id')
        //     ->select('annonces.*', 'products.*')
        //     ->where('annonces.stat','=',1)
        //     ->whereBetween('regular_price', [$this->min_value, $this->max_value])
        //     ->orderBy('regular_price', 'DESC')
        //     ->paginate($this->pageSize);
        // }
        // else if($this->orderBy== 'Sort By Newness'){
        //     $annonces = DB::table('annonces')
        //     ->join('products', 'products.id', '=', 'annonces.products_id')
        //     ->select('annonces.*', 'products.*')
        //     ->where('annonces.stat','=',1)
        //     ->whereBetween('regular_price', [$this->min_value, $this->max_value])
        //     ->orderBy('annonces.created_at','DESC')
        //     ->paginate($this->pageSize);
        // }
        // else{
        //     $annonces = DB::table('annonces')
        //     ->join('products', 'products.id', '=', 'annonces.products_id')
        //     ->select('annonces.*', 'products.*')
        //     ->where('annonces.stat','=',1)
        //     ->whereBetween('regular_price', [$this->min_value, $this->max_value])
        //     ->orderBy('regular_price', 'DESC')
        //     ->paginate($this->pageSize);
        // }
        $categories=Category::orderBy('name','ASC')->get();
        $annoncesDate = annonces::with('product.image')
            ->where('annonces.user_id','<>',auth()->id())
            ->where('annonces.stat','=',1)
            ->orderBy('created_at', 'DESC')
            ->paginate($this->pageSize);
        $annoncesFeatured = annonces::with('product')
            ->where('annonces.user_id','<>',auth()->id())
            ->where('annonces.stat','=',1)
            ->orderBy('regular_price', 'DESC')
            ->paginate($this->pageSize);
        
        return view('livewire.home-component',['categories'=>$categories,'annoncesDate'=>$annoncesDate,'annoncesFeatured'=>$annoncesFeatured]);
    }
}
