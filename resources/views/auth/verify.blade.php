@extends('layouts.main')

@section('content')
<main class="sm:container main-container">
    <div class="flex">
        <div class="w-full">

            @if (session('resent'))
            <div class="alert-ok"
                role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif

            <section class="form-container">
                <header class="form-header">
                    {{ __('Verify Your Email Address') }}
                </header>

                <div class="w-full flex flex-wrap text-gray-700 leading-normal text-sm p-6 space-y-4 sm:text-base sm:space-y-6">
                    <p>
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                    </p>

                    <p>
                        {{ __('Resend Verification Email') }}, <a
                            class="form-link cursor-pointer"
                            onclick="event.preventDefault(); document.getElementById('resend-verification-form').submit();">{{ __('click here to request another') }}</a>.
                    </p>

                    <form id="resend-verification-form" method="POST" action="{{ route('verification.resend') }}"
                        class="hidden">
                        @csrf
                    </form>
                </div>

            </section>
        </div>
    </div>
</main>
@endsection
