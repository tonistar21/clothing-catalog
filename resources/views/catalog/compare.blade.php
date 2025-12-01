<x-app-layout>

    <div class="max-w-6xl mx-auto py-10 px-4">

        <h1 class="text-3xl font-extrabold text-gray-800 mb-6">
            ⚖️ Порівняння товарів
        </h1>

        <!-- Форма вибору товарів -->
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white p-6 rounded-xl shadow">

            <div>
                <label class="text-sm text-gray-600">Перший товар</label>
                <select name="product1"
                        class="w-full mt-1 p-3 border rounded-xl focus:ring-gray-700">

                    <option value="">— виберіть товар —</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" {{ request('product1') == $p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-600">Другий товар</label>
                <select name="product2"
                        class="w-full mt-1 p-3 border rounded-xl focus:ring-gray-700">

                    <option value="">— виберіть товар —</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" {{ request('product2') == $p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button class="w-full bg-gray-800 text-white py-3 rounded-xl hover:bg-gray-700">
                    Порівняти
                </button>
            </div>

        </form>

        <!-- Результат порівняння -->
        @if($selected && $selected[0] && $selected[1])

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

                @foreach($selected as $product)
                    <div class="bg-white rounded-xl shadow p-6 border">

                        <!-- Фото -->
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="w-full h-64 object-cover rounded-xl mb-4"
                             onerror="this.src='https://via.placeholder.com/400'">

                        <!-- Назва -->
                        <h2 class="text-xl font-bold text-gray-900 mb-2">
                            {{ $product->name }}
                        </h2>

                        <!-- Категорія -->
                        <p class="text-sm text-gray-500 mb-2">
                            Категорія: <span class="font-medium">{{ $product->category->name }}</span>
                        </p>

                        <!-- Опис -->
                        <p class="text-gray-700 mb-4">
                            {{ $product->description }}
                        </p>

                        <!-- Ціна -->
                        <p class="text-2xl font-bold text-gray-900 mb-4">
                            {{ $product->price }} грн
                        </p>

                        <!-- Кнопка перегляду -->
                        <a href="{{ route('product.show', $product) }}"
                           class="mt-3 inline-block px-5 py-2 bg-gray-800 text-white rounded-xl hover:bg-gray-700">
                            Переглянути товар
                        </a>

                    </div>
                @endforeach

            </div>

            <!-- Таблиця різниць -->
            <div class="mt-12 bg-white p-6 rounded-xl shadow border">

                <h2 class="text-2xl font-extrabold mb-4 text-gray-800">📊 Порівняльна таблиця</h2>

                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Характеристика</th>
                            <th class="px-4 py-2">{{ $selected[0]->name }}</th>
                            <th class="px-4 py-2">{{ $selected[1]->name }}</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        <tr>
                            <td class="px-4 py-2 font-medium">Ціна</td>
                            <td class="px-4 py-2">{{ $selected[0]->price }} грн</td>
                            <td class="px-4 py-2">{{ $selected[1]->price }} грн</td>
                        </tr>

                        <tr>
                            <td class="px-4 py-2 font-medium">Категорія</td>
                            <td class="px-4 py-2">{{ $selected[0]->category->name }}</td>
                            <td class="px-4 py-2">{{ $selected[1]->category->name }}</td>
                        </tr>

                        <tr>
                            <td class="px-4 py-2 font-medium">Опис</td>
                            <td class="px-4 py-2">{{ $selected[0]->description }}</td>
                            <td class="px-4 py-2">{{ $selected[1]->description }}</td>
                        </tr>

                    </tbody>
                </table>

            </div>

        @endif

    </div>

</x-app-layout>
