<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashbordchartsController extends Controller
{
    /**
     * Afficher le nombre d'annonces par mois.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $annoncesParMois = DB::table('annonces')
            ->select(DB::raw('YEAR(`from`) as year, MONTH(`from`) as month, COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Préparer les données pour le graphique
        $labels = [];
        $data = [];
        foreach ($annoncesParMois as $row) {
            $labels[] = date('F Y', strtotime("$row->year-$row->month-01"));
            $data[] = $row->count;
        }

        $reservationsParMois = DB::table('demandes')
            ->select(DB::raw('YEAR(`reservation_Ddate`) as year, MONTH(`reservation_Ddate`) as month, COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Préparer les données pour le graphique
        $labelss = [];
        $dataa = [];
        foreach ($reservationsParMois as $roww) {
            $labelss[] = date('F Y', strtotime("$roww->year-$roww->month-01"));
            $dataa[] = $roww->count;
        }

        $reservationsParVille = DB::table('annonces')
            ->select('city', DB::raw('COUNT(*) as count'))
            ->groupBy('city')
            ->get();

        // Préparer les données pour le graphique
        $labelsss = [];
        $dataaa = [];
        foreach ($reservationsParVille as $rowww) {
            $labelsss[] = $rowww->city;
            $dataaa[] = $rowww->count;
        }

        $usersParRole = DB::table('users')
            ->select(DB::raw('CASE WHEN `role` = 2 THEN "Client" ELSE "Partenaire" END as role_name, COUNT(*) as count'))
            ->where('role', '=', 1)
            ->orWhere('role', '=', 2)
            ->groupBy('role_name')
            ->get();

// Préparer les données pour le graphique
        $labelssss = [];
        $dataaaa = [];
        foreach ($usersParRole as $rowwww) {
            $labelssss[] = $rowwww->role_name;
            $dataaaa[] = $rowwww->count;
        }


        $commentType = DB::table('feedback_clients')
            ->select(DB::raw('IF(status = 1, "négatif", "positif") as comment_type, COUNT(*) as count'))
            ->groupBy('comment_type')
            ->get();

// Préparer les données pour le graphique
        $labells = [];
        $datta = [];
        foreach ($commentType as $row) {
            $labells[] = $row->comment_type;
            $datta[] = $row->count;
        }
        // Charger la vue avec les donnes du graphique
        return view('Dashbordcharts', compact('labels', 'data','labelss', 'dataa','labelsss', 'dataaa','labelssss', 'dataaaa','labells', 'datta'));
    }

}
