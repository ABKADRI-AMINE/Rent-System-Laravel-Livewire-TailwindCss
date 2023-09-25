<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\carts;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
class NavbarDropDown extends Component
{
    use WithPagination;

    public function render()
    {

        $categories=Category::orderBy('name','ASC')->limit(5)->get();
        $categorieslimit=Category::orderBy('name','ASC')->skip(5)->take(PHP_INT_MAX)->get();
        return view('livewire.navbar-drop-down',['categories'=>$categories,'categorieslimit'=>$categorieslimit]);

    }
}
