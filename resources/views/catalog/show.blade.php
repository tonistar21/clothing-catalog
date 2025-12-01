<x-app-layout>

    <section class="max-w-6xl mx-auto px-6 py-12">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

            <!-- Product Image -->
            <div class="relative group">
                <div class="overflow-hidden rounded-3xl shadow-xl bg-gray-100">
                    <img src="{{ asset('storage/'.$product->image) }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
            </div>

            <!-- Product Details -->
            <div class="flex flex-col justify-between">

                <div>
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">
                        {{ $product->name }}
                    </h1>

                    <p class="text-gray-600 leading-relaxed text-lg mb-6">
                        {{ $product->description }}
                    </p>

                    <p class="text-3xl font-bold text-[#1E2A38] mb-4">
                        {{ number_format($product->price, 2) }} грн
                    </p>

                    <p class="text-sm text-gray-500 mb-8">
                        Категорія:
                        <span class="font-medium text-gray-700">
                            {{ $product->category->name }}
                        </span>
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-6">

                    <!-- ADD TO CART -->
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button
                            class="w-full sm:w-auto px-8 py-4 rounded-2xl
                                   bg-[#1E2A38] text-white text-lg font-semibold
                                   hover:bg-[#2A2D34] shadow-md hover:shadow-xl
                                   transition duration-300">
                            🛒 Додати в корзину
                        </button>
                    </form>

                    <!-- BACK -->
                    <a href="{{ route('catalog') }}"
                       class="w-full sm:w-auto px-8 py-4 rounded-2xl
                              border border-gray-300 text-gray-700 text-lg font-semibold
                              hover:bg-gray-100 transition duration-300">
                        ⬅ Повернутись до каталогу
                    </a>

                </div>

            </div>

        </div>

        <!-- Bottom Decorative Divider -->
        <div class="mt-16 border-t border-gray-200 pt-6 text-center text-gray-500 text-sm">
            Дякуємо, що обираєте <span class="font-semibold text-gray-700">MEN'S STORE</span> 💙
        </div>

    </section>

</x-app-layout>
