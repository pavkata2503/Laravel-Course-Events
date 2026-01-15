<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduSystem - Обучения</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white shadow-md fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20"> <div class="flex-shrink-0 flex items-center gap-2">
                    <span class="text-3xl">🎓</span>
                    <span class="font-bold text-2xl text-gray-900 tracking-tight">EduSystem</span>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-base font-medium text-gray-600 hover:text-blue-600 transition">
                                Табло
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-base font-medium text-gray-600 hover:text-blue-600 transition px-3 py-2">
                                Вход
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white text-base font-medium px-5 py-2.5 rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transition transform hover:-translate-y-0.5">
                                    Регистрация
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="pt-32 pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                
                <div class="lg:w-1/2 text-center lg:text-left">
                    <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                        Развийте уменията си <span class="text-blue-600">още днес!</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Открийте стотици курсове, водени от професионални лектори. 
                        Независимо дали търсите ново хоби или кариерно развитие, 
                        ние имаме правилното обучение за вас.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        @auth
                            <a href="{{ route('admin.courses.index') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-blue-700 transition">
                                Разгледай курсове
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-blue-700 transition">
                                Започни безплатно
                            </a>
                            <a href="#courses" class="px-8 py-4 rounded-xl font-bold text-lg text-gray-700 border-2 border-gray-200 hover:border-blue-600 hover:text-blue-600 transition">
                                Научи повече
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="lg:w-1/2 relative">
                    <div class="absolute -inset-4 bg-blue-100 rounded-full blur-2xl opacity-50 -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                         alt="Students" 
                         class="rounded-2xl shadow-2xl border border-gray-100 w-full object-cover h-[400px] lg:h-[500px]">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center text-white">
                <div>
                    <div class="text-4xl font-bold mb-1">150+</div>
                    <div class="text-blue-100">Активни курса</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-1">50+</div>
                    <div class="text-blue-100">Експертни лектори</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-1">24/7</div>
                    <div class="text-blue-100">Достъп до материали</div>
                </div>
            </div>
        </div>
    </section>

    <section id="courses" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Най-новите курсове</h2>
                <p class="mt-2 text-gray-500">Изберете най-подходящото за вас обучение</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if(isset($latestCourses) && count($latestCourses) > 0)
                    @foreach($latestCourses as $course)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 flex flex-col">
                            <div class="h-2 bg-blue-500 w-full"></div>
                            <div class="p-6 flex-grow">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                        Ново
                                    </span>
                                    <span class="text-sm text-gray-500 flex items-center">
                                        ⏱ {{ $course->duration_hours }} часа
                                    </span>
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 min-h-[3.5rem]">
                                    {{ $course->title }}
                                </h3>
                                
                                <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                                    {{ $course->description ?? 'Този курс ще ви даде необходимите знания и умения в избраната област.' }}
                                </p>
                            </div>

                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                                <div class="flex items-center">
                                    @if($course->lecturer && $course->lecturer->photo_path)
                                        <img src="{{ asset('storage/' . $course->lecturer->photo_path) }}" class="h-8 w-8 rounded-full object-cover mr-2 border border-gray-300">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2 text-xs font-bold border border-blue-200">
                                            {{ substr($course->lecturer->name ?? 'L', 0, 1) }}
                                        </div>
                                    @endif
                                    <span class="text-sm font-medium text-gray-900 truncate max-w-[120px]">
                                        {{ $course->lecturer->name ?? 'Лектор' }}
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500 font-medium">
                                    {{ $course->start_date ? $course->start_date->format('d.m.Y') : 'Скоро' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-3 text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                        <div class="text-gray-400 text-5xl mb-4">📭</div>
                        <p class="text-gray-500 text-lg font-medium">Все още няма добавени курсове.</p>
                        @auth
                            <a href="{{ route('admin.courses.create') }}" class="text-blue-600 font-bold mt-2 hover:underline">
                                Добави първия курс &rarr;
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-200 py-10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-4">
                <span class="text-2xl">🎓</span>
                <span class="font-bold text-xl text-gray-900 tracking-tight ml-2">EduSystem</span>
            </div>
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} Курсова работа по PHP базирани работни рамки. Всички права запазени.
            </p>
        </div>
    </footer>

</body>
</html>