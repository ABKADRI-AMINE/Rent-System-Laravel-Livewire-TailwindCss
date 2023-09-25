<?php

namespace App\Http\Controllers;

use App\Mail\emailAmine;
use App\Mail\emailbyAmine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(){
        $user='Amine -Team-Location-Gi2';
        Mail::to('amine.abkadri@etu.uae.ac.ma')->cc('youssef.elmessbahi@etu.uae.ac.ma')->send(new emailbyAmine($user));
        return response('Mail Sent');
    }
}
