<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">🏢 Организации</h2>
            <a href="{{ route('admin.organizations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Нова Организация</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Име</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Адрес</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($organizations as $org)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $org->name }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $org->address ?? '-' }}</td>
                                <td class="px-6 py-4 text-right font-medium">
                                    <a href="{{ route('admin.organizations.edit', $org) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Редакция</a>
                                    <form action="{{ route('admin.organizations.destroy', $org) }}" method="POST" class="inline" onsubmit="return confirm('Изтриване?');">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900">Изтрий</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>