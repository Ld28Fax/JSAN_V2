<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\Demandeur;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    public function liste() {

        $listeAudience = DB::table('audience')
            ->orderBy('created_at', 'desc')
            ->get();

        $audiences = Audience::all();

            $events = [];
            foreach ($audiences as $audience) {
                $events[] = [
                    'title' => 'Audience: ' . $audience->magistrat, // titre de l'audience
                    'start' => $audience->date, // date de l'audience
                    'end' => $audience->date, // vous pouvez ajouter une heure de fin si nécessaire
                ];
            }
    
        return view('audience.index')->with('listeAudience', $listeAudience)->with('events', $events)->with('audiences', $audiences);
    }

    public function showDemandeurs($id)
    {
        $audience = Audience::findOrFail($id);

        $audienceId = $audience->id;

        $demandeurs = DB::table('demandeur')->orderBy('created_at', 'asc')->where('usertpi', '=', Auth::id())->where('etat_audience', false)->get();

        $demandeursAudience  = Demandeur::where('etat_audience', true)
                ->where('usertpi', '=', Auth::id())
                ->orderBy('created_at', 'asc')
                ->where('audience_id',$audienceId)
                ->paginate(5);

        $user = Auth::user();


        return view('audience.demandeurs')->with('demandeurs', $demandeurs)->with('audience', $audience)->with('demandeursAudience', $demandeursAudience)->with('user', $user);
    }

    public function selectionnerDemandeurs(Request $request)
    {
       try{
        $demandeursSelectionnes = $request->input('demandeurs_selectionnes', []);
        $audienceId = $request->input('audience_id');

        $request->validate([
            'demandeurs_selectionnes' => 'required|array|min:1',
        ], [
            'demandeurs_selectionnes.required' => 'Veuillez sélectionner au moins un demandeur.',
            'demandeurs_selectionnes.min' => 'Veuillez sélectionner au moins un demandeur.'
        ]);
        
    
        if (!empty($demandeursSelectionnes)) {
            Demandeur::whereIn('id', $demandeursSelectionnes)
                ->update([
                    'etat_audience' => true,
                    'audience_id' => $audienceId,
                ]);
        }
    
        return redirect()->back()->with('success', 'Les demandeurs ont eu un audience.');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    
    public function getRejetesApresAudience()
    {
        $today = Carbon::now();

        $demandeursRejetes = DB::table('demandeur')
            ->join('audience', 'demandeur.audience_id', '=', 'audience.id')
            ->where('demandeur.etat', '=', 2)
            ->where('usertpi', '=', Auth::id())
            ->where('audience.date', '>', $today)
            ->orderBy('audience.date', 'asc')
            ->select('demandeur.*', 'audience.date as audience_date')
            ->get();
        return $demandeursRejetes;
    }

    public function showRejetes()
    {
    $demandeursRejetes = $this->getRejetesApresAudience();

    return view('audience.demandeursRejected')->with('demandeursRejetes', $demandeursRejetes);
    }

    public function selectionnerDemandeursRejected(Request $request)
{
    try {
        $demandeursSelectionnes = $request->input('demandeurs_selectionnes', []);
        $audienceId = $request->input('audience_id');

        $request->validate([
            'demandeurs_selectionnes' => 'required|array|min:1',
        ], [
            'demandeurs_selectionnes.required' => 'Veuillez sélectionner au moins un demandeur.',
            'demandeurs_selectionnes.min' => 'Veuillez sélectionner au moins un demandeur.'
        ]);

        if (!empty($demandeursSelectionnes)) {
            Demandeur::whereIn('id', $demandeursSelectionnes)
                ->update([
                    'etat' => 0,  // Change l'état à 0
                    'audience_id' => $audienceId, // Met à jour l'ID de l'audience
                ]);
        }

        return redirect()->back()->with('success', 'Les demandeurs ont été soumis avec succès.');
    } catch (Exception $e) {
        return redirect()->back()->withErrors($e->getMessage());
    }
}


}
