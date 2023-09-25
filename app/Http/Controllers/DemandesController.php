<?php

namespace App\Http\Controllers;

use id;
use Carbon\Carbon;
use App\Models\User;
use App\Models\annonces;
use App\Models\demandes;
use App\Mail\emailbyAmine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DemandesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id)
    {
        $annonce = annonces::findOrFail($id);
        $startDateDB = Carbon::parse($annonce->from);
        $endDateDB = Carbon::parse($annonce->to);
        $currentDate = Carbon::now();
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
        $diff = $startDate->diffInDays($endDate);


        if ($endDate->lessThanOrEqualTo($endDateDB) && $startDate->greaterThanOrEqualTo($startDateDB) && $diff >= $annonce->minday-1) {
            $reservedDates = json_decode($annonce->reserved_dates, true) ?? [];

        // Check for any overlapping reservation dates
        foreach ($reservedDates as $dates) {
            if ($startDate <= $dates['end_date'] && $endDate >= $dates['start_date']) {
                return response()->json(['success' => false, 'message' => 'The object is already reserved during this time period.']);
            }
        }
        if($annonce->premium == '1') {
            $availableDaysOfWeek = $annonce->annonceParticuliere->getDisponibleDaysAttribute($annonce->annonceParticuliere->disponible_days); 
            $available_days = 0;
            $available_dates = [];
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $dayOfWeek = strtolower($date->format('l'));
            
                if (in_array($dayOfWeek, $availableDaysOfWeek)) {
                    $available_days++;
                    $available_dates[] = $date->toDateString();
                }
            } 
            if($available_days > 0 && $available_days >= $annonce->minday){
                $reservedDates[] = [
                    'start_date' => Carbon::parse($request->input('start_date')),
                    'end_date' => Carbon::parse($request->input('end_date')),
                ];
                // Update the annonce's reserved_dates column with the new array
                $annonce->update(['reserved_dates' => $reservedDates]);
                // Create a new reservation record
                $demande = new demandes([
                    'annonce_id' =>  $id,
                    'user_id' => auth()->id(),
                    'reservation_Ddate' => Carbon::parse($request->input('start_date')), 
                    'reservation_Fdate' => Carbon::parse($request->input('end_date')), 
                ]);
                $demande->save();             
            }
            else {
                return response()->json(['success' => false, 'message' => 'Problem with nombre of days reserved!']);
            }
        }
        else {
            // Add new reservation dates to the reserved_dates array
            $reservedDates[] = [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];
            // Update the annonce's reserved_dates column with the new array
            $annonce->update(['reserved_dates' => $reservedDates]);
            // Create a new reservation record
            $demande = new demandes([
                'annonce_id' => $id,
                'user_id' => auth()->id(),
                'reservation_Ddate' => $startDate, 
                'reservation_Fdate' => $endDate, 
            ]);
            $demande->save();          
        }
            if($demande){
                $annonce->stat = 0 ; 
                $annonce->save() ;
                $annonce=annonces::where('id', $annonce->id)->first();
                //dd($annonce);
                
                // Get the number of annonces with a status of "enlign"
                $enlignCount = annonces::where('stat', 1)->where('user_id' , $annonce->user_id)->count();
                // dd($enlignCount);
                
                // Check if there are fewer than 5 annonces with a status of "enlign"
                if ($enlignCount <= 5) {
                    // Set the status of the new annonce to "enlign"
                    annonces::where('stat', 2)->where('user_id' , $annonce->user_id)->update(['stat' => 1]);
                    
                } else {
                    // Set the status of the new annonce to "en attente"
                    // $annonce->stat = 2;
                }
        
        
                // le reste du code pour envoyer un email et afficher des messages flash
        
                $annonce = DB::table('annonces')
                    ->join('users', 'users.id', '=', 'annonces.user_id')
                    ->join('products', 'products.id', '=', 'annonces.products_id')
                    ->select('annonces.*', 'users.*', 'products.*')
                    ->where('annonces.id', '=', $id)
                    ->first();
                $user = User::findOrFail($annonce->user_id);
                // Send email in background using Laravel's Queue system
                Mail::to($annonce->email)
                    ->queue(new emailbyAmine($user->email,$annonce));
            }
            if (isset($available_days)) {
                $dates_list = '<ul>';
                foreach ($available_dates as $date) {
                    $dates_list .= '<li>' . $date . '</li>';
                }
                $dates_list .= '</ul>';
                $message = 'Demande Sended successfully!<br><br> Number Of days reserved : ' . $available_days . '<br>Wich are on those dates:<br>' . $dates_list;
                return response()->json(['success' => true, 'message' => $message]);
            } else {
                return response()->json(['success' => true, 'message' => 'Demande Sended successfully!']);
            }            
    } else {
        return response()->json(['success' => false, 'message' => 'Demande Not Sended! verify the entered dates']);
    }

}
}