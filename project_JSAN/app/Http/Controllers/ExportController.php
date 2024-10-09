<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function index(){
        return view('export');
    }

    public function showPrintPage($id)
    {
    $user = Auth::user();
    $demandeur = Demandeur::findOrFail($id); // Récupère le demandeur par ID
    return view('export')->with('demandeur', $demandeur)->with('user', $user);
    }
}
