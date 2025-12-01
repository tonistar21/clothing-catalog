<x-app-layout>

    <div class="max-w-3xl mx-auto py-10">

        <h1 class="text-3xl font-bold text-[#1E2A38] mb-8">
            Редагувати товар
        </h1>

        <form method="POST"
              action="{{ route('admin.products.update', $product->id) }}"
              enctype="multipart/form-data"
              class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">

            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Назва товару</label>
                <input type="text" name="name"
                       value="{{ old('name', $product->name) }}"
                       required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]">
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Опис</label>
                <textarea name="description" rows="4"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Price -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Ціна (грн)</label>
                <input type="number" step="0.01" name="price"
                       value="{{ old('price', $product->price) }}"
                       required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]">
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Категорія</label>
                <select name="category_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#1E2A38] focus:ring-[#1E2A38]">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Image -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Фото</label>

                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="h-20 w-20 object-cover rounded mb-3 shadow">
                @endif

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
                    Оновити
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
