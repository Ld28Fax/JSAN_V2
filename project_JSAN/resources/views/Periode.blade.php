<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Periode</title>
</head>
<body>
    @extends('dashboard')
    @section('content')

    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Listes des demandeurs dans le periode</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Acceuil</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('Periode')}}">Listes des demandeurs dans le periode</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- /.card -->
  
              <div class="card">
                 
                <!-- /.card-header -->
                <div class="card-body">
                    <h1>Nombre des demandeurs: </h1>
                    <li class="nav-item d-none d-sm-inline-block">
                        <h2 class="nav-link  btn-default text-blue">{{ $statisticCount }}</h2>
                      </li>
                  <table id="example1" class="table table-bordered table-striped ">
                    <thead style="background: green; opacity:0.5">
                    <tr>
                    <th>Nom</th>
                    <th>Date de Naissance</th>  
                    <th>Lieu de Naissance</th>
                    <th>Père</th>
                    <th>Mère</th>
                    <th>Télephone</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($statistic as $stat )
                        <tr id="row-{{ $loop->index }}">
                          <td>{{$stat->Nom}}</td>
                          <td>{{\Carbon\Carbon::parse($stat->Date_de_Naissance)->format('d-m-Y')}}</td>
                          <td>{{$stat->Lieu_de_Naissance}}</td>
                          <td>{{$stat->Pere}}</td>
                          <td>{{$stat->Mere}}</td>
                          <td>{{$stat->Telephone}}</td>
                        </tr>
                      @endforeach
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

    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "excel", "pdf", "print"]
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