<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;

class DocumentationController extends Controller
{

public function afficherDocxEnHtml($fileName)
{
    $filePath = public_path($fileName);

    if (!file_exists($filePath)) {
        abort(404, 'Fichier non trouvé');
    }

    // Charger le fichier DOCX
    $phpWord = IOFactory::load($filePath);
    $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');

    // Sauvegarder le contenu HTML dans un fichier temporaire ou le stocker en variable
    ob_start();
    $htmlWriter->save("php://output");
    $htmlContent = ob_get_clean();

    // Retourner la vue avec le contenu HTML
    return view('afficher_docx', ['htmlContent' => $htmlContent]);
}
}
