<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">✏️ Редакция на преподавател</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.lecturers.update', $lecturer) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Име</label>
                        <input type="text" name="name" value="{{ $lecturer->name }}" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ $lecturer->email }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2">Телефон</label>
                        <input type="text" name="phone" value="{{ $lecturer->phone }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2">Текуща снимка</label>
                        @if($lecturer->photo_path)
                            <img src="{{ asset('storage/' . $lecturer->photo_path) }}" class="h-20 w-20 rounded object-cover mb-2">
                        @else
                            <p class="text-gray-500 text-sm">Няма качена снимка</p>
                        @endif
                        
                        <label class="block font-bold mt-2 text-sm">Смени снимката (опционално)</label>
                        <input type="file" name="photo" class="w-full border rounded p-2">
                    </div>

                    <button class="bg-green-600 text-white px-4 py-2 rounded">Обнови</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>