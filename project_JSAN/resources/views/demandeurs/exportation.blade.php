<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Demandeurs</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="extern/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="extern/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="extern/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="extern/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="extern/dist/css/adminlte.min.css">
</head>
{{-- <body class="hold-transition sidebar-mini"> --}}
@extends('dashboard')
@section('content')

<section class="content-header">
 <div class="row">
  <a class="col-12 col-sm-6 col-md-3 btn" href="{{ route('demandeurs.exportationVerifier') }}">
    <div class="info-box mb-3">
    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">Verifier</span>
        <span class="info-box-number text-purple " >{{ $nombreDemandeursActif }}
            <small>Personnes</small>
        </span>
    </div>
    <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</a>
<a class="col-12 col-sm-6 col-md-3 btn" href="{{ route('demandeurs.exportationNonVerifier') }}">
  <div class="info-box mb-3">
  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i></span>

  <div class="info-box-content">
      <span class="info-box-text">Non Verifier</span>
      <span class="info-box-number text-purple " >{{ $nombreDemandeursInactif }}
          <small>Personnes</small>
      </span>
  </div>
  <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</a>
 </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped ">
                  <thead style="background: green; opacity:0.5 ">
                  <tr>
                    <th>Nom</th>
                    <th>Date de Naissance</th>
                    <th>Lieu de Naissance</th>
                    <th>Père</th>
                    <th>Mère</th>
                    <th>Télephone</th>
                    <th>Imprimer</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($demandeurs as $demandeur )
                          <tr>
                            <td>{{$demandeur->Nom}}</td>
                            <td>{{\Carbon\Carbon::parse($demandeur->Date_de_Naissance)->format('d-m-Y')}}</td>
                            <td>{{$demandeur->Lieu_de_Naissance}}</td>
                            <td>{{$demandeur->Pere}}</td>
                            <td>{{$demandeur->Mere}}</td>
                            <td>{{$demandeur->Telephone}}</td>
                            <td>
                              <a href="{{ route('export', $demandeur->id) }}">
                                <i class="fas fa-print"></i>
                            </a>
                            </td>
                        </tr>
                        @empty
                            <tr class="w-full">
                                <td style="text-align: center" colspan="7">
                                    <img src="{{ asset('undraw empty.svg')}}" alt="" style="width: 10%">
                                    <div>Aucun élément</div>
                                </td>
                            </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<!-- ./wrapper -->

<!-- jQuery -->
<script src="extern/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="extern/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="extern/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="extern/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="extern/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="extern/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="extern/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="extern/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="extern/plugins/jszip/jszip.min.js"></script>
<script src="extern/plugins/pdfmake/pdfmake.min.js"></script>
<script src="extern/plugins/pdfmake/vfs_fonts.js"></script>
<script src="extern/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="extern/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="extern/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="extern/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script> 
@endsection
</body>
</html>
    