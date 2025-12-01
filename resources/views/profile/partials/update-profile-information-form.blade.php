<section class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">

    <header class="mb-6">
        <h2 class="text-2xl font-bold text-[#1F2937]">
            Редагування профілю
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Оновіть своє ім’я та email-адресу.
        </p>
    </header>

    <!-- Resend Verification Form -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Update Profile -->
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Ім’я" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-2 block w-full rounded-xl border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-2 block w-full rounded-xl border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-3 bg-yellow-50 text-yellow-700 p-3 rounded-xl text-sm border border-yellow-200">
                    <p>
                        Ваша email-адреса ще не підтверджена.
                        <button form="send-verification"
                                class="underline ml-1 text-yellow-800 hover:text-yellow-900">
                            Надіслати лист повторно
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-green-700 font-medium">
                            Нове посилання для підтвердження відправлено!
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-4">

            <button
                class="px-6 py-3 bg-[#1E2A38] text-white rounded-xl shadow-md hover:bg-[#2A2D34] transition">
                Зберегти
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">
                    Збережено!
                </p>
            @endif

        </div>
    </form>

</section>
