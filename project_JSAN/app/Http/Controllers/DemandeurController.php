<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
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
                "Date_de_Naissance"=> "required|date_format:d-m-Y",
                "Lieu_de_Naissance"=> "required|string|max:255",
                "Pere"=> "required|string|max:255",
                "Mere"=> "required|string|max:255",
                "Adresse"=> "required|string|max:255",
                'Telephone' => ['required', 'numeric', 'digits:10', 'regex:/^(032|033|034|038)[0-9]{7}$/'],
                'usertpi'=>'required',

            ], [
            'Telephone' => 'Le champ Téléphone est requis, doit être un nombre, contenir exactement 10 chiffres et commencer par 032, 033, 034 ou 038.',
            'Nom' => 'Le champ Nom est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Date_de_Naissance' => 'Le champ Date de Naissance est requis et doit être au format DD-MM-YYYY.',
            'Lieu_de_Naissance' => 'Le champ Lieu de Naissance est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Pere' => 'Le champ Père est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Mere' => 'Le champ Mère est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Adresse' => 'Le champ Adresse est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.'
            ]);

            Demandeur::create($request->all());
            return redirect()->route("demandeurs.liste")->with("success","Demandeur enregister");

        } 
        catch (Exception $e){
            // throw new Exception($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()]);
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
            "Date_de_Naissance"=> "required|date_format:d-m-Y",
            "Lieu_de_Naissance"=> "required|string|max:255",
            "Pere"=> "required|string|max:255",
            "Mere"=> "required|string|max:255",
            "Adresse"=> "required|string|max:255",
            'Telephone' => [ 'required','numeric', 'digits:10', 'regex:/^(032|033|034|038)[0-9]{7}$/'],
            'id' => "required"
        ],[
            'Telephone' => 'Le champ Téléphone est requis, doit être un nombre, contenir exactement 10 chiffres et commencer par 032, 033, 034 ou 038.',
            'Nom' => 'Le champ Nom est requis, doit être une chaîne de caractères et ne doit pas dépasser 255 caractères.',
            'Date_de_Naissance' => 'Le champ Date de Naissance est requis et doit être au format DD-MM-YYYY.',
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
            return view('demandeurs.liste')->with('demandeurs', $demandeurs);
        } 
        catch (Exception $e){
            return redirect()->back()->withErrors("error", $e->getMessage());
        }
    }

    // exportation des demandeurs
    public function exportation(){
        try{
            $demandeurs = DB::table('demandeur')->get()->where('usertpi', '=', Auth::id());

            return view('demandeurs.exportation')->with('demandeurs', $demandeurs);
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

    // public function non_actif($id){
    //     try{
    //         Demandeur::desactiver($id);
    //         return redirect()->back();
    //     }catch(Exception $e){
    //         throw new Exception($e->getMessage());
    //     }
    // }

}