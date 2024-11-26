<?php

namespace App\Http\Controllers;

use App\Models\Distrika;
use App\Models\Kaominina;
use Illuminate\Http\Request;

class KaomininaController extends Controller
{
    public function getKaominina($distrikaNom)
{
    // Rechercher le distrika par son nom
    $distrika = Distrika::where('nom', $distrikaNom)->first();

    if ($distrika) {
        // Retourner les kaomininas associées au distrika
        return response()->json($distrika->kaomininas);
    }

    // Si le distrika n'est pas trouvé, retourner une réponse vide
    return response()->json([]);
}
}
