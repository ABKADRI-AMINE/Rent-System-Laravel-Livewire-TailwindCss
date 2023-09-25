<?php

namespace App\Http\Livewire;

use App\Models\annonces;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class SearchComponent extends Component
{
    use WithPagination;
    public $pageSize =12;
    public $orderBy="Default Sorting";
    public $q;
    public $search_term;
    public $priceRange = [0, 100];
    public $min_value;
    public $max_value;
    public function mount(){
        $this->fill(request()->only('q'));
        $this->search_term = '%'.$this->q . '%';
    }
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        $this->emitTo('cart-icon-component','refreshComponent');
        return redirect()->route('shop.cart');
    }
    // public function getPriceRange($value)
    // {
    //     $this->priceRange = explode(',', $value);
    // }
    // public function getMinPrice()
    // {
    //     return $this->priceRange[0] ?? 0;
    // }

    // public function getMaxPrice()
    // {
    //     return $this->priceRange[1] ?? 100;
    // }

    public function changePageSize($size){
        $this->pageSize=$size;
    }
    public function changeOrderBy($order){
        $this->orderBy=$order;
    }

    public function render()
    {
        if($this->orderBy== 'Price: Low to High'){
            // $products = Product::where('name','like',$this->search_term)->orderBy('regular_price','ASC')->paginate($this->pageSize);
            $products = DB::table('annonces')
            ->join('products', 'products.id', '=', 'annonces.products_id')
            ->select('annonces.*', 'products.*')
            ->where('products.title','like',$this->search_term)
            ->orWhere('annonces.city', 'like', '%' . $this->search_term . '%')
            // ->whereBetween('regular_price', [$this->min_value, $this->max_value])
            ->orderBy('sale_price', 'ASC')
            ->paginate($this->pageSize);
        }
        else if($this->orderBy== 'Price: High to Low'){
            $products = DB::table('annonces')
            ->join('products', 'products.id', '=', 'annonces.products_id')
            ->select('annonces.*', 'products.*')
            ->where('products.title','like',$this->search_term)
            ->orWhere('annonces.city', 'like', '%' . $this->search_term . '%')
            // ->whereBetween('sale_price', [$this->min_value, $this->max_value])
            ->orderBy('regular_price','DESC')
            ->paginate($this->pageSize);
        }
        else if($this->orderBy== 'Sort By Newness'){
            $products = DB::table('annonces')
            ->join('products', 'products.id', '=', 'annonces.products_id')
            ->select('annonces.*', 'products.*')
            ->where('products.title','like',$this->search_term)
            ->orWhere('annonces.city', 'like', '%' . $this->search_term . '%')
            ->orderBy('annonces.created_at','DESC')
            ->paginate($this->pageSize);
        }
        else{
            // $products = annonces::with('product')
            // ->where('products.title','like',$this->search_term)
            // ->paginate($this->pageSize);
            $products = DB::table('annonces')
            ->join('products', 'products.id', '=', 'annonces.products_id')
            ->select('annonces.*', 'products.*')
            ->where('products.title','like',$this->search_term)
            ->orWhere('annonces.city', 'like', '%' . $this->search_term . '%')
            ->paginate($this->pageSize);
        }
        $categories=Category::orderBy('name','ASC')->get();
        return view('livewire.search-component',['products'=>$products,'categories'=>$categories]);
    }
}
