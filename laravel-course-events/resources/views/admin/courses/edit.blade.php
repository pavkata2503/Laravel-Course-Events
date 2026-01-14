<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Редактиране на курс: {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.courses.update', $course) }}">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Име на курса</label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Начална дата</label>
                            <input type="date" name="start_date" value="{{ old('start_date', $course->start_date->format('Y-m-d')) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Продължителност</label>
                            <input type="number" name="duration_hours" value="{{ old('duration_hours', $course->duration_hours) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Описание</label>
                        <textarea name="description" rows="3" class="shadow border rounded w-full py-2 px-3 text-gray-700">{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Преподавател</label>
                        <select name="lecturer_id" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                            @foreach($lecturers as $lecturer)
                                <option value="{{ $lecturer->id }}" {{ old('lecturer_id', $course->lecturer_id) == $lecturer->id ? 'selected' : '' }}>
                                    {{ $lecturer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Организация</label>
                        <select name="organization_id" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                            @foreach($organizations as $org)
                                <option value="{{ $org->id }}" {{ old('organization_id', $course->organization_id) == $org->id ? 'selected' : '' }}>
                                    {{ $org->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Място</label>
                        <select name="location_id" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ old('location_id', $course->location_id) == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->city_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit">
                            Обнови курса
                        </button>
                        <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-900">Отказ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>