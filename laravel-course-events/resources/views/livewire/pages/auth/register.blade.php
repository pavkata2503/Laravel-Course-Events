<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-white flex">
    
    <div class="hidden lg:block relative w-0 flex-1">
        <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="University">
        <div class="absolute inset-0 bg-indigo-900 opacity-30"></div> <div class="absolute top-10 left-10 text-white">
            <a href="/" class="text-5xl drop-shadow-lg" wire:navigate>🎓</a>
        </div>
        
        <div class="absolute bottom-10 left-10 right-10 text-white text-center p-8 bg-black bg-opacity-20 rounded-2xl backdrop-blur-sm border border-white/10">
            <h3 class="text-3xl font-bold">Присъединете се към нас</h3>
            <p class="mt-3 text-lg font-light">Създайте профил и започнете своето пътешествие към нови знания още днес.</p>
        </div>
    </div>

    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Създайте нов профил
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Напълно безплатно е и отнема само минута.
                </p>
            </div>

            <div class="mt-8">
                <div class="mt-6">
                    <form wire:submit="register" class="space-y-6">
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Име и Фамилия</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input wire:model="name" id="name" type="text" required autofocus 
                                    class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-3 transition" 
                                    placeholder="Иван Иванов">
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email адрес</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input wire:model="email" id="email" type="email" required 
                                    class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-3 transition" 
                                    placeholder="your@email.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Парола</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input wire:model="password" id="password" type="password" required autocomplete="new-password"
                                    class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-3 transition" 
                                    placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Потвърди парола</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input wire:model="password_confirmation" id="password_confirmation" type="password" required autocomplete="new-password"
                                    class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-3 transition" 
                                    placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                       <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:-translate-y-0.5">
                                Вход
                            </button>

                        <div class="text-center mt-4">
                            <p class="text-sm text-gray-600">
                                Вече имате акаунт? 
                                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition" wire:navigate>
                                    Влезте тук
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>