<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- FirstName -->
            <div>
                <x-label for="firstname" :value="__('First Name')" />

                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required
                    autofocus />
            </div>

            <!-- LastName -->
            <div class="mt-4">
                <x-label for="lastame" :value="__('Last Name')" />

                <x-input id="lastame" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
                    required autofocus />
            </div>

            <!-- Contact -->
            <div class="mt-4">
                <x-label for="contact" :value="__('Contact')" />

                <x-input id="contact" class="block mt-1 w-full" type="tel" name="contact" :value="old('contact')"
                    placeholder="ex: 09998887777" required autofocus />
            </div>

            <!-- Birthday -->
            <div class="mt-4">
                <x-label for="birthday" :value="__('Birthday')" />

                <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')"
                    required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
