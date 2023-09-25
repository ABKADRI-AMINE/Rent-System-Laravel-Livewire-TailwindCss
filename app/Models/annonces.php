<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class annonces extends Model
{
    protected $table = 'annonces' ; 
    use HasFactory;
    public function product(){
        return $this->belongsTo(Product::class,'products_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function annonceParticuliere()
    {
        return $this->hasOne(AnnonceParticuliere::class);
    }
}
