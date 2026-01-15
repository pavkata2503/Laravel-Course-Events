<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Моето табло
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            Здравей, {{ Auth::user()->name }}! 👋
                        </h3>
                        <p class="text-gray-500 mt-1">
                            Добре дошли в системата за управление на обучения.
                        </p>
                    </div>
                    <div>
                        @if(Auth::user()->is_admin)
                            <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full font-bold border border-indigo-200 shadow-sm">
                                🛡️ Администратор
                            </span>
                        @else
                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold border border-green-200 shadow-sm">
                                👤 Потребител
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500 hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4 text-2xl">🎓</div>
                            <div>
                                <div class="text-gray-500 text-sm font-medium">Активни обучения</div>
                                <div class="text-2xl font-bold text-gray-800">{{ $coursesCount ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.courses.index') }}" class="text-blue-600 text-sm font-semibold hover:underline">
                                Разгледай всички &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500 hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4 text-2xl">⚙️</div>
                            <div>
                                <div class="text-gray-500 text-sm font-medium">Настройки</div>
                                <div class="text-sm font-bold text-gray-800">Твоят профил</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('profile.edit') }}" class="text-green-600 text-sm font-semibold hover:underline">
                                Редактирай данни &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->is_admin)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-purple-500 hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4 text-2xl">👥</div>
                                <div>
                                    <div class="text-gray-500 text-sm font-medium">Потребители</div>
                                    <div class="text-sm font-bold text-gray-800">Управление</div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.users.index') }}" class="text-purple-600 text-sm font-semibold hover:underline">
                                    Виж всички &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                     <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-orange-500 hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-orange-100 text-orange-600 mr-4 text-2xl">📅</div>
                                <div>
                                    <div class="text-gray-500 text-sm font-medium">Календар</div>
                                    <div class="text-sm font-bold text-gray-800">Предстоящи</div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-gray-400 text-sm">Очаквайте скоро...</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">🆕 Последно добавени курсове</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Курс</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Лектор</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Място</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($courses as $course)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                            {{ $course->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $course->start_date->format('d.m.Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                @if($course->lecturer && $course->lecturer->photo_path)
                                                    <img class="h-6 w-6 rounded-full object-cover mr-2" src="{{ asset('storage/' . $course->lecturer->photo_path) }}">
                                                @endif
                                                {{ $course->lecturer->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $course->location->city_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if(Auth::user()->is_admin)
                                                <a href="{{ route('admin.courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-900">Редакция</a>
                                            @else
                                                <span class="text-gray-400">Преглед</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Няма намерени курсове.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>