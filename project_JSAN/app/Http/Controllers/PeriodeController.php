<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use App\Models\Periode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{

    public function getStatistic(Request $request){
       try{
        $request->validate([
            'debut' => 'required|date',
            'fin' => 'required|date|after_or_equal:debut',
        ],[
            'debut' => 'Le champ Debut est requis et doit être au format DD-MM-YYYY.',
            'fin' => 'Le champ Fin est requis et doit être au format DD-MM-YYYY.'
        ]);

        $statistic = DB::table('demandeur')->whereBetween('created_at', [$request->debut, $request->fin])->get();

        $statisticCount = DB::table('demandeur')->whereBetween('created_at', [$request->debut, $request->fin])->count();

        return view('Periode')->with('statistic', $statistic)->with('statisticCount', $statisticCount);
       }catch(Exception $e){
        // throw new Exception($e->getMessage());
        return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
       }
    }
}
