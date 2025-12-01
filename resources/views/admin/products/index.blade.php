<x-app-layout>

    <div class="max-w-6xl mx-auto py-10">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-[#1E2A38]">Товари</h1>

            <a href="{{ route('admin.products.create') }}"
               class="px-5 py-2 bg-[#1E2A38] text-white rounded-lg shadow hover:bg-[#253445] transition">
                + Створити товар
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">

            <table class="w-full text-left">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="p-4 text-gray-700 font-semibold">ID</th>
                        <th class="p-4 text-gray-700 font-semibold">Фото</th>
                        <th class="p-4 text-gray-700 font-semibold">Назва</th>
                        <th class="p-4 text-gray-700 font-semibold">Категорія</th>
                        <th class="p-4 text-gray-700 font-semibold">Ціна</th>
                        <th class="p-4 text-gray-700 font-semibold w-32">Дії</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4">{{ $product->id }}</td>

                            <td class="p-4">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         class="h-12 w-12 object-cover rounded shadow">
                                @else
                                    <span class="text-gray-400 text-sm">Немає фото</span>
                                @endif
                            </td>

                            <td class="p-4 font-medium">{{ $product->name }}</td>
                            <td class="p-4 text-gray-600">{{ $product->category->name }}</td>
                            <td class="p-4 text-gray-800 font-semibold">{{ $product->price }} грн</td>

                            <td class="p-4 flex gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                                    Редагувати
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.products.destroy', $product->id) }}"
                                      onsubmit="return confirm('Видалити товар?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                        Видалити
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($products->count() == 0)
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                Товарів поки що немає.
                            </td>
                        </tr>
                    @endif
                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>

    </div>

</x-app-layout>
