<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Demandeur</title>

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

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>

.modal {
    display: none; /* Masquer le modal par défaut */
    position: fixed; /* Rester en place */
    z-index: 1000; /* Au-dessus du contenu */
    left: 0;
    top: 0;
    width: 100%; /* Largeur complète */
    height: 100%; /* Hauteur complète */
    overflow: auto; /* Activer le défilement si nécessaire */
    background-color: rgba(0, 0, 0, 0.5); /* Couleur d'arrière-plan semi-transparente */
}

.modal-content {
    background-color: #fff;
    margin: 15% auto; /* Centrer le modal */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Largeur du modal */
    max-width: 600px; /* Largeur maximale */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}



</style>

{{-- <body class="hold-transition sidebar-mini"> --}}
  @extends('dashboard')
  @section('content')

    <!-- Main content -->
    <section class="content" style="margin-top: 10%">
      <div class="container-fluid">
        
        <!-- /.card -->
        
        <div class="card ">
          
            <form class="card-body" action="{{ route('create_audience') }}" method="POST">
              @csrf
              
                <div class="row">
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
                        
                      
                        <div class="row">
                          <div class="col-md-12">
                                {{-- date de l'audience --}}
                            <div class="form-group">
                              <label>Date de l'Audience:</label>
          
                              <div class="input-group">
                            
                              <input type="date" name="date" class="form-control" placeholder="Date de l'Audience" data-mask >
                              </div>
                            </div>

                            {{-- heure de l'audience --}}
                            <div class="form-group">
                              <label>Heure de l'Audience:</label>
          
                              <div class="input-group">
                                <input type="time" name="heure" class="form-control" placeholder="Heure de l'Audience" data-mask autocomplete="off">
                              </div>
                            </div>

                            {{-- salle de l'audience --}}
                            <div class="form-group">
                              <label>Salle de l'Audience:</label>
          
                              <div class="input-group">
                                <input type="text" name="salle" class="form-control" placeholder="Salle de l'Audience" data-mask autocomplete="off">
                              </div>
                            </div>


                               {{-- Nom du magistrat --}}
                            <div class="form-group">
                                <label>Nom du Magistrat:</label>
            
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                  <input type="text" name="magistrat" class="form-control" placeholder="nom du Magistrat" data-mask autocomplete="off">
                              </div>
                            </div>


                            {{-- Nom du greffier --}}
                            <div class="form-group ">
                              <label>Nom du Greffier:</label>
          
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="greffier" class="form-control" placeholder="nom du greffier" data-mask autocomplete="off">
                              </div>
                            </div>    
                          </div>
                        </div>

                        <button class="btn btn-success col fileinput-button" type='submit'>
                          <i class="fas fa-balance-scale"></i>
                          <span>Enregistrer</span>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>

                <div id="page-content">
                  @foreach ($listeAudience as $audience)
                  <?php
                  setlocale(LC_TIME, 'mg_MG.UTF-8');
                  $date_audience = strftime('%d %B %Y', strtotime($audience->date));
                  ?>
                      <div class="box btn btn-default" onclick="window.location.href='{{ route('audience.demandeurs', $audience->id) }}'">
                          <p>{{ $date_audience }}</p>
                          <p>{{ $audience->heure }}</p>
                      </div>
                  @endforeach
              </div>
              


              <div id="demandeurs-modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h3>Demandeurs</h3>
                    <table id="demandeurs-table">
                        <thead>
                            <tr>
                                <th>Sélectionner</th>
                                <th>Nom</th>
                                <th>Date de création</th>
                            </tr>
                        </thead>
                        <tbody id="demandeurs-body">
                            <!-- Les demandeurs seront ajoutés ici dynamiquement -->
                        </tbody>
                    </table>
                    <button onclick="confirmSelection()">Confirmer</button>
                </div>
            </div>

              </div>
            </section>
          </div>
        </div>
                
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
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('btn-mineur').addEventListener('click', function() {
        document.getElementById('interesse-field').style.display = 'block';
    });

    document.getElementById('btn-majeur').addEventListener('click', function() {
        document.getElementById('interesse-field').style.display = 'none';
    });
});

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
    
    //Date picker
    $('#reservationdate').datetimepicker({
      format: 'L'
    });
    
  
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    
    $('#reservation').daterangepicker()
   
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })

    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    

    $('.duallistbox').bootstrapDualListbox()

    $('.my-colorpicker1').colorpicker()
    
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
  
  Dropzone.autoDiscover = false
  
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)
  
  var myDropzone = new Dropzone(document.body, {
    url: "/target-url",
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false,
    previewsContainer: "#previews",
    clickable: ".fileinput-button"
  })
  
  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })
  
  myDropzone.on("sending", function(file) {
    document.querySelector("#total-progress").style.opacity = "1"
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }


</script>
@endsection
</body>



</html>
