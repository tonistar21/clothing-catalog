<x-app-layout>

    <div class="max-w-3xl mx-auto py-10">

        <h1 class="text-3xl font-bold text-[#1E2A38] mb-8">
            Створити товар
        </h1>

        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data"
              class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">

            @csrf

            <!-- Name -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Назва товару</label>
                <input type="text" name="name"
                       required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                       placeholder="Наприклад: Куртка чоловіча">

                @error('name')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Опис</label>
                <textarea name="description" rows="4"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]"
                          placeholder="Опис товару..."></textarea>
            </div>

            <!-- Price -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Ціна (грн)</label>
                <input type="number" name="price" step="0.01" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]">
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Категорія</label>
                <select name="category_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Image -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Фото</label>
                <input type="file" name="image"
                       class="w-full bg-white border-gray-300 rounded-lg shadow-sm">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('admin.products.index') }}"
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
