<x-app-layout>

    <div class="max-w-6xl mx-auto py-10">

        <h1 class="text-3xl font-extrabold text-[#1F2937] mb-6">
            👥 Користувачі системи
        </h1>

        @if(session('success'))
            <div class="p-4 mb-4 bg-green-100 text-green-800 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 mb-4 bg-red-100 text-red-800 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-xl shadow-lg border border-gray-200 bg-white">

            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Ім'я</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Роль</th>
                    <th class="px-6 py-3 text-right">Дії</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            {{ $user->id }}
                        </td>

                        <td class="px-6 py-4 font-medium">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">

                            @if($user->is_admin)
                                <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-xl">
                                    Адмін
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-700 rounded-xl">
                                    Користувач
                                </span>
                            @endif

                        </td>

                        <td class="px-6 py-4 text-right">

                            @if(auth()->id() !== $user->id)

                                <form method="POST"
                                      action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Видалити користувача?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="px-4 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-xl">
                                        Видалити
                                    </button>

                                </form>

                            @else
                                <span class="text-gray-400 text-sm italic">(це ви)</span>
                            @endif

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </div>

</x-app-layout>
