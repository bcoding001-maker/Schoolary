<x-guest-layout>
        <div class="max-w-md w-full mx-4">
            <!-- Login Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <!-- Logo SMKN 4 -->
                    <div class="text-center mb-6">
                        <div class="inline-block">
                            <div class="w-24 h-24 bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center transform transition-all duration-300 hover:scale-110 hover:rotate-3 shadow-lg"> 
                                <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo SMKN 4" class="w-20 h-20 object-contain" />
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-center mb-2 text-gray-900 dark:text-gray-100">Welcome Back</h2>
                    <p class="text-center text-gray-600 dark:text-gray-400 mb-8">Please sign in to your account</p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        @if(request('redirect'))
                            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                        @endif

                        <!-- Email Address -->
                        <div class="relative">
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required 
                                   autofocus 
                                   autocomplete="username"
                                   class="peer w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white placeholder-transparent focus:border-indigo-500 focus:ring-indigo-500"
                                   placeholder="Email">
                            <label for="email" 
                                   class="absolute left-2 -top-5 text-sm text-gray-600 dark:text-gray-400 transition-all 
                                          peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3
                                          peer-focus:-top-5 peer-focus:left-2 peer-focus:text-sm peer-focus:text-indigo-500">
                                Email address
                            </label>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="relative">
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   class="peer w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white placeholder-transparent focus:border-indigo-500 focus:ring-indigo-500"
                                   placeholder="Password">
                            <label for="password" 
                                   class="absolute left-2 -top-5 text-sm text-gray-600 dark:text-gray-400 transition-all
                                          peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3
                                          peer-focus:-top-5 peer-focus:left-2 peer-focus:text-sm peer-focus:text-indigo-500">
                                Password
                            </label>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" 
                                       type="checkbox" 
                                       name="remember"
                                       class="rounded border-gray-300 dark:border-gray-300 text-indigo-500 focus:ring-indigo-500 transition-colors duration-200">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" 
                                   class="text-sm text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <button type="submit" 
                                class="w-full relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-white bg-indigo-500 rounded-xl group hover:bg-indigo-600 transition-all duration-300">
                            <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-white rounded-full group-hover:w-56 group-hover:h-56 opacity-10"></span>
                            <span class="relative">Sign In</span>
                        </button>

                        <button type="button"  
                                class="w-full relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-white bg-indigo-500 rounded-xl group hover:bg-indigo-600 transition-all duration-300">
                            <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-white rounded-full group-hover:w-56 group-hover:h-56 opacity-10"></span>
                            <span class="relative">
                                <a href="{{ request('redirect') ? request('redirect') : route('welcome') }}">Back</a>
                            </span>
                        </button>
                    </form>

                    @if (Route::has('register'))
                        <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                                Belum punya akun?
                                <a href="{{ request('redirect') ? route('register', ['redirect' => request('redirect')]) : route('register') }}"
                                   class="font-semibold text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200">
                                    Daftar sekarang
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
</x-guest-layout>
