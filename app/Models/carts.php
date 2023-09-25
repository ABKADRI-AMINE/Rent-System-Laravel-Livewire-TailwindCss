<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
    use App\Models\User;
class carts extends Model
{
    use HasFactory;
    protected $fillable = [
        'annonce_id',
        'user_id',
    ];
    public function Product(){
        return $this->belongsTo(Product::class,'annonce_id');
    }
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
