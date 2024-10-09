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

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exportation des demandeurs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Acceuil</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('demandeurs.liste')}}">Exportation des demandeurs</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
                                <td style="text-align: center" colspan="6">
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

//   document.addEventListener('DOMContentLoaded', function () {
//     // Sélectionner toutes les icônes d'impression
//     const printButtons = document.querySelectorAll('.print-row');

//     // Boucle sur chaque bouton et ajouter un gestionnaire d'événement de clic
//     printButtons.forEach(function(button) {
//         button.addEventListener('click', function () {
//             const row = button.closest('tr'); // Trouve la ligne de la table
//             const demandeurData = {
//                 Nom: row.cells[0].innerText,
//                 DateNaissance: row.cells[1].innerText,
//                 LieuNaissance: row.cells[2].innerText,
//                 Pere: row.cells[3].innerText,
//                 Mere: row.cells[4].innerText,
//                 Telephone: row.cells[5].innerText
//             };

//             // Crée une nouvelle fenêtre pour l'impression
//             const printWindow = window.open('', '_blank');
//             printWindow.document.write(`
//                 <html>
//                 <head>
//                     <title>Imprimer Demandeur</title>
//                     <style>
//                         .document-container { font-family: Arial, sans-serif; }
//                         .header { text-align: center; font-weight: bold; }
//                         .hr { margin: 10px 0; border: 1px solid black; }
//                         .footer { margin-top: 20px; text-align: center; }
//                     </style>
//                 </head>
//                 <body>
//                     <div class="document-container">
//                         <div class="header">
//                             <h4>REPOBLIKAN'I MADAGASIKARA <br> AMIN'NY ANARAN'NY VAHOAKA MALAGASY</h4>
//                         </div>
//                         <div class="logo">
//                             <img src="Justice_logo.png" alt="Logo" style="width:10%;">
//                         </div>
//                         <div class="header-info">
//                             <p>FITSARANA AMBARATONGA VOALOHANY</p>
//                             <p>ANTANANARIVO</p>
//                             <hr class="hr">
//                             <p>FIRAKETAN-DRAHARAHA</p>
//                             <hr class="hr">
//                             <p>BIRAON'NY FIAKONOHANA</p>
//                         </div>
//                         <div class="case-info">
//                             <p>Demandeur : ${demandeurData.Nom}</p>
//                             <p>Date de Naissance : ${demandeurData.DateNaissance}</p>
//                             <p>Lieu de Naissance : ${demandeurData.LieuNaissance}</p>
//                             <p>Père : ${demandeurData.Pere}</p>
//                             <p>Mère : ${demandeurData.Mere}</p>
//                             <p>Téléphone : ${demandeurData.Telephone}</p>
//                         </div>
//                         <div class="footer">
//                             <p>Imprimé le ${new Date().toLocaleDateString()}</p>
//                         </div>
//                     </div>
//                 </body>
//                 </html>
//             `);
//             printWindow.document.close();
//             printWindow.focus();
//             printWindow.print(); // Lance l'impression
//         });
//     });
// });


</script> 
@endsection
</body>
</html>
    