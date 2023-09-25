<?php

namespace App\Http\Livewire;

use App\Models\annonces;
use App\Models\carts;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
class CategoryComponent extends Component
{
    use WithPagination;
    public $pageSize =12;
    public $orderBy="Default Sorting";
    public $slug;
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
    // public function store($product_id,$product_name,$product_price) {
    //     \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->add($product_id,$product_name,1,$product_price);
    //     session()->flash('success_message','Item added in Cart');
    //     $this->emitTo('cart-icon-component','refreshComponent');
    //     return redirect()->route('shop.cart');
    // }
    public function changePageSize($size){
        $this->pageSize=$size;
    }
    public function changeOrderBy($order){
        $this->orderBy=$order;
    }
    public function mount($slug){
        $this->slug = $slug;
    }
    public function render()
    {
        $category=Category::where('slug',$this->slug)->first();
        $category_id=$category->id;
        $category_name=$category->name;
        if($this->orderBy == 'Price: Low to High'){
            $annonces = annonces::with('product')
            ->where('annonces.user_id','<>',auth()->id())
            ->whereHas('product', function($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })->whereBetween('sale_price', [$this->min_value, $this->max_value])
            ->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Price: High to Low'){
            $annonces = annonces::with('product')
            ->where('annonces.user_id','<>',auth()->id())
            ->whereHas('product', function($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })->whereBetween('sale_price', [$this->min_value, $this->max_value])
            ->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Sort By Newness'){
            $annonces = annonces::with('product')
            ->where('annonces.user_id','<>',auth()->id())
            ->whereHas('product', function($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })->whereBetween('sale_price', [$this->min_value, $this->max_value])
            ->paginate($this->pageSize);
        }
        else{
            $annonces = annonces::with('product')
            ->where('annonces.user_id','<>',auth()->id())
            ->whereHas('product', function($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })->whereBetween('sale_price', [$this->min_value, $this->max_value])
            ->paginate($this->pageSize);
        }
        $annoncesFeatured = annonces::with('product')
            ->orderBy('regular_price', 'DESC')
            ->limit(3)
            ->get();
        $categories=Category::orderBy('name','ASC')->get();
        return view('livewire.category-component',['annonces'=>$annonces,'categories'=>$categories,'category_name'=>$category_name, 'annoncesFeatured'=>$annoncesFeatured]);
    }
    
}
