<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Divisée</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
    font-family: Source Sans Pro, Arial, sans-serif;
    background-color: #f4f4f4;
    overflow: hidden; /* Désactive le défilement de toute la page */
    }

    .Main {
        display: flex;
        height: 100vh; /* Utilise la hauteur complète de la fenêtre */
    }

    .left-section {
        width: 50%; /* Fixe la largeur à 50% */
        padding: 20px;
        margin-bottom: 3%;
        overflow-y: auto; /* Active le défilement vertical uniquement sur la gauche */
        background-color: #ffffff;
    }

    .right-section {
        width: 50%; /* Fixe la largeur à 50% */
        padding: 20px;
    }
        


        .left-section, .right-section {
            width: 50%; /* Chaque section prend 50% de la largeur */
            padding: 20px;
            overflow-y: auto; /* Ajoute un défilement si le contenu déborde */
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('Audience') }}"><i class="fas fa-arrow-left"></i>
            retour</a>
        </li>
    </ul>
    </div>
</div>
</nav>

<div class="Main" >

    <div class="left-section bg-dark">
        <section class="document-container center">
            <div class="container-fluid">
                <div class="card header m-2">
                    <h1>Demandeurs pour l'audience du {{ $audience->date }}</h1>
                    <form action="{{ route('selectionner.demandeurs') }}" method="POST">
                        @csrf
                        <div class="col-md-12">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                              <ul>
                                @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                          @endif
                            <input type="hidden" name="audience_id" value="{{ $audience->id }}">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Numero de dossier</th>
                                        <th>Nom</th>
                                        <th>Date d'entrée</th>
                                        <th>Sélectionner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandeurs as $demandeur)
                                    <?php
                                    setlocale(LC_TIME, 'mg_MG.UTF-8');
                                    $date_en_lettres_created_at = strftime('%d %B %Y', strtotime($demandeur->created_at));
                                    ?>
                                    <tr>
                                        <td>{{ $demandeur->numero }}</td>
                                        <td>{{ $demandeur->Nom }}</td>
                                        <td>{{ $date_en_lettres_created_at }}</td>
                                        <td>
                                            <input type="checkbox" name="demandeurs_selectionnes[]" value="{{ $demandeur->id }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success" style="margin-left: 80%">Soumettre</button>
                    </form>
                </div>
            </div>
        </section>

            <table class="table table-bordered table-striped text-white">
                <thead style="background: green; opacity:0.5">
                    <tr>
                        <th>Numero</th>
                        <th>Nom</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="demandeurs-list">
                    @forelse ($demandeursAudience as $demandeur)
                    @if ($demandeur->etat == 0)
                    <tr id="row-{{ $loop->index }}">
                        <td>{{ $demandeur->numero }}</td>
                        <td>{{ $demandeur->Nom }}</td>
                        <td>
                        <div>
                            <span class="badge status-badge bg-warning">
                            Dossier non traiter 
                                <i class="fas fa-hourglass-start"></i>
                            </span>
                        </div>
                      </td>
                      <td>
                        <a class="btn btn-block btn-success" href="{{ route('demandeurActiver', ['id' => $demandeur->id]) }}" class="text-white">Activer</a>
                        <a href="{{ route('nonactif', ['id' => $demandeur->id]) }}" class="btn btn-block btn-danger">Non Activer</a>
                      </td>
                  </tr>
                        @elseif ($demandeur->etat == 1)
                            <tr id="row-{{ $loop->index }}" class='text-white'>
                                <td>{{ $demandeur->numero }}</td>
                                <td>{{ $demandeur->Nom }}</td>
                                <td>
                                    <div>
                                        <span class="badge status-badge bg-success text-white">
                                            Dossier traiter
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @elseif ($demandeur->etat == 2)
                            <tr id="row-{{ $loop->index }}" class="text-white">
                                <td>{{ $demandeur->numero }}</td>
                                <td>{{ $demandeur->Nom }}</td>
                                <td>
                                    <div>
                                        <span class="badge status-badge bg-danger text-white">
                                            Dossier refuser
                                            <i class="fas fa-times"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <p>{{ $demandeur->motif }}</p>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr class="w-full">
                            <td style="text-align: center;" colspan="7">
                                <img src="{{ asset('undraw empty.svg')}}" style="width: 10%">
                                <div style="color: white;">Aucun élément</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
        </div>

        <div class="right-section">
            <div class="document-container">
                <?php
                    setlocale(LC_TIME, 'mg_MG.UTF-8');
                    $date_audience = strftime('%d %B %Y', strtotime($audience->date));
                    ?>
                    <div class="header center">
                        <h4>AUDIENCE DU {{ $date_audience }} à {{ $audience->heure }}</h4>
                    </div>
                    <button  id="printButton" class="btn btn-success imprimer" style="float: right; margin-top: 10px;">
                    <i class="fas fa-print"></i> Imprimer
                </button>
                    <div class="header-info">
                        <p>PRESIDENT: {{ $audience->magistrat }}</p>
                        <p>GREFFIER: {{ $audience->greffier }}</p>
                        <p>{{ $audience->salle }}</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Nº DOSSIER</td>
                                <td>NOM DE PARTIE</td>
                                <td>NATIVE DE L'AFFAIRE</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandeursAudience as $demandeur)
                                <tr>
                                    <td>{{ $demandeur->numero }}</td> 
                                    <td> @if($demandeur->interesse)
                                        {{ $demandeur->Nom }}, {{ $demandeur->interesse }}
                                    @else
                                        {{ $demandeur->Nom }}
                                    @endif</td>
                                    <td></td>
                                </tr>
                            @endforeach
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
