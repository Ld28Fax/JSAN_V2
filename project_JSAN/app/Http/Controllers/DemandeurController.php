<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemandeurController extends Controller
{
    public function index()
    {
        return view('demandeurs.index');
    }

    public function create(Request $request){
        try{
            $request->validate([
                "Nom"=> "required|string|max:255",
                "Date_de_Naissance"=> "required|date_format:Y-m-d",
                "Lieu_de_Naissance"=> "required|string|max:255",
                "Pere"=> "required|string|max:255",
                "Mere"=> "required|string|max:255",
                "Adresse"=> "required|string|max:255",
                'Telephone' => ['required', 'numeric', 'digits:10', 'regex:/^(032|033|034|038)[0-9]{7}$/'],

            ]);

            Demandeur::create($request->all());
            return redirect()->route("demandeurs.liste")->with("success","Demandeur enregister");

        } 
        catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function edit($id)
    {
    try{
        $demandeur = Demandeur::findOrFail($id);
        return view('demandeurs.edit')->with('demandeur', $demandeur);
    } catch (Exception $e){
        throw new Exception($e->getMessage());
    }
    }

    public function update(Request $request)
    {
    try{
        $request->validate([
            "Nom"=> "required|string|max:255",
            "Date_de_Naissance"=> "required|date_format:Y-m-d",
            "Lieu_de_Naissance"=> "required|string|max:255",
            "Pere"=> "required|string|max:255",
            "Mere"=> "required|string|max:255",
            "Adresse"=> "required|string|max:255",
            'Telephone' => [ 'required','numeric', 'digits:10', 'regex:/^(032|033|034|038)[0-9]{7}$/'],
            'id' => "required"
        ]);
        Demandeur::modifier( $request->id, $request->Nom, $request->Date_de_Naissance, $request->Lieu_de_Naissance, $request->Pere, $request->Mere, $request->Adresse, $request->Telephone );
        return redirect()->route('demandeurs.liste')->with('success','Demandeur mis à jour avec succès.');
    } catch (Exception $e){
        throw new Exception($e->getMessage());
    }

    }
    public function liste(){
        try{
            $demandeurs = DB::table('demandeur')->get();
            return view('demandeurs.liste')->with('demandeurs', $demandeurs);
        } 
        catch (Exception $e){
            return redirect()->back()->withErrors("error", $e->getMessage());
        }
    }
    public function exportation(){
        try{
            $demandeurs = DB::table('demandeur')->get();

            return view('demandeurs.exportation')->with('demandeurs', $demandeurs);
        } 
        catch (Exception $e){
            return redirect()->back()->withErrors("error", $e->getMessage());
        }
    }

    public function actif($id){
        try{
            Demandeur::Activer($id);
            return redirect()->back();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
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