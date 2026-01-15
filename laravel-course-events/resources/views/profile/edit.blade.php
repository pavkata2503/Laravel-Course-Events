<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ⚙️ Настройки на профила
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('status') === 'profile-updated')
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    <p>Данните са запазени успешно!</p>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Информация за профила</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Актуализирайте информацията за профила и имейл адреса си.
                        </p>
                    </header>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Име</label>
                            <input type="text" name="name" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                                Запази
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-red-600">Изтриване на акаунт</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            След като акаунтът ви бъде изтрит, всички негови ресурси и данни ще бъдат изтрити за постоянно.
                        </p>
                    </header>

                    <form method="post" action="{{ route('profile.destroy') }}" class="mt-6" onsubmit="return confirm('Сигурни ли сте, че искате да изтриете акаунта си? Това действие е необратимо!');">
                        @csrf
                        @method('delete')

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">За потвърждение, въведете текущата си парола:</label>
                            <input type="password" name="password" class="border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Парола" required>
                            @error('password')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-500 transition">
                            ИЗТРИЙ АКАУНТА
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>