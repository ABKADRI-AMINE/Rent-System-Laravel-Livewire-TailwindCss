<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demandes extends Model
{
    protected $fillable = [
        'annonce_id',
        'user_id',
    ];
    public function products(){
        return $this->belongsTo(Product::class,'products_id');
    }
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function annonces(){
        return $this->belongsTo(annonces::class,'annonce_id');
    }
}
