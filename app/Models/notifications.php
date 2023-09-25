<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifications extends Model
{
    use HasFactory;

    protected $fillable =[
        'demande_id',
        'message'
    ];

    public function demande(){
        return $this->belongsTo(demandes::class);
    }
}
