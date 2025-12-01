<section class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <header class="mb-6">
        <h2 class="text-2xl font-bold text-[#1F2937]">
            Зміна пароля
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Використовуйте надійний пароль, щоб захистити свій акаунт.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <x-input-label for="update_password_current_password" value="Поточний пароль" />

            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-2 block w-full rounded-xl border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div>
            <x-input-label for="update_password_password" value="Новий пароль" />

            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-2 block w-full rounded-xl border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                autocomplete="new-password"
            />

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="update_password_password_confirmation" value="Підтвердження пароля" />

            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-2 block w-full rounded-xl border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                autocomplete="new-password"
            />

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-4">
            <button
                class="px-6 py-3 bg-[#1E2A38] text-white rounded-xl shadow-md hover:bg-[#2A2D34] transition">
                Зберегти
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">
                    Пароль оновлено!
                </p>
            @endif
        </div>

    </form>

</section>
