<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use App\Models\Periode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'debut' => 'required|date',
            'fin' => 'required|date|after_or_equal:debut',
        ]);

        $periode = new Periode();
        $periode->debut = $request->debut;
        $periode->fin = $request->fin;
        $periode->save();

        return response()->json(['message' => 'Periode créer avec succès !']);
    }

    public function getStatistic(Request $request){
       try{
        $request->validate([
            'debut' => 'required|date',
            'fin' => 'required|date|after_or_equal:debut',
        ]);

        $statistic = DB::table('demandeur')->whereBetween('created_at', [$request->debut, $request->fin])->get();

        $statisticCount = DB::table('demandeur')->whereBetween('created_at', [$request->debut, $request->fin])->count();

        return view('Periode')->with('statistic', $statistic)->with('statisticCount', $statisticCount);
       }catch(Exception $e){
        throw new Exception($e->getMessage());
       }
    }
}
