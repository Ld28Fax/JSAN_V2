<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home_liste(){
        try{
            $demandeurs = DB::table('demandeur')->orderBy('created_at', 'desc')->where('usertpi', '=', Auth::id())->orderBy('etat', 'asc')->get();
            $nombreDemandeurs = DB::table('demandeur')->where('usertpi', '=', Auth::id())->count();
            $nombreDemandeursActif = DB::table(table: 'demandeur')->where('usertpi', '=', Auth::id())->where('etat','=',1)->count();
            $nombreDemandeursInactif = DB::table(table: 'demandeur')->where('usertpi', '=', Auth::id())->where('etat','=',0)->count();
            $nombreDemandeursRefusé = DB::table(table: 'demandeur')->where('usertpi', '=', Auth::id())->where('etat','=',2)->count();

            return view('home')->with('demandeurs', $demandeurs)->with('nombreDemandeurs', $nombreDemandeurs)->with('nombreDemandeursActif', $nombreDemandeursActif)->with('nombreDemandeursInactif', $nombreDemandeursInactif)->with('nombreDemandeursRefusé', $nombreDemandeursRefusé);
        } 
        catch (\Exception $e){
            return redirect()->back()->withErrors("error", $e->getMessage());
        }
    }
}
