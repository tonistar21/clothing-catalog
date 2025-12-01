<section class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 space-y-6">

    <header>
        <h2 class="text-2xl font-bold text-[#1F2937]">
            Видалення акаунта
        </h2>

        <p class="mt-1 text-sm text-gray-500 leading-relaxed">
            Після видалення акаунта всі дані буде втрачено безповоротно.
            Якщо вам потрібно зберегти інформацію — завантажте її перед видаленням.
        </p>
    </header>

    <!-- Delete Button -->
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow transition font-semibold">
        Видалити акаунт
    </button>

    <!-- Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6 space-y-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-semibold text-[#1F2937]">
                Ви впевнені, що хочете видалити акаунт?
            </h2>

            <p class="text-sm text-gray-600">
                Це дія не може бути скасована. Щоб підтвердити, введіть свій пароль.
            </p>

            <!-- Password Input -->
            <div class="mt-4">
                <x-input-label for="password" value="Пароль" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full rounded-xl border-gray-300 focus:border-red-600 focus:ring-red-600"
                    placeholder="Введіть пароль"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-4">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-5 py-2.5 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-700 transition">
                    Скасувати
                </button>

                <button
                    class="px-6 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow transition">
                    Видалити
                </button>

            </div>
        </form>

    </x-modal>
</section>
