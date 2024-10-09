<!DOCTYPE html>
<html lang="mg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document officiel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
}


.logo{
    display: 
}

.document-container {
    width: 70%;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.header {
    margin: 0 auto; 
    text-align: center; 
    width: fit-content;
}
.header-info{
    display: flex;
    justify-content: space-around;
    text-align: center;
    margin-bottom: 20px;
}

.header p {
    font-size: 0.9em;
    margin: 5px 0;
}
.start-text{
    text-align: start;
}

.case-info, .case-decision, .case-details, .footer {
    margin-bottom: 20px;
}

.case-info p, .case-decision p, .case-details p {
    margin-bottom: 10px;
    font-size: 0.9em;
}

.case-decision strong, .case-details strong {
    font-weight: bold;
}

.case-details p {
    text-align: justify;
}

.top-footer{
    margin-top: 2.5%;
}

.footer {
    display: flex;
    justify-content: space-around;
    padding-top: 10%;
    /* padding-bottom: 10%; */
}

.footer p {
    margin-bottom: 10px;
    font-size: 0.9em;
}

.hr{
    width: 50%;
    margin: 0 auto;
}
.logo {
    margin-left: 120px;
    margin-top: 5%;
    padding-bottom: 2%;
}

@page {
    size: auto; /* Ajuste automatiquement la taille à celle de la page */
    margin: 5mm; /* Ajuste les marges de la page (valeurs en mm ou px) */
}
@media print {
    body {
        font-size: 12pt; /* Ajuste la taille de la police pour l'impression */
    }
    .no-print {
        display: none;
    }
    .imprimer{
        display: none;
    }
    .document-container {
        width: 100%; /* Utilise toute la largeur de la page imprimée */
        margin: 0 auto; /* Centre le contenu horizontalement */
        /* padding: 10mm; Ajoute un espace intérieur (facultatif) */
        visibility: hidden;
        position: relative; 
        padding: 15mm; /* Ajuste le remplissage pour que tout soit bien placé dans la page */
        width: 100%; /* Prend toute la largeur */
        padding: 0; /* Retirer le padding si nécessaire */
    }
    .document-container h4, .document-container center {
        width: 100%; /* Assure que tous les éléments textuels prennent toute la largeur */
        text-align: center;
        margin:0;
    }
    .document-container img {
        max-width: 100;
        height: auto;
    }
    .document-container * {
        visibility: visible;
    }
    .header, .header-info, .case-info, .case-decision, .case-details, .footer {
        page-break-inside: avoid;
    }
    .document-container {
        width: 100%;
    }

    .case-decision, .case-info, .case-details {
        page-break-inside: avoid; /* Évite les coupures au milieu de ces sections */
    }
    .header-info p {
        font-size: 10pt; /* Ajuste la taille de la police selon tes besoins */
    }
}


</style>
<body>
    {{-- <button onclick="window.print()" class="imprimer">Imprimer</button> --}}

    <div class="document-container">
        <div class="header center">
            <h4>REPOBLIKAN'I MADAGASIKARA <br> AMIN'NY ANARAN'NY VAHOAKA MALAGASY</h4>
        </div>
            <div class="logo">
                <img src="Justice_logo.png" alt="Logo" class="brand-image img-circle elevation-3" style=" width:10%;">
            </div>
        <div class="header-info">
            <div class="center">
                <p>FITSARANA AMBARATONGA VOALOHANY</p>
                <p>{{ $user->Cour_appel }}</p>
                <hr class="hr">
                <p>FIRAKETAN-DRAHARAHA</p>
                <hr class="hr">
                <p>BIRAON'NY FIAKONOHANA</p>
           </div>
    
           <div class="start-text">
                <p>DIDIM-PITSARANA MISOLO SORA-PAHATERAHANA</p>
                <p>LAHARANA FAHA</p>
                <p>TAMIN'NY</p>
                <p>PAIKADY LAHARANA FAHA</p>
           </div>
      </div>
        
        <div class="case-info">
            <p>Fitsarana notarihin'i ......................................................</p>
            <p>Mpitsara eto amin'ny Fitsarana Ambaratonga Voalohany /Antananarivo/-FILOHA-</p>
            <p>Notrorin'i Me ................................................................................-MPIRAKI-DRAHARAHA-</p>
            <p>Fitsarana ady madio ampahibemaso natao ny /date/</p>
        </div>
            <p>Ny Fitsarana Ambaratonga Voalohany Antananarivo teto amin’ny fitsarana an-davan’andro;</p>
            <p>Mamoaka izao didim-pitsarana manaraka izao :</p>
            <p><strong>NY FITSARANA</strong></p>
            <p>Hita ny antontan-taratasin’ady. Hita ny fehintenin’ny Fampanoavana ; Heno ny mpangataka;</p>
            <p>Heno ny fanambaran’ny vavolombelona</p>
            <p>Rehefa nandinika araka ny lalàna;</p>
            <p>Araka ny fangatahana tamin’ny <u>{{ $demandeur->created_at }}</u> dia nangataka ny Fitsarana</p>
            <p>etoana i <u>{{ $demandeur->Nom }}</u> mba amoaka</p>
            <p>didim-pitsarana misolo sora-pahaterahana ho an'i <u>nom interessé</u></p>
            <p><u>Lahy na vavy</u></p>
            <p>Daty sy toerana nahaterahana: <u>{{ $demandeur->Date_de_Naissance }} {{ $demandeur->Lieu_de_Naissance }}</u></p>
            <p>Kaominina: ......................... Distrika..................</p>
            <p>Anaran'ny Ray aman-dReny: {{ $demandeur->Pere }}, {{ $demandeur->Mere }}</p>

           <p>Araka ny antontan-taratasin'ady sy ny fanambaran'ny vavolombelona dia hita fa mitombona ny fangatahana ary omena rariny;</p>
           <p><strong>NOHO IREO ANTONY IREO</strong></p>
           <p>Mitsara ampahibemaso, amin'ny ady madio, ary azo anaovana fampakarana</p>
           <p>Lazaina fa i ..............................<u>nom interesse</u></p>
           <p><u>Lahy na vavy</u></p>
           <p>Dia teraka ny:<u>{{ $demandeur->Date_de_Naissance }}</u></p>
           <p>Tao <u>{{ $demandeur->Lieu_de_Naissance }}</u> Kaominina.................. Distrika.............</p>
           <p>Zanak'i <u> {{ $demandeur->Pere }}</u></p>
           <p>Sy <u> {{ $demandeur->Mere }}</u></p>
           <p>Didiana sy fandikana ny matoan'izao didy izao ao amin'ny rejisitry ny sora-piankohonana;</p>
           <p>Notsaraina sy nambara araka izany nandritra ny fotoan-pitsarana ampahibemaso tamin'ny andro, volana, taona voalaza</p>
           <p>ery ambony ary nosoniavin'ny FILOHA sy ny MPIRAKI-DRAHARAHA.</p>

        <p class="top-footer">Natao androany <u>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</u></p>
        <div class="footer">
            <p><strong>Ny Mpitsara Filoha</strong></p>
            <p><strong>Ny Mpiraki-draharaha</strong></p>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print(); // Lancement de l'impression quand la page est chargée
        };
    </script>
</body>
</html>
