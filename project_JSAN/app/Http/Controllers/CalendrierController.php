<?php

namespace App\Http\Controllers;

use App\Models\Calendrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendrierController extends Controller
{
    public function index()
    {
        $periodes= DB::table('Calendrier')->get();
        return view('calendrier')->with('Calendrier', $periodes);
    }
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'debut_periode' => 'required|max:255',
            'fin_periode' => 'nullable|date|after_or_equal:start_date',
        ]);
    }
}
