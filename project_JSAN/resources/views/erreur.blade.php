<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Page Erreur</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="extern/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="extern/dist/css/adminlte.min.css">
</head>
<body>

    <!-- Main content -->
    <section class="content">
      <div class="error-page" style="margin-left: 20%">
        {{-- <h2 class="headline text-warning"> 403 </h2> --}}

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i>Vous n'êtes pas autorisé à accéder à cette page.</h3>
          <p>
            Retourner au page<a href="{{ route('welcome') }}"> Accueil</a>
          </p>

        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
 

</div>


<!-- jQuery -->
<script src="extern/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="extern/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="extern/dist/js/adminlte.min.js"></script>

</body>
</html>

