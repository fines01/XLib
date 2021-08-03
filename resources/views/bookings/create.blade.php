@extends('layouts.main')
@section('pageTitle', 'Booking')

@section('content')

    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">
                @foreach ($book as $book)
                @endforeach

                <div class="">
                    <h1 class="">
                        <strong>{{ $book->title->author->first_name . ' ' . $book->title->author->last_name . ': ' . $book->title->title . ' ' }}</strong>
                    </h1>
                    <h1>{{ __('Provided by user') . ': ' }}<strong>{{ $book->user->username }}</strong></h1>
                </div>

                <div class="mt-8">
                    <a href="{{ url()->previous() }}" class="form-button">{{ __('Go back') }}</a>
                </div>

                <section class="form-container">
                    <header class="form-header">
                        {{ __('Reserve Title') }}
                    </header>

                    <form class="form sm:space-y-8 space-y-6 my-8"
                        action="{{ route('bookings.store', [$book->title->id, $book->user->id]) }}" method="POST">
                        @csrf
                        {{-- hidden input um $title und $user daten zu übermitteln (zum speichern des richtigen Buches/Items) --}}
                        <input type="hidden" name="title" id="title" value="{{ $book->title->id }}" />
                        <input type="hidden" name="user" id="title" value="{{ $book->user->id }}" />

                        <div class="flex flex-wrap">

                            <div class="w-full">
                                <label for="delivery" class="form-label">
                                    {{ __('Choose how you would like to receive the book') }}:
                                </label>

                                <select name="delivery" id="delivery"
                                    class="bg-white focus:shadow-outline focus:outline-none w-full" @error('delivery')
                                    border-red-500 @enderror>
                                    <option value="">{{ __('Select...') }}</option>
                                    {{-- @foreach ($book->possible_delivery_methods as $method) --}}
                                    <option value="{{ $book->possible_delivery_methods }}" @if (old('method') == $book->possible_delivery_methods) selected @endif>
                                        {{ $book->possible_delivery_methods }}
                                    </option>
                                    {{-- @endforeach --}}
                                </select>
                            </div>

                            {{-- Adresse-> b User gespeichert, noch verfeinern --}}
                            <div class="w-full mt-6" id="address-input">
                                <label for="address" class="form-label mb-4">
                                    {{ __('Delivery address') }}:
                                </label>
                                <input id="address" type="text"
                                    class="form-input w-full block @error('address')  border-red-500 @enderror"
                                    name="address" value="{{ old('address') }}" autofocus>
                                @error('address')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <button type="submit" class="form-button mb-8">
                                {{ __('Reserve') }}
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>

    {{-- TEST: --}}
    <script>
        $(document).ready(function() {
            // const select=$('#delivery').val();
            // const input=$("#address-input");
            // console.log(select);
            $("#delivery").change(function() {
                // console.log("OK");
                const select = $(this).val();
                if (select == "postal") {
                    $("#address-input").show();
                } else {
                    $("#address-input").hide();
                }
            });
        });
    </script>

@endsection
