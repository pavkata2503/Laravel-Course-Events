<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">✏️ Редакция на организация</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.organizations.update', $organization) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Име на организацията</label>
                        <input type="text" name="name" value="{{ $organization->name }}" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2">Адрес</label>
                        <input type="text" name="address" value="{{ $organization->address }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2">Описание</label>
                        <textarea name="description" class="w-full border rounded p-2" rows="3">{{ $organization->description }}</textarea>
                    </div>

                    <button class="bg-green-600 text-white px-4 py-2 rounded">Обнови</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>