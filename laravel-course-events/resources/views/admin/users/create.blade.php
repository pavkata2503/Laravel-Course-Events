<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">➕ Добавяне на нов потребител</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block font-bold mb-2 text-gray-700">Име</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2 text-gray-700">Email</label>
                        <input type="email" name="email" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2 text-gray-700">Парола</label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2 text-gray-700">Потвърди парола</label>
                        <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div class="mb-6 bg-gray-50 p-3 rounded border border-gray-200">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_admin" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-5 w-5">
                            <span class="ml-3 text-gray-700 font-bold">Дай права на Администратор</span>
                        </label>
                        <p class="text-xs text-gray-500 mt-1 ml-8">Ако е отметнато, потребителят ще има пълен достъп до админ панела.</p>
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Отказ</a>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded shadow">
                            Създай потребител
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>