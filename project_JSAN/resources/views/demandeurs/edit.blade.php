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
            <h1>Modifier le Demandeur</h1>
        
            <div class="card card-default">
                <form class="card-body" action="{{ route('demandeurs.update') }}" method="POST">
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
                              <div class="col-md-6" id="Pere et mere">
            
            
                                {{-- nom --}}
                                <div class="form-group">
                                    <label for="name">Nom et prénom</label>
                                    <input type="text" name="Nom" id="name" class="form-control" value="{{  $demandeur->Nom }}" required >
                                    <input type="hidden" name="id" value="{{ $demandeur->id }}">
                                </div>
            
                                    {{-- Père --}}
                                    <div class="form-group">
                                        <label for="name">Nom du Père</label>
                                        <input type="text" name="Pere" id="name" class="form-control" value="{{  $demandeur->Pere }}" required >
                                        <input type="hidden" name="id" value="{{ $demandeur->id }}">
                                    </div>
                                    
            
                                    {{-- Mère --}}
                                    <div class="form-group">
                                        <label for="name">Nom de la Mère</label>
                                        <input type="text" name="Mere" id="mere" class="form-control" value="{{  $demandeur->Mere }}" required >
                                        <input type="hidden" name="id" value="{{ $demandeur->id }}">
                                    </div>
            
                              </div>
                              <div class="col-md-6" id="Adresse etNaissance">
            
                                    {{-- Adresse --}}
                                    <div class="form-group">
                                        <label for="name">Adresse</label>
                                        <input type="text" name="Adresse" id="name" class="form-control" value="{{  $demandeur->Adresse}}" required >
                                        <input type="hidden" name="id" value="{{ $demandeur->id }}">
                                    </div>
            
                                    {{-- Date de Naissance --}}
                                    <div class="form-group">
                                        <label for="name">Date de Naissance</label>
                                        <input type="date" name="Date_de_Naissance" id="name" class="form-control" value="{{  $demandeur->Date_de_Naissance }}" required >
                                        <input type="hidden" name="id" value="{{ $demandeur->id }}">
                                    </div>
                                        
                                    
                                        {{-- Lieu de naissance --}}
            
                                        <div class="form-group">
                                            <label for="name">Lieu de Naissance</label>
                                            <input type="text" name="Lieu_de_Naissance" id="name" class="form-control" value="{{  $demandeur->Lieu_de_Naissance }}" required >
                                            <input type="hidden" name="id" value="{{ $demandeur->id }}">
                                        </div>
                                  </div>
            
            
                                 
                                      {{-- telephone --}}
                                  <div class="col-md-12"> 
                                    <div class="form-group">
                                        <label for="name">Télephone</label>
                                        <input type="text" name="Telephone" id="name" class="form-control" value="{{  $demandeur->Telephone}}" required >
                                        <input type="hidden" name="id" value="{{ $demandeur->id }}">
                                    </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary ">Modifier</button>    
                    </div>
            
            
                </form>
            </div>
        </div>
    
        @endsection
    </body>
</html>