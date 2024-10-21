<?php

namespace App\Http\Controllers;

use App\Models\Kaominina;
use Illuminate\Http\Request;

class KaomininaController extends Controller
{
    public function getKaominina($distrikaId)
    {
        $kaominina = Kaominina::where('distrika_id', $distrikaId)
                        ->get();

        return response()->json($kaominina);
    }
}
