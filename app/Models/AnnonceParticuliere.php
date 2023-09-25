<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnonceParticuliere extends Model
{
    use HasFactory;
    protected $table = "annonce_particuliere" ; 

    public function annonce()
    {
        return $this->belongsTo(annonces::class);
    }

    public function getDisponibleDaysAttribute($value)
    {
        return json_decode($value);
    }

    public function setDisponibleDaysAttribute($value)
    {
        $this->attributes['disponible_days'] = json_encode($value);
    }
}
