<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'telephone',
        'password',
        'isBan',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function annonces()
    {
        return $this->hasMany(annonces::class);
    }

    public function demandes()
    {
        return $this->hasMany(demandes::class);
    }

    public function feedbackArticle(){
        return $this->hasMany(feedback_articles::class);
    }

    public function carts(){
        return $this->hasMany(carts::class);
    }

    public function feedbackFrom(){
        return $this->hasMany(feedback_clients::class,'partner_id');
    }

    public function feedbackTo(){
        return $this->hasMany(feedbackClient::class,'client_id');
    }
    public function reclamation()
    {
        return $this->hasMany(Reclamation::class);
    }

}
