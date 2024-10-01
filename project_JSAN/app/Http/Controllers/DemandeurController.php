<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemandeurController extends Controller
{
    public function index()
    {
        return view('demandeurs.index');
    }


    // creation demandeurs
    public function create(Request $request){
        try{
            $request->validate([
                "Nom"=> "required|string|max:255",
                "Date_de_Naissance"=> "required",
                "Lieu_de_Naissance"=> "required|string|max:255",
                "Pere"=> "required|string|max:255",
                "Mere"=> "required|string|max:255",
                "Adresse"=> "required|string|max:255",
                'Telephone' => ['required', 'numeric', 'digits:10', 'regex:/^(032|033|034|037|038)[0-9]{7}$/'],
                'usertpi'=>'required',
            ], [
            'Telephone' => 'Le champ Téléphon doit être un nombre, contenir exactement 10 chiffres et commencer par 032, 033, 034, 037 ou 038.',
            'Nom' => 'Le champ Nom doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Date_de_Naissance' => 'Le champ Date de Naissance est requis.',
            'Lieu_de_Naissance' => 'Le champ Lieu de Naissance doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Pere' => 'Le champ Père doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Mere' => 'Le champ Mère doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Adresse' => 'Le champ Adresse doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.'
            ]);

            Demandeur::create($request->all());
            return redirect()->route("demandeurs.liste")->with("success","Demandeur enregister");

        } 
        catch (Exception $e){
            // throw new Exception($e->getMessage());
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    public function edit($id)
    {
    try{
        $demandeur = Demandeur::findOrFail($id);
        return view('demandeurs.edit')->with('demandeur', $demandeur);
    } catch (Exception $e){
        return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite.']);
    }
    }

    public function update(Request $request)
    {
    try{
        $request->validate([
            "Nom"=> "required|string|max:255",
            "Date_de_Naissance"=> "required",
            "Lieu_de_Naissance"=> "required|string|max:255",
            "Pere"=> "required|string|max:255",
            "Mere"=> "required|string|max:255",
            "Adresse"=> "required|string|max:255",
            'Telephone' => [ 'required','numeric', 'digits:10', 'regex:/^(032|033|034|038)[0-9]{7}$/'],
            'id' => "required"
        ],[
            'Telephone' => 'Le champ Téléphone est requis, doit être un nombre, contenir exactement 10 chiffres et commencer par 032, 033, 034 ou 038.',
            'Nom' => 'Le champ Nom est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Date_de_Naissance' => 'Le champ Date de Naissance est requis.',
            'Lieu_de_Naissance' => 'Le champ Lieu de Naissance est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Pere' => 'Le champ Père est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Mere' => 'Le champ Mère est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Adresse' => 'Le champ Adresse est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.'
        ]);
        Demandeur::modifier( $request->id, $request->Nom, $request->Date_de_Naissance, $request->Lieu_de_Naissance, $request->Pere, $request->Mere, $request->Adresse, $request->Telephone );
        return redirect()->route('demandeurs.liste')->with('success','Demandeur mis à jour avec succès.');
    } catch (Exception $e){
        // throw new Exception($e->getMessage());
        return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
    }

    }

    // Liste des demandeurs
    public function liste(){
        try{
            $demandeurs = DB::table('demandeur')->get()->where('usertpi', '=', Auth::id());

            $jour = DB::table('demandeur')->get()->where('created_at', '=', Carbon::now());

            return view('demandeurs.liste')->with('demandeurs', $demandeurs)->with('jour', $jour);

        } 
        catch (Exception $e){
            return redirect()->back()->withErrors("error", $e->getMessage());
        }
    }

    // exportation des demandeurs
    public function exportation(){
        try{
            $demandeurs = DB::table('demandeur')->get()->where('usertpi', '=', Auth::id());

            $nombreDemandeurs = DB::table('demandeur')->count();
            $nombreDemandeursActif = DB::table(table: 'demandeur')->where('etat','=',1)->count();
            $nombreDemandeursInactif = DB::table(table: 'demandeur')->where('etat','=',0)->count();

            return view('demandeurs.exportation')->with('demandeurs', $demandeurs)->with('nombreDemandeurs', $nombreDemandeurs)->with('nombreDemandeursActif', $nombreDemandeursActif)->with('nombreDemandeursInactif', $nombreDemandeursInactif);
        } 
        catch (Exception $e){
            return redirect()->back()->withErrors("error", $e->getMessage());
        }
    }

    // Activation d'une ligne 
    public function actif($id){
        try{
            Demandeur::Activer($id);
            return redirect()->back();
        }catch(Exception $e){
            // throw new Exception($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite.']);
        }
    }

    public function filter(Request $request)
    {
    $period = $request->get('period');
    $query = Demandeur::query();

    if ($period === 'day') {
        $query->whereDate('created_at', Carbon::today());
    } elseif ($period === 'week') {
        $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    } elseif ($period === 'month') {
        $query->whereMonth('created_at', Carbon::now()->month);
    }

    $demandeurPeriode = $query->get();

    return response()->json(['demandeurs' => $demandeurPeriode]);
    }

    public function DemandeursVerifier() {
        $DemandeursActifs = DB::table('demandeur')->where('etat', '=', 1)->get();
        
        return view('demandeurs.exportationVerifier')->with('DemandeursActifs', $DemandeursActifs);
    }
    
    public function DemandeurNonVerifier(){
        $DemandeursInactif = DB::table('demandeur')->where('etat', '=', 0)->get();
        // dd($DemandeursInactif);

        return view('demandeurs.exportationNonVerifier')->with('DemandeursInactif', $DemandeursInactif);
    }


}