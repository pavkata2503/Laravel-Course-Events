<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

// ВНИМАНИЕ: Променяме layout-а на празен, за да може дизайнът да заеме целия екран.
// Ако нямаш 'layouts.app', може да се наложи да махнеш този атрибут или да създадещ празен layout.
// За най-добър резултат, този дизайн работи най-добре без стандартния 'layouts.guest' контейнер.
new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-white flex">
    
    <div class="hidden lg:block relative w-0 flex-1">
        <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1473&q=80" alt="Library">
        <div class="absolute inset-0 bg-blue-900 opacity-20"></div> <div class="absolute bottom-10 left-10 text-white p-6 bg-black bg-opacity-30 rounded-xl backdrop-blur-sm max-w-lg">
            <h3 class="text-2xl font-bold">Учете без ограничения</h3>
            <p class="mt-2">Достъп до стотици курсове и материали по всяко време.</p>
        </div>
    </div>

    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            
            <div class="text-center lg:text-left">
                <a href="/" class="text-4xl" wire:navigate>🎓</a>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Добре дошли отново!
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Моля, влезте в профила си.
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="mt-8">
                <div class="mt-6">
                    <form wire:submit="login" class="space-y-6">
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email адрес
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input wire:model="form.email" id="email" type="email" required autofocus 
                                    class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3" 
                                    placeholder="your@email.com">
                            </div>
                            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Парола
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input wire:model="form.password" id="password" type="password" required autocomplete="current-password"
                                    class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3" 
                                    placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input wire:model="form.remember" id="remember" type="checkbox" 
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-900">
                                    Запомни ме
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500" wire:navigate>
                                        Забравена парола?
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:-translate-y-0.5">
                                Вход
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-sm text-gray-600">
                                Нямате акаунт? 
                                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500" wire:navigate>
                                    Регистрирайте се тук
                                </a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>