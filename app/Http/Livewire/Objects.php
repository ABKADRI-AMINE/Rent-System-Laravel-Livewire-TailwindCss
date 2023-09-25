<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class Objects extends Component
{
    public $categories ;
    public $categorieId ; 
    public $objects ; 
    public $objectId ; 

    protected $rules = [
        'objects' => 'required',
        'objects.*.title' => 'required|string',
    ];

    public function mount() {
        $this->categories = Category::all() ; 
        $this->getObjects();
    }
    public function updatedCategorieId() {
        $this->getObjects();
    }
    public function getObjects() {
        if($this->categorieId !=''){
            $this->objects = Product::where('user_id', auth()->id())->where('category_id' , $this->categorieId)->get();
        }
        else{
            $this->objects = []; 
        }
    }
    public function render()
    {
        return view('livewire.objects');
    }
}
