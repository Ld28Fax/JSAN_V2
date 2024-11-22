<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\Calendrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendrierController extends Controller
{
    public function index()
    {
        return view('calendrier');
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
