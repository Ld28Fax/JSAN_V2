<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Information du profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez à jour les informations de profil et l'adresse e-mail de votre compte.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="Cour_appel" :value="__('Cour d\'appel')" />
            <select name="Cour_appel" id="Cour_appel" class="block mt-2 w-full rounded-md border-gray-300" style="background-color: white; color:black" :value="old('Cour_appel')" required autofocus onchange="updateTPIOptions()">
                <option value="">{{ $user->Cour_appel }}</option>
                <option value="ANTANANARIVO">ANTANANARIVO</option>
                <option value="ANTSIRANANA">ANTSIRANANA</option>
                <option value="FIANARANTSOA">FIANARANTSOA</option>
                <option value="MAHAJANGA">MAHAJANGA</option>
                <option value="TOAMASINA">TOAMASINA</option>
                <option value="TOLIARA">TOLIARA</option>
            </select>
            <x-input-error :messages="$errors->get('Cour_appel')" class="mt-2" />
        </div>

         <!-- TPI -->
         <div>
            <x-input-label for="TPI" :value="__('TPI')" />
            <select name="TPI" id="TPI" class="block mt-2 w-full rounded-md border-gray-300"  style="background-color: white; color:black":value="old('TPI')" required autofocus>
                <option value="">{{ $user->TPI }}</option>
                
            </select>
            <x-input-error :messages="$errors->get('TPI')" class="mt-2" />
        </div>
        
        <!-- Numero telephone -->
        <div>
            <x-input-label for="telephone" :value="__('Telephone')" />
            <x-text-input id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}" type="number" placeholder="000 00 000 00" class="mt-1 block w-full" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Votre adresse e-mail n\'est pas vérifiée.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    const tpiOptions = {
        "ANTANANARIVO": [
            "TPI AMBATOLAMPY", "TPI ANKAZOBE", "TPI ANTANANARIVO", "TPI ANTSIRABE",
            "TPI ARIVONIMAMO", "TPI AVARADRANO", "TPI MIARINARIVO", "TPI TSIROANOMANDIDY"
        ],
        "ANTSIRANANA": [
            "TPI AMBANJA", "TPI AMBILOBE", "TPI ANTALAHA", "TPI ANTSIRANANA", 
            "TPI NOSY BE", "TPI SAMBAVA"
        ],
        "FIANARANTSOA": [
            "TPI AMBOSITRA", "TPI FARAFANGANA", "TPI FIANARANTSOA", "TPI IHOSY", 
            "TPI IKONGO", "TPI MANAKARA", "TPI MANANJARY", "TPI VANGAINDRANO"
        ],
        "MAHAJANGA": [
            "TPI ANALALAVA", "TPI ANTSOHIHY", "TPI BESALAMPY", "TPI BORIZINY", 
            "TPI MAEVATANANA", "TPI MAHAJANGA", "TPI MAINTIRANO", "TPI MAMPIKONY", 
            "TPI MANDRITSARA"
        ],
        "TOAMASINA": [
            "TPI AMBATONDRAZAKA", "TPI FENOARIVO ATSINANANA", "TPI MAROANTSETRA", 
            "TPI MORAMANGA", "TPI SAINTE-MARIE", "TPI TOAMASINA", "TPI VATOMANDRY"
        ],
        "TOLIARA": [
            "TPI AMBOVOMBE", "TPI AMPANIHY", "TPI ANKAZOABO ATSIMO", "TPI BELO-SUR-TSIRIBIHINA", 
            "TPI BETROKA", "TPI MIANDRIVAZO", "TPI MOROMBE", "TPI MORONDAVA", 
            "TPI TOLAGNARO", "TPI TOLIARA"
        ]
    };


    // function pour generer automatiquement les TPI dans chaque cour_appel

    function updateTPIOptions() {
        const courAppel = document.getElementById("Cour_appel").value;
        const tpiSelect = document.getElementById("TPI");

        // Effacer les anciennes options
        tpiSelect.innerHTML = '<option value=""></option>';

        // Si une cour d'appel est sélectionnée, ajouter les TPI associés
        if (courAppel && tpiOptions[courAppel]) {
            tpiOptions[courAppel].forEach(tpi => {
                const option = document.createElement("option");
                option.value = tpi;
                option.textContent = tpi;
                tpiSelect.appendChild(option);
            });
        }
    }
</script>
