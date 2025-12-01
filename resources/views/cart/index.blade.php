<x-app-layout>

<div class="max-w-5xl mx-auto py-10">

    <h1 class="text-3xl font-extrabold mb-6 text-[#1F2937]">🛒 Ваша корзина</h1>

    @if(session('success'))
        <div class="p-4 mb-4 bg-green-100 text-green-800 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if($items->isEmpty())
        <p class="text-gray-600 text-lg text-center">Корзина порожня 😔</p>
    @else

        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200">

            <table class="w-full">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">Товар</th>
                        <th class="px-6 py-3 text-left">Ціна</th>
                        <th class="px-6 py-3 text-left">К-сть</th>
                        <th class="px-6 py-3 text-right">Дії</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                @foreach($items as $item)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 flex items-center gap-4">

                            <!-- Фото -->
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                 class="w-20 h-20 object-cover rounded-xl border"
                                 onerror="this.src='https://via.placeholder.com/150'">

                            <!-- Назва -->
                            <div>
                                <h3 class="font-semibold text-gray-900 text-lg">
                                    {{ $item->product->name }}
                                </h3>
                                <p class="text-gray-500 text-sm">
                                    Категорія: {{ $item->product->category->name }}
                                </p>
                            </div>

                        </td>

                        <!-- Ціна -->
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ number_format($item->product->price, 2) }} грн
                        </td>

                        <!-- Кількість -->
                        <td class="px-6 py-4">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')

                                <input type="number"
                                       name="quantity"
                                       value="{{ $item->quantity }}"
                                       min="1"
                                       class="w-20 px-2 py-1 border rounded-md focus:ring focus:ring-indigo-200">

                                <button class="ml-3 text-sm text-blue-600 hover:text-blue-800">
                                    Оновити
                                </button>
                            </form>
                        </td>

                        <!-- Видалення -->
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800 font-medium">
                                    Видалити
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>

        <!-- Total -->
        <div class="text-right mt-6">
            <span class="text-2xl font-bold text-[#1F2937]">
                Разом:
                {{ number_format($items->sum(fn($i) => $i->product->price * $i->quantity), 2) }} грн
            </span>
        </div>

    @endif

</div>

</x-app-layout>
