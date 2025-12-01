<x-app-layout>

    <!-- HERO -->
    <section class="relative py-16 bg-[#F3F4F6]">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h1 class="text-4xl font-extrabold text-[#1E2A38] mb-4 tracking-tight">
                Каталог чоловічого одягу
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Стиль, якість і комфорт. Обирай одяг, який підкреслює твій характер.
            </p>
        </div>
    </section>


    <!-- FILTERS -->
    <section class="max-w-7xl mx-auto px-4 py-10">

        <form method="GET"
              class="grid grid-cols-1 sm:grid-cols-4 gap-4 bg-white p-6 rounded-2xl shadow-lg border border-gray-200">

            <!-- Категорія -->
            <select name="category"
                class="rounded-xl border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38] px-4 py-3 bg-[#F3F4F6]">
                <option value="">Усі категорії</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <!-- Пошук -->
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Пошук товарів..."
                class="rounded-xl border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38] px-4 py-3 bg-[#F3F4F6]">

            <!-- Ціна від -->
            <input type="number"
                name="price_min"
                value="{{ request('price_min') }}"
                placeholder="Ціна від..."
                class="rounded-xl border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38] px-4 py-3 bg-[#F3F4F6]">

            <!-- Ціна до -->
            <input type="number"
                name="price_max"
                value="{{ request('price_max') }}"
                placeholder="Ціна до..."
                class="rounded-xl border-gray-300 focus:border-[#1E2A38] focus:ring-[#1E2A38] px-4 py-3 bg-[#F3F4F6] sm:col-span-1">


            <!-- Кнопка -->
            <button
                class="rounded-xl px-6 py-3 font-medium text-white bg-[#1E2A38] hover:bg-[#2A2D34] transition shadow sm:col-span-1">
                Застосувати
            </button>

        </form>

    </section>


    <!-- PRODUCTS GRID -->
    <section class="max-w-7xl mx-auto px-4 pb-16">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            @forelse($products as $product)

                <a href="{{ route('product.show', $product) }}"
                   class="rounded-2xl p-4 bg-white shadow-md hover:shadow-xl transition group border border-gray-200">

                    <!-- Фото -->
                    <div class="aspect-[3/4] rounded-xl overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                             onerror="this.src='https://via.placeholder.com/600'">
                    </div>

                    <!-- Назва -->
                    <h3 class="mt-4 text-lg font-semibold text-[#1E2A38]">
                        {{ $product->name }}
                    </h3>

                    <!-- Опис -->
                    <p class="text-sm text-gray-500 mt-1">
                        {{ Str::limit($product->description, 45) }}
                    </p>

                    <!-- Ціна -->
                    <div class="mt-3 text-xl font-bold text-[#1E2A38]">
                        {{ $product->price }} грн
                    </div>

                </a>

            @empty

                <p class="text-center text-gray-500 col-span-full text-lg">
                    Товарів не знайдено.
                </p>

            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $products->onEachSide(1)->links() }}
        </div>

    </section>

</x-app-layout>
