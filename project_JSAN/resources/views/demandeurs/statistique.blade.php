<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Divisée</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@php
    $months = [
    1 => 'Janoary',
    2 => 'Febroary',
    3 => 'Martsa',
    4 => 'Aprily',
    5 => 'Mey',
    6 => 'Jona',
    7 => 'Jolay',
    8 => 'Aogositra',
    9 => 'Septambra',
    10 => 'Oktobra',
    11 => 'Novambra',
    12 => 'Desambra'
    ];
@endphp
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: sans-serif;
            overflow: hidden;
        }
        .Main {
            display: flex;
            height: 100vh; 
            background-color: #f4f4f4;
        }

        .left-section, .right-section {
            width: 50%;
            padding: 20px;
            overflow-y: auto;
        }

        .left-section {
            background-color: #8b8b8b; /* Couleur de fond pour la partie gauche */
        }

        .right-section {
            background-color: #f4f4f4; /* Couleur de fond pour la partie droite */
        }

        .document-container {
            width: 100%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
        }

        .header-info {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
        @media print {
    .imprimer{
        display: none;
    }
}
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="{{ route('dashboard') }}"><i class="fas fa-arrow-left"></i>
                retour</a>
        </li>
        </ul>
    </div>
    </div>
</nav>

    <div class="Main">
        <div class="left-section">
        <section class="document-container center">
            <div class="container-fluid">
                <div class="card header m-2">
                    <h1>Periode à saisir: </h1>
                    <form action="/statistic" method="GET" class="text-center row mb-3" style="margin-left: 0.1%">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="debut">Début :</label>
                            <select name="debut_jour" class="form-control">
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select name="debut_mois" class="form-control mt-2">
                                @foreach ($months as $num => $nom)
                                    <option value="{{ $num }}">{{ $nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="fin">Fin :</label>
                            <select name="fin_jour" class="form-control">
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select name="fin_mois" class="form-control mt-2">
                                @foreach ($months as $num => $nom)
                                    <option value="{{ $num }}">{{ $nom }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-success" style="margin-top: 10%; margin-left:30%" type="submit">Rechercher</button>
                        </div>
                
                    </form>
                    </div>
                </div>
            </section>
        </div>

            <div class="right-section">
                <div class="document-container">
                    <button  id="printButton" class="btn btn-success imprimer" style="float: right; margin-bottom: 10px;">
                    <i class="fas fa-print"></i> Imprimer
                </button>
                    <table>
                        <thead>
                            <tr>
                                <td>Total de demandeurs</td>
                                <td>Demandeurs Accepté</td>
                                <td>Demandeurs Refusé</td>
                                <td>Demandeurs en cours de traitement</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $nombreDemandeurs }}</td> 
                                <td>{{ $nombreDemandeursActif }}</td>
                                <td>{{ $nombreDemandeursRefusé }}</td>
                                <td>{{ $nombreDemandeursInactif }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById('printButton').addEventListener('click', function() {
                // Cacher tout le reste de la page
                let originalContent = document.body.innerHTML; // Conserver le contenu original
                let printContent = document.querySelector('.right-section').innerHTML; // Obtenir le contenu à imprimer
                document.body.innerHTML = printContent; // Remplacer le contenu par celui à imprimer
                window.print(); // Ouvrir la boîte de dialogue d'impression
                document.body.innerHTML = originalContent; // Restaurer le contenu original
                location.reload(); // Recharger la page pour revenir à l'état d'origine
            });
        </script>
    </body>
</html>