<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listes des demandeurs</title>
</head>
<body>

    <h1>Demandeurs pour l'audience du {{ $audience->date }}</h1>
    <form action="{{ route('selectionner.demandeurs') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Sélectionner</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($demandeurs as $demandeur)
                <tr>
                    <td>{{ $demandeur->Nom }}</td>
                    <td>
                        <input type="checkbox" name="demandeurs_selectionnes[]" value="{{ $demandeur->id }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>


</body>
</html>