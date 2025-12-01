<x-app-layout>

    <div class="max-w-xl mx-auto py-10">

        <h1 class="text-3xl font-bold text-[#1E2A38] mb-8">
            Створити категорію
        </h1>

        <form method="POST" action="{{ route('admin.categories.store') }}"
              class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
            @csrf

            <!-- Name -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Назва категорії</label>
                <input type="text"
                       name="name"
                       required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                       placeholder="Наприклад: Чоловічий одяг">

                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Опис (необов'язково)</label>
                <textarea name="description"
                          rows="3"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                          placeholder="Короткий опис категорії"></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('admin.categories.index') }}"
                   class="px-4 py-2 text-gray-600 hover:text-gray-900 transition">
                    ◀ Назад
                </a>

                <button
                    class="px-6 py-2 bg-[#1E2A38] text-white rounded-lg shadow hover:bg-[#253445] transition">
                    Створити
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
