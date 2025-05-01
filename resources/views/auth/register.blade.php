<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Firstname -->
        <div>
            <x-input-label for="firstname" :value="__('Prénom')" />
            <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')"
                required autofocus autocomplete="firstname" />
            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Pays -->
        <div class="mt-4">
            <x-input-label for="country" :value="__('Pays')" />
            <select id="country" class="block mt-1 w-full" name="country" required autofocus autocomplete="country">
                <option value="">Sélectionner un pays</option>
                <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                <option value="Allemagne" {{ old('country') == 'Allemagne' ? 'selected' : '' }}>Allemagne</option>
                <option value="Suisse" {{ old('country') == 'Suisse' ? 'selected' : '' }}>Suisse</option>
                <option value="Belgique" {{ old('country') == 'Belgique' ? 'selected' : '' }}>Belgique</option>
                <option value="Luxembourg" {{ old('country') == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                <option value="Espagne" {{ old('country') == 'Espagne' ? 'selected' : '' }}>Espagne</option>
                <option value="Italie" {{ old('country') == 'Italie' ? 'selected' : '' }}>Italie</option>
                <option value="Royaume-Uni" {{ old('country') == 'Royaume-Uni' ? 'selected' : '' }}>Royaume-Uni</option>
                <option value="Pays-Bas" {{ old('country') == 'Pays-Bas' ? 'selected' : '' }}>Pays-Bas</option>
                <option value="Portugal" {{ old('country') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                <option value="Autre" {{ old('country') == 'Autre' ? 'selected' : '' }}>Autre</option>
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Compte déjà créé ?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('S\'enregistrer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
