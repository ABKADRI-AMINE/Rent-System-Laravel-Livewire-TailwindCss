<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\carts;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
class Nav extends Component
{
    use WithPagination;

    public function render()
    {

        $categories=Category::orderBy('name','ASC')->get();
        return view('livewire.nav',['categories'=>$categories]);

    }
}
