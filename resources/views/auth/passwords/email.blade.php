@extends('layouts.main')

@section('content')

    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                @if (session('status'))
                    <div class="text-sm text-green-700 bg-green-100 px-5 py-6 sm:rounded sm:border sm:border-green-400 sm:mb-6"
                        role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <section class=" bg-white form-container">
                    <header class="form-header">
                        {{ __('Reset Password') }}
                    </header>

                    <form class="form space-y-6 sm:space-y-8" method="POST"
                        action="{{ route('password.email') }}">
                        @csrf

                        <div class="flex flex-wrap">
                            <label for="email" class="form-label">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email"
                                class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div
                            class="flex flex-wrap justify-center items-center space-y-6 pb-6 sm:pb-10 sm:space-y-0 sm:justify-between">
                            <button type="submit"
                                class="form-button">
                                {{ __('Send Password Reset Link') }}
                            </button>

                            <p
                                class="mt-4 text-xs text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline hover:underline sm:text-sm sm:order-0 sm:m-0">
                                {{-- text-blue-500 hover:text-blue-700 no-underline hover:underline --}}
                                <a class="form-link hover:no-underline" href="{{ route('login') }}">
                                    {{ __('Back to login') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>
@endsection
