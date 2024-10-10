<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout class="">
        <x-slot name="header">
            <div class="flex">
                <a href="{{ route('dashboard') }}" >
                    <i class="fas fa-arrow-left"></i> Retour à l'accueil
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="margin-left: 10%">
                    {{ __('Votre profil') }}
                </h2>
            </div>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Message de succès -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <!-- Formulaire de mise à jour des infos -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
    
                <!-- Formulaire de mise à jour du mot de passe -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
    
            </div>
        </div>
    </x-app-layout>
    
</body>
</html>
