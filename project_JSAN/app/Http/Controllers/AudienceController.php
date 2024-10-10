<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use Exception;
use Illuminate\Http\Request;

class AudienceController extends Controller
{
    public function index (){
        return view('audience');
    }
    public function create(Request $request){
        try{
            $request->validate([
                'date' => 'required|date',
                'heure' => 'required|date_format:H:i',
                'magistrat' => 'required|string|max:255',
                'greffier' => 'required|string|max:255',
                'salle' => 'required|string|max:255'
            ], [
                'date' => 'Le champ date doit être sous forme (j/m/Y)',
                'heure' => 'Le champ heure doit être une heure valide au format HH:MM.',
                'Magistrat' => 'Le champ Magistrat ne doit pas dépasser 255 caractères.',
                'greffier' => 'Le champ greffier ne doit pas dépasser 255 caractères.',
                'salle' => 'Le champ salle ne doit pas dépasser 255 caractères.',
            ]);
    
            $audience = new Audience();
            $audience->date = $request->input('date');
            $audience->heure = $request->input('heure');
            $audience->magistrat = $request->input('magistrat');
            $audience->greffier = $request->input('greffier');
            $audience->salle = $request->input('salle');
            
            $audience->save();
    
            return back()->with('success', 'Audience enregistrée avec succès.');
        }catch(Exception $e){
            // throw new Exception($e->getMessage());
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }
}
