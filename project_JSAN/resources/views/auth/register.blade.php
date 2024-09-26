<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Immatriculation -->
        <div>
            <x-input-label for="immatriculation" :value="__('Immatriculation')" />
            <x-text-input id="immatriculation" class="block mt-1 w-full" type="text" name="immatriculation" :value="old('immatriculation')" required autofocus autocomplete="immatriculation" />
            <x-input-error :messages="$errors->get('immatriculation')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

         <!-- Cour_appel -->
         <div>
            <x-input-label for="cour_appel" :value="__('Cour_appel')" />
            <select name="Cour_appel" id="cour_appel" class="block mt-2 w-full rounded-md border-gray-300" :value="old('cour_appel')" required autofocus onchange="updateTPIOptions()">
                <option value=""></option>
                <option value="ANTANANARIVO">ANTANANARIVO</option>
                <option value="ANTSIRANANA">ANTSIRANANA</option>
                <option value="FIANARANTSOA">FIANARANTSOA</option>
                <option value="MAHAJANGA">MAHAJANGA</option>
                <option value="TOAMASINA">TOAMASINA</option>
                <option value="TOLIARA">TOLIARA</option>
            </select>
            <x-input-error :messages="$errors->get('cour_appel')" class="mt-2" />
        </div>
         <!-- TPI -->
        <div>
            <x-input-label for="TPI" :value="__('TPI')" />
            <select name="TPI" id="TPI" class="block mt-2 w-full rounded-md border-gray-300" :value="old('TPI')" required autofocus>
                <option value=""></option>
                
            </select>
            <x-input-error :messages="$errors->get('TPI')" class="mt-2" />
        </div>
            
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmation Mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Inscrire') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

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
        const courAppel = document.getElementById("cour_appel").value;
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
