<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Divisée</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="extern/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="extern/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="extern/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="extern/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="extern/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="extern/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="extern/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="extern/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="extern/plugins/bs-stepper/css/bs-stepper.min.css">
    <link rel="stylesheet" href="extern/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="extern/dist/css/adminlte.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Source Sans Pro, Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            height: 100vh; /* Remplir la hauteur de la fenêtre */
        }

        .left-section, .right-section {
            width: 50%; /* Chaque section prend 50% de la largeur */
            padding: 20px;
            overflow-y: auto; /* Ajoute un défilement si le contenu déborde */
        }

        .left-section {
            background-color: #ffffff; /* Couleur de fond pour la partie gauche */
        }

        .right-section {
            background-color: #fff; /* Couleur de fond pour la partie droite */
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
    <div class="left-section">
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <h1>Demandeurs pour l'audience du {{ $audience->date }}</h1>
                    <form action="{{ route('selectionner.demandeurs') }}" method="POST">
                        @csrf
                        <div class="col-md-12">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <input type="hidden" name="audience_id" value="{{ $audience->id }}">
                            <table class="table">
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
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </form>
                    </div>
                </div>
            </section>
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
                <div class="header-info">
                    <p>PRESIDENT: {{ $audience->magistrat }}</p>
                    <p>GREFFIER: {{ $audience->greffier }}</p>
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
                <button  id="printButton" class="btn btn-primary imprimer" style="float: right; margin-top: 10px;">
                    <i class="fas fa-print"></i> Imprimer
                </button>
            </div>
        </div>


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
