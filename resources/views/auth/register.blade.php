<x-guest-layout>

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8 border border-gray-200">

        <h2 class="text-3xl font-extrabold text-center text-[#1E2A38] mb-6">
            Створення акаунту
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Імʼя')" class="text-gray-700" />
                <x-text-input
                    id="name"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    class="block mt-1 w-full border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username"
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
                    autocomplete="new-password"
                    class="block mt-1 w-full border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Підтвердження пароля')" class="text-gray-700" />
                <x-text-input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="block mt-1 w-full border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            
            <div class="mt-4">
    <label class="inline-flex items-center">
        <input type="checkbox" name="is_admin"
               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
        <span class="ms-2 text-sm text-gray-700">Хочу бути адміністратором</span>
    </label>
</div>


            <!-- Buttons -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-600 hover:text-[#1E2A38] underline">
                    Вже маєте акаунт?
                </a>

                <button
                    class="px-6 py-2 bg-[#1E2A38] text-white font-semibold rounded-lg shadow-md hover:bg-[#253445] transition">
                    Зареєструватися
                </button>
            </div>

        </form>
    </div>

</x-guest-layout>
