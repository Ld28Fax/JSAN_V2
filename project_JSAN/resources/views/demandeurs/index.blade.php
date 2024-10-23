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
</head>
  <body>
  @extends('dashboard')
  @section('content')

  <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- /.card -->
        
        <div class="card card-default">
          
            <form class="card-body" method="POST" action="{{ route('demandeurs.index')}}">
              @csrf
              
                <div class="row">
                  <div class="col-md-12">
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
                          <div class="col-md-6">

                            {{-- Date de Naissance --}}
                            <div class="form-group" id="interesse-field">
                              <label for="dob">Date de naissance:</label>
                              <input type="date" id="dob" name='Date_de_Naissance' class="form-control" onchange="checkAge()" autocomplete="off">
                            </div>

                            {{-- Lieu de naissance --}}
                            <div class="form-group">
                              <label>Lieu de Naissance</label>

                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" id="lieu" name="Lieu_de_Naissance" class="form-control" placeholder="Lieu de Naissance" data-mask autocomplete="off">
                              </div>
                            </div>

                            {{-- Input caché pour "Intéressé" --}}
                            <div class="form-group" id="interesse-message" style="display: none;">
                              <label>Nom de l'intéressé:</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                  <input type="text" name="interesse" class="form-control" placeholder="nom de l'intéressé" autocomplete="off">
                              </div>
                              <p id="age-message" style="color: red;"></p>
                          </div>

                            {{-- nom --}}
                            <div class="form-group">
                              <label>Nom du demandeur:</label>
          
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="Nom" class="form-control" placeholder="nom du demandeur" autocomplete="off">
                              </div>
                            </div>


                              {{-- Input Distrika --}}
                              <div class="form-group" id="interesse-field">
                                <label>District:</label>
                            
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <select name="distrika" class="form-control select2" id="distrika-select" onchange="ChangementCommune()">
                                      <option value="" disabled selected>Choisissez un distrique</option>
                                      @foreach ($distrika as $distrika)
                                          <option value="{{ $distrika->id }}">{{ $distrika->nom }}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>


                              {{-- Input Kaominina --}}
                              <div class="form-group" id="interesse-field" >
                                <label>Commune:</label>
                              
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                  </div>
                                  <select name="kaominina" class="form-control" id="kaominina-select">
                                    <option value="" disabled selected>Choisissez une commune</option>
                                  </select>
                                </div>
                              </div>

                            <input type="hidden" name="usertpi" value="{{\Illuminate\Support\Facades\Auth::user()->id }}">

                          </div>
                        
                        
                        <div class="col-md-6" id="Adresse etNaissance">
                                {{-- Adresse --}}
                            <div class="form-group">
                              <label>Adresse:</label>
          
                              <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-home"></i></span>
                              </div>
                              <input type="text" name="Adresse" class="form-control" placeholder="Adresse du demandeur" data-mask autocomplete="off">
                              </div>
                            </div>
                               {{-- Père --}}
                               <div class="form-group">
                                <label>Nom du Père:</label>
            
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                  <input type="text" name="Pere" class="form-control" placeholder="nom du Père" data-mask autocomplete="off">
                                </div>
                            </div>
                                    {{-- Mère --}}
                                    <div class="form-group ">
                                      <label>Nom de la Mère:</label>
                  
                                      <div class="input-group">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                                      </div>
                                      <input type="text" name="Mere" class="form-control" placeholder="nom du Mère" data-mask autocomplete="off">
                                      </div>
                                  </div>
                                    
                                    
                                  {{-- telephone --}}
                                  
                                    <div class="form-group">
                                      <label>Télephone:</label>
                                      
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="number" name="Telephone" class="form-control" placeholder="000 00 000 00" data-mask autocomplete="off">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label>genre:</label>
                  
                                      <div class="input-group">
                                      <div class="input-group-prepend">
                                        
                                        <h2>M <i class="fas fa-male"></i></h2> 
                                        <input type="radio" name="genre" value="masculin">
                                      </div>
                                      <div class="input-group-prepend" style="margin-left: 10%">
                                        
                                        <h2>F <i class="fas fa-female"></i></h2> 
                                        <input type="radio" name="genre" value="feminin">
                                      </div>
                                      </div>
                                    </div>
                                 
                                </div>
                                  
                                </div>
                                
                                
                                
                                <button class="btn btn-success col fileinput-button" type='submit'>
                                  <i class="fas fa-plus"></i>
                                  <span>Ajouter</span>
                                </button>
                                
                              </div>
                            </div>
                        </form>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
                
@endsection
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
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

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
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
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
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
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }

  function checkAge() {
    const dobInput = document.getElementById('dob').value;
    const dob = new Date(dobInput);
    const today = new Date();
    
    // Calculer l'âge
    let age = today.getFullYear() - dob.getFullYear();
    const monthDiff = today.getMonth() - dob.getMonth();
    
    // Ajuster l'âge si la date de naissance n'est pas encore passée cette année
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
    }

    // Vérifier l'âge et afficher/masquer les champs
    const interesseMessage = document.getElementById('interesse-message');
    const ageMessage = document.getElementById('age-message');

    if (age < 18) {
        interesseMessage.style.display = 'block';
        ageMessage.textContent = "Le demandeur devez avoir au moins 18 ans, mettez ici son nom.";
    } else {
        interesseMessage.style.display = 'none';
        ageMessage.textContent = "";
    }
}


function ChangementCommune(){
  var distrikaId = $("#distrika-select").val();
        if(distrikaId) {
            $.ajax({
                url: '/get-kaomininas/' + distrikaId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#kaominina-select').empty();
                    $('#kaominina-select').append('<option value="" disabled selected>Choisissez une commune</option>');

                    $.each(data, function(key, value) {
                        $('#kaominina-select').append('<option value="'+ value.id +'">'+ value.nom +'</option>');
                    });
                },
                
                error: function(request, error) {
                    console.log('error' + error); 
                    }
            });
        } else {
            $('#kaominina-select').empty();
        }
}

</script>

</script>
</body>



</html>
