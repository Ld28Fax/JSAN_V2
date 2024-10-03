<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modifications</title>
      </head>

    {{-- <body class="hold-transition sidebar-mini"> --}}
        @extends('dashboard')
        @section('content')
    
        <div class="container">
            <h1>Motif de Non activer</h1>
        
            <div class="card card-default">
                <form class="card-body" action="{{ route('nonactif', ['id' => $demandeur->id]) }}" method="POST">
                    @csrf
            
                    <div class="row">
                        <div class="col-md-12">
            
                            
                            <div class="row">
                                <h2>Le demandeur {{ $demandeur->Nom }} est maintenant inactif
                                </h2>
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
                              <div class="col-md-12 form-group">
                                <label for="motif">Motif:</label>
                                <textarea type="text" name="motif" id="motif" class="form-control"cols="30" rows="10" required></textarea>
                                <input type="hidden" name="id" value="{{ $demandeur->id }}">
                              </div>
                          </div>
                          <button type="submit" class="btn btn-primary ">Ajouter le motif</button>    
                    </div>
            
            
                </form>
            </div>
        </div>
    
        @endsection
    </body>
</html>