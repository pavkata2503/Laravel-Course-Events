<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">📍 Населени места</h2>
            <a href="{{ route('admin.locations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Нов Град</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Град / Населено място</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($locations as $location)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $location->city_name }}</td>
                                <td class="px-6 py-4 text-right font-medium">
                                    <a href="{{ route('admin.locations.edit', $location) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Редакция</a>
                                    <form action="{{ route('admin.locations.destroy', $location) }}" method="POST" class="inline" onsubmit="return confirm('Сигурни ли сте? Това ще изтрие и всички курсове в този град!');">
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