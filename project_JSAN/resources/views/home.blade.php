<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home</title>
    <style>
        .number-shadow {
            font-size: 5em!important;
            color: grey;
        }
    </style>
</head>
<body>

@extends('dashboard')
@section('content')


    <!-- Main content -->
    <section class="content-header">
        <section class="content">
            <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 class="number-shadow icon" style="margin-top: -13%;">{{ $nombreDemandeurs }}</h3>
                            <h4>Total Demandeurs</h4>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 class="number-shadow icon" style="margin-top: -13%;">{{ $nombreDemandeursActif }}</h3>
                            <h4>Dossier Accepté</h4>
                        </div>
                        <div class="icon">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 class="number-shadow icon" style="margin-top: -13%;">{{ $nombreDemandeursRefusé }}</h3>
                            <h4>Dossier Refusé</h4>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 class="number-shadow icon" style="margin-top: -13%;">{{ $nombreDemandeursInactif }}</h3>
                            <h4 style="color: white">En cours de traitement</h4>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hourglass-start"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main row -->
            <div class="row">
            <!-- Left col -->
            <div class="col-md-12">

                <!-- TABLE: LATEST ORDERS -->
                <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Demandeurs recents</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table m-0">
                        <thead style="background: green; opacity:0.5">
                            <tr>
                                <th>Nom</th>
                                <th>Adresse</th>
                                <th>Date de Naissance</th>
                                <th>Lieu de Naissance</th>
                              </tr>
                        </thead>
                        <tbody style='background:grey'>
                            @foreach ( $demandeurs as $demandeur )
                                
                            <tr>
                                <td>{{$demandeur->Nom}}</td>
                                <td>{{$demandeur->Adresse}}</td>
                                <td>{{$demandeur->Date_de_Naissance}}</td>
                                <td>{{$demandeur->Lieu_de_Naissance}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="{{ route('demandeurs.liste') }}" class="btn btn-sm btn-secondary float-right">Voir tous les demandeurs</a>
                </div>
                <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
        </section>
    <!-- /.content -->
    <!-- jQuery -->
<script src="{{ asset('extern/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('extern/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('extern/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('extern/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('extern/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('extern/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('extern/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('extern/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('extern/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('extern/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('extern/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('extern/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('extern/dist/js/adminlte.min.js') }}"></script>

</body>
@endsection
</html>