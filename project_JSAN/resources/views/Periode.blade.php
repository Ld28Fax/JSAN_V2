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
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nom</th>
                      <th>Date de Naissance</th>
                      <th>Lieu de Naissance</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($statistic as $stat )
                        <tr id="row-{{ $loop->index }}">
                                <td>{{$stat->id}}</td>
                                <td>{{$stat->Nom}}</td>
                                <td>{{$stat->Date_de_Naissance}}</td>
                                <td>{{$stat->Lieu_de_Naissance}}</td>
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
    @endsection
</body>
</html>