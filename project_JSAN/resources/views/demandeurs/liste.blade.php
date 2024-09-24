<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Liste des Demandeurs</title>

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
            <h1>Listes des demandeurs</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Acceuil</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('demandeurs.liste')}}">Liste des demandeurs</a></li>
            </ol>
          </div>
          @if (session('success'))
            <div class="col-sm-6 alert-success rounded-md">
              {{ session('success') }}
            </div>
          @endif
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
               
              <!-- /.card-header -->
              <div class="card-body">
                <div>
                    <button class="btn btn-default" onclick="filterByPeriod('day')">Jour</button>
                    <button class="btn btn-default" onclick="filterByPeriod('week')">Semaine</button>
                    <button class="btn btn-default" onclick="filterByPeriod('month')">Mois</button>
                </div>
            
                <table id="example1" class="table table-bordered table-striped">
                    <thead style="background: grey">
                        <tr>
                            <th>Nom</th>
                            <th>Date de Naissance</th>
                            <th>Lieu de Naissance</th>
                            <th>Modifier</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="demandeurs-list">
                        @forelse ($demandeurs as $demandeur )
                            <tr id="row-{{ $loop->index }}" class="{{ $demandeur->etat == 0 ? '' : 'table-primary' }}">
                                <td>{{ $demandeur->Nom }}</td>
                                <td>{{ \Carbon\Carbon::parse($demandeur->Date_de_Naissance)->format('d-m-Y')}}</td>
                                <td>{{ $demandeur->Lieu_de_Naissance }}</td>
                                <td>
                                    @if ($demandeur->etat == 0)
                                        <a class="btn btn-primary" href="{{ route('demandeurs.edit', ['id' => $demandeur->id]) }}">Modifier</a>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <span class="p-2 status-text">{{ $demandeur->etat == 0 ? 'Non traiter' : 'Traiter' }}</span>
                                        <span class="badge status-badge {{ $demandeur->etat == 0 ? 'bg-danger' : 'bg-success' }}">
                                            <i class="fas {{ $demandeur->etat == 0 ? 'fa-times' : 'fa-check' }}"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @if ($demandeur->etat == 0)
                                        <button type="button" class="btn btn-block btn-success">
                                            <a href="{{ route('demandeurActiver', ['id' => $demandeur->id]) }}" class="text-white">Activer</a>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="w-full">
                                <td colspan="6" class="text-center">Aucun élément</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            
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
<!-- AdminLTE App -->
<script src="extern/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  function filterByPeriod(period) {
      // Requête AJAX pour récupérer les demandeurs filtrés
      fetch(`/demandeurs/filter?period=${period}`)
          .then(response => response.json())
          .then(data => {
              const tbody = document.getElementById('demandeurs-list');
              tbody.innerHTML = '';

              if (data.demandeurs.length > 0) {
                  data.demandeurs.forEach((demandeur, index) => {
                      const row = document.createElement('tr');
                      if(demandeur.etat == 1){
                        row.classList.add('table-primary');
                      }
                      row.innerHTML = `
                          <td>${demandeur.Nom}</td>
                          <td>${demandeur.Date_de_Naissance}</td>
                          <td>${demandeur.Lieu_de_Naissance}</td>
                          <td>${demandeur.etat == 0 ? `<a class="btn btn-primary" href="/demandeurs/edit/${demandeur.id}">Modifier</a>` : ''}</td>
                          <td><span class="p-2 status-text">${demandeur.etat == 0 ? 'Non traiter' : 'Traiter'}</span></td>
                          <td>${demandeur.etat == 0 ? `<button type="button" class="btn btn-block btn-success"><a href="/Actif/${demandeur.id}" class="text-white">Activer</a></button>` : ''}</td>
                      `;
                      tbody.appendChild(row);
                  });
              } else {
                  tbody.innerHTML = `<tr><td colspan="6" class="text-center">Aucun élément</td></tr>`;
              }
          });
  }
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
    