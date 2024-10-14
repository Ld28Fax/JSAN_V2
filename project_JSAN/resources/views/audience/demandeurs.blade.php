<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listes des demandeurs</title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="extern/plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="extern/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="extern/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="extern/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="extern/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="extern/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="extern/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="extern/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="extern/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="extern/plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="extern/dist/css/adminlte.min.css">
</head>
<body>
    {{-- @extends('dashboard') --}}
{{-- @section('content') --}}
    <section class="content" >
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

<!-- jQuery -->
<script src="extern/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="extern/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="extern/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="extern/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="extern/plugins/moment/moment.min.js"></script>
<script src="extern/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="extern/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="extern/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="extern/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="extern/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="extern/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="extern/plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="extern/dist/js/adminlte.min.js"></script>
{{-- @endsection --}}
</body>
</html>