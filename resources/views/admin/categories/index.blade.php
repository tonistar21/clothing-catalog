<x-app-layout>

    <div class="max-w-5xl mx-auto py-10">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-[#1E2A38]">Категорії</h1>

            <a href="{{ route('admin.categories.create') }}"
               class="px-5 py-2 bg-[#1E2A38] text-white rounded-lg shadow hover:bg-[#253445] transition">
                + Створити категорію
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="p-4 text-gray-700 font-semibold">ID</th>
                        <th class="p-4 text-gray-700 font-semibold">Назва</th>
                        <th class="p-4 text-gray-700 font-semibold">Опис</th>
                        <th class="p-4 text-gray-700 font-semibold w-32">Дії</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4">{{ $category->id }}</td>
                            <td class="p-4 font-medium">{{ $category->name }}</td>
                            <td class="p-4 text-gray-600">{{ $category->description }}</td>

                            <td class="p-4 flex gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                   class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                                    Редагувати
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.categories.destroy', $category->id) }}"
                                      onsubmit="return confirm('Видалити категорію?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                        Видалити
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($categories->count() == 0)
                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-500">
                                Категорій поки що немає.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>

</x-app-layout>
