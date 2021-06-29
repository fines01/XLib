@extends('layouts.main')

@section('content')
<main class="sm:container main-container">
    <div class="flex">
        <div class="w-full">
            <section class="form-container">

                <header class="form-header">
                    {{ __('Confirm Password') }}
                </header>

                <form class="form space-y-6 sm:space-y-8" method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <p class="leading-normal text-gray-500">
                        {{ __('Please confirm your password before continuing.') }}
                    </p>

                    <div class="flex flex-wrap">
                        <label for="password" class="form-label">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                            required autocomplete="new-password">

                        @error('password')
                        <p class="error-msg">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap justify-center items-center space-y-6 pb-6 sm:pb-10 sm:space-y-0 sm:justify-between">
                        <button type="submit"
                        class="form-button">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                        <a class="form-link mt-4 text-xs whitespace-no-wrap sm:text-sm sm:order-0 sm:m-0"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>
                </form>

            </section>
        </div>
    </div>
</main>
@endsection
