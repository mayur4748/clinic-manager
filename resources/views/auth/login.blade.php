<x-guest-layout>
    <!-- SESSION STATUS -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="bg-white shadow-lg rounded-lg p-8">
        <!-- TITLE -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Login Account
            </h2>
            <p class="text-gray-500 mt-2">
                Welcome back! Please login.
            </p>
        </div>
        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- EMAIL -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- PASSWORD -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- REMEMBER -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">
                        {{ __('Remember me') }}
                    </span>
                </label>
            </div>
            <!-- FOOTER -->
            <div class="flex items-center justify-between mt-6">
                <!-- REGISTER -->
                <div>
                    <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-800 underline">
                        Create Account
                    </a>
                </div>
                <!-- RIGHT SIDE -->
                <div class="flex items-center gap-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                    <x-primary-button>
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>