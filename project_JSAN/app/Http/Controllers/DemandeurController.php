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
                'distrika' => 'required|string|max:255',
                'kaominina' => 'required|string|max:255',
                'interesse' => 'nullable|string|max:255',
                'genre' => 'required|in:masculin,feminin'
            ], [
            'Telephone' => 'Le champ Téléphone doit être un nombre, contenir exactement 10 chiffres et commencer par 032, 033, 034, 037 ou 038.',
            'Nom' => 'Le champ Nom doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Date_de_Naissance' => 'Le champ Date de Naissance est requis.',
            'Lieu_de_Naissance' => 'Le champ Lieu de Naissance doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Pere' => 'Le champ Père doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Mere' => 'Le champ Mère doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Adresse' => 'Le champ Adresse doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'distrika' => 'Le champ Distrika doit être une chaîne de caractères.',
            'kaominina' => 'Le champ Kaominina doit être une chaîne de caractères.',
            'interesse' => 'Le champ Interessé peut être une chaîne de caractères.',
            'genre' => 'Le champ Genre doit être masculin ou féminin.',
            
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
            'distrika' => 'required|string|max:255',
            'kaominina' => 'required|string|max:255',
            'interesse' => 'nullable|string|max:255',
            'numero' => 'required|string|max:255'
        ],[
            'Nom' => 'Le champ Nom doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Date_de_Naissance' => 'Le champ Date de Naissance est requis.',
            'Lieu_de_Naissance' => 'Le champ Lieu de Naissance doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Pere' => 'Le champ Père doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Mere' => 'Le champ Mère doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Adresse' => 'Le champ Adresse doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Telephone' => 'Le champ Téléphone doit être un nombre, contenir exactement 10 chiffres et commencer par 032, 033, 034 ou 038.',
            'distrika' =>'Le champ distrika doit être une chaîne de caractères et ne doit pas dépasser 255 caractères. ',
            'kaominina' =>'Le champ kaominina doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'numero' => 'Le champ numero doit être un nombre.'
        ]);
        $demandeur = Demandeur::modifier(
            $request->id, 
            $request->Nom, 
            $request->Date_de_Naissance, 
            $request->Lieu_de_Naissance, 
            $request->Pere, 
            $request->Mere, 
            $request->Adresse, 
            $request->Telephone, 
            $request->interesse, 
            $request->kaominina, 
            $request->distrika, 
            $request->numero
        );

        return redirect()->route('demandeurs.liste')->with('success', 'Demandeur mis à jour avec succès.')->with('demandeur', $demandeur);
    } catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }

    // Liste des demandeurs
    public function liste(){
        try{
            $demandeurs = DB::table('demandeur')->orderBy('created_at', 'desc')->where('usertpi', '=', Auth::id())->orderBy('etat', 'asc')->get();

            $jour = DB::table('demandeur')->get()->where('created_at', '>=', Carbon::today());

            return view('demandeurs.liste')->with('demandeurs', $demandeurs)->with('jour', $jour);

        } 
        catch (Exception $e){
            return redirect()->back()->withErrors("error", $e->getMessage());
        }
    }

    // exportation des demandeurs
    public function exportation(){
        try{
            $demandeurs = DB::table('demandeur')->orderBy('created_at', 'desc')->where('usertpi', '=', Auth::id())->where('etat_audience',true)->get();

            $audiences = DB::table('audience')
            ->join('demandeur', 'audience.id', '=', 'demandeur.audience_id')
            ->select('audience.*') 
            ->get();

            $nombreDemandeurs = DB::table('demandeur')->count();
            $nombreDemandeursActif = DB::table(table: 'demandeur')->where('etat','=',1)->count();
            $nombreDemandeursInactif = DB::table(table: 'demandeur')->where('etat','=',0)->count();
            $nombreDemandeursRefusé = DB::table(table: 'demandeur')->where('usertpi', '=', Auth::id())->where('etat','=',2)->count();

            return view('demandeurs.exportation')->with('demandeurs', $demandeurs)->with('nombreDemandeurs', $nombreDemandeurs)->with('nombreDemandeursActif', $nombreDemandeursActif)->with('nombreDemandeursInactif', $nombreDemandeursInactif)->with('audiences', $audiences)->with('nombreDemandeursRefusé', $nombreDemandeursRefusé);
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
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite.']);
        }
    }

    public function Inactif($id){
        try {
            $demandeur = Demandeur::find($id);
            if ($demandeur) {
                $demandeur->etat = 2;
                $demandeur->save();
            }
    
            return view('demandeurs.nonactif', ['demandeur' => $demandeur]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function filter(Request $request)
    {
    $period = $request->get('period');
    $query = Demandeur::where('usertpi', '=', Auth::id());

    if ($period === 'day') {
        $query->whereDate('created_at', Carbon::today());
    } elseif ($period === 'week') {
        $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    } elseif ($period === 'month') {
        $query->whereMonth('created_at', Carbon::now()->month);
    }elseif($period == 'tous'){
        
    }

    $demandeurPeriode = $query->orderBy('created_at', 'desc')->get();

    return response()->json(['demandeurs' => $demandeurPeriode]);
    }

    public function DemandeursVerifier() {
        $DemandeursActifs = DB::table('demandeur')->where('etat', '=', 1)->get();
        
        return view('demandeurs.exportationVerifier')->with('DemandeursActifs', $DemandeursActifs);
    }
    
    public function DemandeurNonVerifier(){
        $DemandeursInactif = DB::table('demandeur')->where('etat', '=', 0)->get();

        return view('demandeurs.exportationNonVerifier')->with('DemandeursInactif', $DemandeursInactif);
    }

    public function DemandeurRefusé(){
        $DemandeursRefusé = DB::table('demandeur')->where('etat', '=', 2)->get();

        return view('demandeurs.exportationRefusé')->with('DemandeursRefusé', $DemandeursRefusé);
    }

    public function Motif(Request $request, $id){
        try {
            $demandeur = Demandeur::find($id);
            $demandeur->motif = $request->input('motif');
            $demandeur->etat = 2; // Mise à jour de l'état à 2
            $demandeur->save();
            
            return redirect()->route('nonactif', ['id' => $demandeur->id])->with('success', 'Motif et état mis à jour avec succès.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    // public function Statistic(Request $request) {
    
    //     try {
    //         $debut_jour = $request->input('debut_jour');
    //         $debut_mois = $request->input('debut_mois');
    //         $fin_jour = $request->input('fin_jour');
    //         $fin_mois = $request->input('fin_mois');
    
    //         // Initialisation des variables
    //         $nombreDemandeursPeriode = $nombreDemandeursActifPeriode = $nombreDemandeursInactifPeriode = $nombreDemandeursRefuséPeriode = 0;
    
    //         if ($debut_jour && $debut_mois && $fin_jour && $fin_mois) {
    //             $annee = date('Y');
    //             $debut = "$annee-$debut_mois-$debut_jour";
    //             $fin = "$annee-$fin_mois-$fin_jour";
    
    //             if ($debut && $fin) {
    //                 $nombreDemandeursPeriode = DB::table('demandeur')
    //                     ->where('usertpi', '=', Auth::id())
    //                     ->whereBetween('created_at', [$debut, $fin])
    //                     ->count();
    
    //                 $nombreDemandeursActifPeriode = DB::table('demandeur')
    //                     ->where('usertpi', '=', Auth::id())
    //                     ->where('etat', '=', 1)
    //                     ->whereBetween('created_at', [$debut, $fin])
    //                     ->count();
    
    //                 $nombreDemandeursInactifPeriode = DB::table('demandeur')
    //                     ->where('usertpi', '=', Auth::id())
    //                     ->where('etat', '=', 0)
    //                     ->whereBetween('created_at', [$debut, $fin])
    //                     ->count();
    
    //                 $nombreDemandeursRefuséPeriode = DB::table('demandeur')
    //                     ->where('usertpi', '=', Auth::id())
    //                     ->where('etat', '=', 2)
    //                     ->whereBetween('created_at', [$debut, $fin])
    //                     ->count();
    //             } else {
    //                 return back()->withErrors('Les dates fournies ne sont pas valides.');
    //             }
    //         } else {
    //             // Logique pour compter sans période définie
    //             $nombreDemandeurs = DB::table('demandeur')->where('usertpi', '=', Auth::id())->count();
    //             $nombreDemandeursActif = DB::table('demandeur')->where('usertpi', '=', Auth::id())->where('etat', '=', 1)->count();
    //             $nombreDemandeursInactif = DB::table('demandeur')->where('usertpi', '=', Auth::id())->where('etat', '=', 0)->count();
    //             $nombreDemandeursRefusé = DB::table('demandeur')->where('usertpi', '=', Auth::id())->where('etat', '=', 2)->count();
    //         }
    
    //         return view('demandeurs.statistique')
    //             ->with('nombreDemandeursPeriode', $nombreDemandeursPeriode)
    //             ->with('nombreDemandeurs', $nombreDemandeurs)
    //             ->with('nombreDemandeursActifPeriode', $nombreDemandeursActifPeriode)
    //             ->with('nombreDemandeursActif', $nombreDemandeursActif)
    //             ->with('nombreDemandeursInactifPeriode', $nombreDemandeursInactifPeriode)
    //             ->with('nombreDemandeursInactif', $nombreDemandeursInactif)
    //             ->with('nombreDemandeursRefuséPeriode', $nombreDemandeursRefuséPeriode)
    //             ->with('nombreDemandeursRefusé', $nombreDemandeursRefusé);
    //     } catch (Exception $e) {
    //         return back()->withErrors(['message' => $e->getMessage()]);
    //     }
    // }

    public function filtrerStatistiques(Request $request)
{
    // Récupérer les données du formulaire
    $debut_jour = $request->input('debut_jour');
    $debut_mois = $request->input('debut_mois');
    $fin_jour = $request->input('fin_jour');
    $fin_mois = $request->input('fin_mois');

    // Créer la date de début et de fin à partir des entrées
    $debut = Carbon::create(null, $debut_mois, $debut_jour);
    $fin = Carbon::create(null, $fin_mois, $fin_jour)->endOfDay();

    // Filtrer les demandeurs en fonction de la période
    $nombreDemandeursPeriode = DB::table('demandeur')
        ->where('usertpi', '=', Auth::id())
        ->whereBetween('created_at', [$debut, $fin])
        ->count();
    
    $nombreDemandeursActifPeriode = DB::table('demandeur')
        ->where('usertpi', '=', Auth::id())
        ->where('etat', '=', 1)
        ->whereBetween('created_at', [$debut, $fin])
        ->count();
        
    $nombreDemandeursInactifPeriode = DB::table('demandeur')
        ->where('usertpi', '=', Auth::id())
        ->where('etat', '=', 0)
        ->whereBetween('created_at', [$debut, $fin])
        ->count();
        
    $nombreDemandeursRefuséPeriode = DB::table('demandeur')
        ->where('usertpi', '=', Auth::id())
        ->where('etat', '=', 2)
        ->whereBetween('created_at', [$debut, $fin])
        ->count();


        $nombreDemandeurs = DB::table('demandeur')->where('usertpi', '=', Auth::id())->count();           
        
        $nombreDemandeursActif = DB::table('demandeur')->where('usertpi', '=', Auth::id())->where('etat', '=', 1)->count();
        
        $nombreDemandeursInactif = DB::table('demandeur')->where('usertpi', '=', Auth::id())->where('etat', '=', 0)->count();
        
        $nombreDemandeursRefusé = DB::table('demandeur')->where('usertpi', '=', Auth::id())->where('etat', '=', 2)->count();


    return view('demandeurs.statistique')
    ->with('nombreDemandeursPeriode', $nombreDemandeursPeriode)
    ->with('nombreDemandeursActifPeriode', $nombreDemandeursActifPeriode)
    ->with('nombreDemandeursInactifPeriode', $nombreDemandeursInactifPeriode)
    ->with('nombreDemandeursRefuséPeriode', $nombreDemandeursRefuséPeriode)
    ->with('debut_jour', $debut_jour)
    ->with('debut_mois', $debut_mois)
    ->with('fin_jour', $fin_jour)
    ->with('fin_mois', $fin_mois)
    ->with('nombreDemandeurs', $nombreDemandeurs)
    ->with('nombreDemandeursActif', $nombreDemandeursActif)
    ->with('nombreDemandeursInactif', $nombreDemandeursInactif)
    ->with('nombreDemandeursRefusé', $nombreDemandeursRefusé);
}

}