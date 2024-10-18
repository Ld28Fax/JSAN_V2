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
  <link rel="stylesheet" href="extern/dist/css/welcome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="extern/dist/css/adminlte.min.css">
</head>
<style>
  .pagination {
    font-size: 0.8em; /* Réduire la taille de la police */
}

.pagination .page-item {
    margin: 0 2px; /* Réduire l'espacement entre les éléments */
}

.pagination .page-link {
    padding: 0.3rem 0.5rem; /* Réduire le rembourrage */
}

</style>
<body>
    @extends('dashboard')
    @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          @if (session('success'))
            <div class="col-sm-6 alert-success rounded-md">
              {{ session('success') }}
            </div>
          @endif
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
               
              <!-- /.card-header -->
              <div class="card-body" >
                <div style="margin-bottom: 5%">
                  <button class="btn btn-default" onclick="filterByPeriod('day')">Jour</button>
                  <button class="btn btn-default" onclick="filterByPeriod('week')">Semaine</button>
                  <button class="btn btn-default" onclick="filterByPeriod('month')">Mois</button>
                  <button class="btn btn-default" onclick="filterByPeriod('tous')">Tous</button>
                </div>
            
                <table class="table table-bordered table-striped">
                    <thead style="background: green; opacity:0.5">
                        <tr>
                            <th>Nom</th>
                            <th>Date de Naissance</th>
                            <th>Lieu de Naissance</th>
                            <th>Modifier</th>
                            <th>Status</th>
                            <th>Date d'ajout</th>
                        </tr>
                    </thead>
                    <tbody id="demandeurs-list">
                        @forelse ($demandeurs as $demandeur)
                        <?php
                          setlocale(LC_TIME, 'mg_MG.UTF-8');
                          $date_en_lettres_created_at = strftime('%d %B %Y', strtotime($demandeur->created_at));
                          $date_en_lettres_naissance = strftime('%d %B %Y', strtotime($demandeur->Date_de_Naissance));
                        ?>
                            @if ($demandeur->etat == 0)
                            <tr id="row-{{ $loop->index }}">
                              <td>{{ $demandeur->Nom }}</td>
                              <td>{{ $date_en_lettres_naissance }}</td>
                              <td>{{ $demandeur->Lieu_de_Naissance }}</td>
                              <td>
                                <a class="btn btn-primary" href="{{ route('demandeurs.edit', ['id' => $demandeur->id]) }}">Ajout Numero/Modification</a>
                              </td>
                              <td>
                                  <div>
                                    <span class="badge status-badge bg-warning">
                                      Dossier en cours 
                                        <i class="fas fa-hourglass-start"></i>
                                    </span>
                                  </div>
                              </td>
                              <td>{{ $date_en_lettres_created_at }}</td>

                          </tr>
                          @elseif ($demandeur->etat == 1)
                          <tr id="row-{{ $loop->index }}">
                            <td>{{ $demandeur->Nom }}</td>
                            <td>{{$date_en_lettres_naissance}}</td>
                            <td>{{ $demandeur->Lieu_de_Naissance }}</td>
                            <td></td>
                            <td>
                                <div>
                                  <span class="badge status-badge bg-success">
                                    Dossier traiter
                                      <i class="fas fa-check"></i>
                                  </span>
                                </div>
                            </td>
                            <td>{{ $date_en_lettres_created_at }}</td>

                        </tr>
                          @elseif ($demandeur->etat == 2)
                          <tr id="row-{{ $loop->index }}">
                            <td>{{ $demandeur->Nom }}</td>
                            <td>{{ $date_en_lettres_naissance}}</td>
                            <td>{{ $demandeur->Lieu_de_Naissance }}</td>
                            <td>
                            </td>
                            <td>
                                <div>
                                    <span class="badge status-badge" style="background:rgb(255, 102, 0);">
                                      Dossier renvoyer
                                        <i class="fas fa-times"></i>
                                    </span>
                                </div>
                            </td>
                            <td>{{ $date_en_lettres_created_at }}</td>

                        </tr>
                            @endif
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
              
              
              <div class="d-flex justify-content-between align-items-center" style="margin-left: 2%">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        {{ $demandeurs->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
                <div class="elements-count">
                    Affichage de {{ $demandeurs->count() }} sur {{ $demandeurs->total() }} éléments
                </div>
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
 function filterByPeriod(period, page = 1) {
    function formatDate(createdAt) {
        const date = new Date(createdAt);
        return new Intl.DateTimeFormat('fr-FR', { day: '2-digit', month: 'long', year: 'numeric' }).format(date);
    }

    // Requête AJAX pour récupérer les demandeurs filtrés
    fetch(`/demandeurs/filter?period=${period}&page=${page}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur de réseau');
            }
            return response.json();
        })
        .then(data => {
            const tbody = document.getElementById('demandeurs-list');
            tbody.innerHTML = '';

            if (data.demandeurs.length > 0) {
                data.demandeurs.forEach((demandeur) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${demandeur.Nom}</td>
                        <td>${formatDate(demandeur.Date_de_Naissance)}</td>
                        <td>${demandeur.Lieu_de_Naissance}</td>
                        <td>${demandeur.etat == 0 ? `<a class="btn btn-primary" href="/demandeurs/edit/${demandeur.id}">Ajout Numero/Modification</a>` : ''}</td>
                        <td>
                            <span class="badge status-badge ${getBadgeClass(demandeur.etat)}">
                                ${getBadgeText(demandeur.etat)}
                                <i class="fas ${getIconClass(demandeur.etat)}"></i>
                            </span>
                        </td>
                        <td>${formatDate(demandeur.created_at)}</td>
                    `;
                    tbody.appendChild(row);
                });
            } else {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center">Aucun élément</td></tr>`;
            }

            // Mettre à jour la pagination
            const paginationNav = document.querySelector('.pagination');
            paginationNav.innerHTML = data.pagination;

            // Mettre à jour l'affichage du compteur d'éléments
            const elementsDisplay = document.querySelector('.elements-count');
            elementsDisplay.innerHTML = `Affichage de ${data.demandeurs.length} sur ${data.total} éléments`;

            // Ajouter des gestionnaires d'événements pour les liens de pagination
            const links = paginationNav.querySelectorAll('.page-link');
            links.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault(); // Empêche le comportement par défaut
                    const page = new URL(link.href).searchParams.get('page'); // Récupère le numéro de page
                    filterByPeriod(period, page); // Appelle la fonction avec le nouveau numéro de page
                });
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
            const tbody = document.getElementById('demandeurs-list');
            tbody.innerHTML = `<tr><td colspan="7" class="text-center">Erreur lors du chargement des données</td></tr>`;
        });
}

// Exemple de fonctions pour les badges et icônes
function getBadgeClass(etat) {
    switch (etat) {
        case 0: return 'bg-warning';
        case 1: return 'bg-success';
        case 2: return 'bg-danger';
        default: return 'bg-secondary';
    }
}

function getBadgeText(etat) {
    switch (etat) {
        case 0: return 'Dossier en cours';
        case 1: return 'Dossier traité';
        case 2: return 'Dossier renvoyé';
        default: return 'Inconnu';
    }
}

function getIconClass(etat) {
    switch (etat) {
        case 0: return 'fa-hourglass-start';
        case 1: return 'fa-check';
        case 2: return 'fa-times';
        default: return 'fa-question';
    }
}


// Fonction pour déterminer la classe de badge selon l'état
function getBadgeClass(etat) {
    switch (etat) {
        case 0:
            return 'bg-warning'; // Non traité
        case 1:
            return 'bg-success'; // Traité
        case 2:
            return 'bg-danger'; // Refusé
        default:
            return '';
    }
}

// Fonction pour déterminer le texte du badge selon l'état
function getBadgeText(etat) {
    switch (etat) {
        case 0:
            return 'Dossier non traité';
        case 1:
            return 'Dossier traité';
        case 2:
            return 'Dossier refusé';
        default:
            return '';
    }
}

// Fonction pour déterminer l'icône selon l'état
function getIconClass(etat) {
    switch (etat) {
        case 0:
            return 'fa-hourglass-start'; // Non traité
        case 1:
            return 'fa-check'; // Traité
        case 2:
            return 'fa-times'; // Refusé
        default:
            return '';
    }
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
    