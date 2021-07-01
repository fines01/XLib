{{-- @extends('layouts.app') --}}
@extends('layouts.main')

@section('content')
    {{-- <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10"> --}}
        <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">
                {{-- <section class="flex flex-col break-words -bg-white --sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg"> --}}
                <section class="form-container">

                    {{-- <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md"> --}}
                    <header class="form-header">
                        Login
                    </header>

                    {{-- <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('login') }}"> --}}
                    <form class="form space-y-6 sm:space-y-8" method="POST"
                        action="{{ route('login') }}">
                        @csrf

                        <div class="flex flex-wrap">
                        {{-- <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4"> --}}
                        <label for="email" class="form-label">
                            {{ __('Email Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        {{-- <p class="text-red-500 text-xs italic mt-4"> --}}
                        <p class="error-msg">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password" class="form-label">
                            {{-- localization, msg in de.json ->test --}}
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                            required>

                        @error('password')
                        <p class="error-msg">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="form-check-label" for="remember">
                            <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('Remember Me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                        {{-- <a class="text-sm whitespace-no-wrap ml-auto ( text-blue-500 hover:text-blue-700 no-underline hover:underline)"
                            href="{{ route('password.request') }}"> --}}
                            <a class="form-link text-sm whitespace-no-wrap ml-auto"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>

                    <div class="flex flex-wrap">
                        {{-- <button type="submit"
                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-300 hover:bg-blue-900 sm:py-4"> --}}
                         <button type="submit"
                        class="form-button">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('register'))
                            {{-- <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8"> --}}
                                <p class="form-link-text">
                                {{ __("Don't have an account?") }}
                                
                                {{-- <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline"
                                    href="{{ route('register') }}">
                                   
                                </a> --}}
                                <a class="form-link"
                                    href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </p>
                        @endif
            </div>
            </form>

            </section>
        </div>
        </div>
    </main>
@endsection
