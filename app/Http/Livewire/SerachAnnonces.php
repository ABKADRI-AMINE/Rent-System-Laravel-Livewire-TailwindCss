<?php

namespace App\Http\Livewire;

use App\Models\annonces;
use Livewire\Component;
use Livewire\WithPagination;

class SerachAnnonces extends Component
{
    use WithPagination;
    public $searchTerm;
 
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $annonces = annonces::where('user_id' ,'=', auth()->id())
        ->where(function ($query) use ($searchTerm) {
            $query->where('city', 'like', $searchTerm)
                ->orWhere('updated_at', 'like', $searchTerm)
                ->orWhere('created_at', 'like', $searchTerm)
                ->orWhere('regular_price', 'like', $searchTerm)
                ->orWhereHas('product', function($query) use ($searchTerm) {
                    $query->where('title', 'like', $searchTerm);
                })
                ->orWhereHas('product.category', function($query) use ($searchTerm) {
                    $query->where('name', 'like', $searchTerm);
                });
        })
        ->paginate(4);
         return view('livewire.serach-annonces',[
            'annonces' => $annonces
        ]);
    }
}