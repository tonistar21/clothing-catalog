<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8 border border-gray-200">

        <h2 class="text-3xl font-extrabold text-center text-[#1E2A38] mb-6">
            Вхід у кабінет
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    class="block mt-1 w-full border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Пароль')" class="text-gray-700" />

                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="block mt-1 w-full border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-[#1E2A38] shadow-sm focus:ring-[#1E2A38]"
                           name="remember">

                    <span class="ms-2 text-sm text-gray-600">
                        {{ __('Запамʼятати мене') }}
                    </span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-6">

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-gray-600 hover:text-[#1E2A38] underline">
                        Забули пароль?
                    </a>
                @endif

                <button
                    class="px-6 py-2 bg-[#1E2A38] text-white font-semibold rounded-lg shadow-md hover:bg-[#253445] transition">
                    Увійти
                </button>

            </div>

        </form>
    </div>

</x-guest-layout>
