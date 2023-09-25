<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\annonces;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{
    use WithPagination;
    public $pageSize =12;
    public $orderBy="Default Sorting";
    public $min_value=0;
    public $max_value=1000;
    public $q;
    public $search_term;

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
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price);
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
    public $from_date;
    public $to_date;
    public function mount()
    {
        $this->fill(request()->only('q'));
        $this->search_term = '%'.$this->q . '%';
        // Set default values for $from_date and $to_date
        $this->from_date = Carbon::now()->format('Y-m-d');
        $this->to_date = Carbon::now()->format('Y-m-d');
        
    }
    public function search()
    {
        // Validate that the from_date is less than the to_date
        if ($this->from_date > $this->to_date) {
            $this->addError('from_date', 'La date de début doit être inférieure à la date de fin.');
            session()->flash('error', 'La date de début doit être inférieure à la date de fin.');
            $this->from_date = Carbon::now()->format('Y-m-d');
            $this->to_date = Carbon::now()->format('Y-m-d');
            return;
        }
    }
    public function render()
    
    {
        $keyword=$this->search_term;
        $Ddate=$this->from_date;
        $Fdate=$this->to_date;
        $startDate = Carbon::createFromFormat('Y-m-d', $Ddate)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $Fdate)->startOfDay();
        if($this->orderBy== 'Price: Low to High'){
            
            
            $annonces = annonces::with('product')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[0].start_date') > ?", [$endDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[0].end_date') < ?", [$startDate])
                ->orWhereRaw("reserved_dates IS NULL or JSON_LENGTH(reserved_dates) = 0");
            })
            ->Where(function ($query) use ($startDate, $endDate) {
                $query->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].start_date') > ?", [$endDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].end_date') < ?", [$startDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].start_date') IS NULL ")
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].end_date') IS NULL ")
                ->orWhereRaw("reserved_dates IS NULL or JSON_LENGTH(reserved_dates) = 0");
            })
            ->where('annonces.user_id','<>',auth()->id())
            ->whereBetween('sale_price', [$this->min_value, $this->max_value])
            ->when($keyword, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('annonces.city', 'like', '%' . $this->search_term . '%')
                        ->orWhereHas('product', function ($query) {
                            $query->where('title', 'like', '%' . $this->search_term . '%');
                        });
                });
            })
            ->where('from','<=',$Ddate)
            ->where('to','>=',$Fdate)
            ->orderBy('regular_price', 'ASC')
            ->paginate($this->pageSize);
        }
        else if($this->orderBy== 'Price: High to Low'){
            $annonces = annonces::with('product')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[0].start_date') > ?", [$endDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[0].end_date') < ?", [$startDate])
                ->orWhereRaw("reserved_dates IS NULL or JSON_LENGTH(reserved_dates) = 0");
            })
            ->Where(function ($query) use ($startDate, $endDate) {
                $query->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].start_date') > ?", [$endDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].end_date') < ?", [$startDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].start_date') IS NULL ")
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].end_date') IS NULL ")
                ->orWhereRaw("reserved_dates IS NULL or JSON_LENGTH(reserved_dates) = 0");
            })
            ->where('annonces.user_id','<>',auth()->id())
            ->whereBetween('sale_price', [$this->min_value, $this->max_value])
            ->when($keyword, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('annonces.city', 'like', '%' . $this->search_term . '%')
                        ->orWhereHas('product', function ($query) {
                            $query->where('title', 'like', '%' . $this->search_term . '%');
                        });
                });
            })
            ->where('from','<=',$Ddate)
            ->where('to','>=',$Fdate)
            ->orderBy('regular_price', 'DESC')
            ->paginate($this->pageSize);
        }
        else if($this->orderBy== 'Sort By Newness'){
            $annonces = annonces::with('product')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[0].start_date') > ?", [$endDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[0].end_date') < ?", [$startDate])
                ->orWhereRaw("reserved_dates IS NULL or JSON_LENGTH(reserved_dates) = 0");
            })
            ->Where(function ($query) use ($startDate, $endDate) {
                $query->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].start_date') > ?", [$endDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].end_date') < ?", [$startDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].start_date') IS NULL ")
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].end_date') IS NULL ")
                ->orWhereRaw("reserved_dates IS NULL or JSON_LENGTH(reserved_dates) = 0");
            })
            ->where('annonces.user_id','<>',auth()->id())
            ->whereBetween('sale_price', [$this->min_value, $this->max_value])
            ->when($keyword, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('annonces.city', 'like', '%' . $this->search_term . '%')
                        ->orWhereHas('product', function ($query) {
                            $query->where('title', 'like', '%' . $this->search_term . '%');
                        });
                });
            })
            ->where('from','<=',$Ddate)
            ->where('to','>=',$Fdate)
            ->orderBy('annonces.created_at','DESC')
            ->paginate($this->pageSize);
        }
        else{
            $annonces = annonces::with('product')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[0].start_date') > ?", [$endDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[0].end_date') < ?", [$startDate])
                ->orWhereRaw("reserved_dates IS NULL or JSON_LENGTH(reserved_dates) = 0");
            })
            ->Where(function ($query) use ($startDate, $endDate) {
                $query->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].start_date') > ?", [$endDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].end_date') < ?", [$startDate])
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].start_date') IS NULL ")
                ->orWhereRaw("JSON_EXTRACT(reserved_dates, '$[1].end_date') IS NULL ")
                ->orWhereRaw("reserved_dates IS NULL or JSON_LENGTH(reserved_dates) = 0");
            })
            ->where('annonces.user_id','<>',auth()->id())
            ->whereBetween('sale_price', [$this->min_value, $this->max_value])
            ->when($keyword, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('annonces.city', 'like', '%' . $this->search_term . '%')
                        ->orWhereHas('product', function ($query) {
                            $query->where('title', 'like', '%' . $this->search_term . '%');
                        });
                });
            })
            ->where('from','<=',$Ddate)
            ->where('to','>=',$Fdate)
            ->paginate($this->pageSize);
        }
        $annoncesFeatured = annonces::with('product')
            ->where('annonces.user_id','<>',auth()->id())
            ->where('annonces.stat','=',1)
            ->orderBy('regular_price', 'DESC')
            ->limit(3)
            ->get();
        $categories=Category::orderBy('name','ASC')->get();
        return view('livewire.shop-component',['annoncesFeatured'=>$annoncesFeatured,'annonces'=>$annonces,'categories'=>$categories]);
    }
}