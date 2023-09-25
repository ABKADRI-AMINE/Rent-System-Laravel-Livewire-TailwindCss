<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\annonces;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    protected $table = 'products'; 

    public function user(){
        return $this->belongsTo(User::class , 'user_id'); 
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    //with annonce : 
    public function annonces()
    {
        return $this->hasMany(annonces::class);
    }
    //relation between Object and Images : 
    public function image()
    {
        return $this->hasMany(Image::class);
    }
    public function feedbackArticles()
    {
        return $this->hasMany(feedback_articles::class);
    }
}
