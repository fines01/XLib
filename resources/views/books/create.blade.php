@extends('layouts.main')

@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <section class="form-container">

                    <header class="form-header">
                        {{ __('Register new book') }}
                    </header>

                    <form class="form sm:space-y-8 space-y-6" method="POST" action="{{ route('') }}">
                        @csrf
                        {{-- AUTHOR --}}
                        <div class="flex flex-wrap">
                            <label class="form-label"><strong>{{ __('Author') }}</strong></label>
                        </div>

                        <div class="flex flex-wrap">
                            <label for="fname" class="form-label">
                                {{ __('First name') }}:
                            </label>

                            <input id="fname" type="text" class="form-input w-full @error('name')  border-red-500 @enderror"
                                name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                            @error('fname')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-wrap">
                            <label for="lname" class="form-label">
                                {{ __('Last name') }}:
                            </label>
                            <input id="lname" type="text"
                                class="form-input w-full @error('lname')  border-red-500 @enderror" name="lname"
                                value="{{ old('lname') }}" required autocomplete="name" autofocus>
                            @error('lname')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- TITLE --}}
                        <div class="flex flex-wrap">
                            <label for="title" class="form-label">
                                {{ __('Title') }}:
                            </label>

                            <input id="title" type="text" class="form-input w-full @error('title') border-red-500 @enderror"
                                name="title" value="{{ old('title') }}" required autocomplete="title">

                            @error('title')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- SUBTITLE --}}
                        <div class="flex flex-wrap">
                            <label for="subtitle" class="form-label">
                                {{ __('Subtitle') }}:
                            </label>
                            <input id="subtitle" type="text"
                                class="form-input w-full @error('subtitle') border-red-500 @enderror" name="subtitle"
                                value="{{ old('subtitle') }}" autocomplete="subtitle">
                            @error('subtitle')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- ISBN --}}
                        <div class="flex flex-wrap">
                            <label for="isbn-10" class="form-label">
                                ISBN-10:
                            </label>
                            <input id="isbn-10" type="text"
                                class="form-input w-full @error('isbn-10') border-red-500 @enderror" name="isbn-10"
                                value="{{ old('isbn-10') }}" autocomplete="isbn-10">
                            @error('isbn-10')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- KATEGORIE --}}
                        {{-- AUSWAHLFELD, dyn aus Kategorien Tabelle --}}
                        {{-- !!!!!!!!!!!!!!!!! --}}
                        
                        {{-- MAX LOAN PERIOD --}}
                        {{-- <div class="flex flex-wrap">
                            <label for="max-loan" class="form-label">
                                {{ __('maximum lending time') }}:
                            </label>
                            <input id="max-loan" type="text"
                                class="form-input w-full @error('isbn-10') border-red-500 @enderror" name="max-loan"
                                value="{{ old('max-loan') }}" autocomplete="max-loan">
                            @error('max-loan')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div> --}}
                        {{-- CONDITION --}}
                        <div class="flex flex-wrap">
                            <label for="condition" class="form-label">
                                {{ __('Condition') }}:
                            </label>
                            <input id="condition" type="text"
                                class="form-input w-full @error('isbn-10') border-red-500 @enderror" name="condition"
                                value="{{ old('condition') }}" autocomplete="condition">
                            @error('condition')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                         {{-- POSSIBLE DELIVERY/ TRANSFER METHODS --}}
                         {{-- besser: CHECKBOXEN !!!!!!!!!!!!!!!!! --}}
                        {{-- <div class="flex flex-wrap">
                            <label for="delivery" class="form-label">
                                {{ __('Possible transfer method') }}:
                            </label>
                            <input id="delivery" type="text"
                                class="form-input w-full @error('delivery') border-red-500 @enderror" name="delivery"
                                value="{{ old('delivery') }}" autocomplete="delivery">
                            @error('delivery')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div> --}}

                        <div class="flex flex-wrap">
                            <label for="isbn-13" class="form-label">
                                ISBN-13:
                            </label>
                            <input id="isbn-13" type="text"
                                class="form-input w-full @error('isbn-13') border-red-500 @enderror" name="isbn-13"
                                value="{{ old('isbn-13') }}" autocomplete=isbn-13">
                            @error('isbn-13')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- PUBLISHER --}}
                        <div class="flex flex-wrap">
                            <label for="publisher" class="form-label">
                                {{ __('Publisher') }}:
                            </label>
                            <input id="publisher" type="text"
                                class="form-input w-full @error('publisher') border-red-500 @enderror" name="publisher"
                                value="{{ old('publisher') }}" required autocomplete=publisher">
                            @error('publisher')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- PUBLICATION YEAR --}}
                        <div class="flex flex-wrap">
                            <label for="year" class="form-label">
                                {{ __('Year of publication') }}:
                            </label>
                            <input id="year" type="text" class="form-input w-full @error('year') border-red-500 @enderror"
                                name="year" value="{{ old('year') }}" autocomplete=publisher">
                            @error('year')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- EDITION --}}
                        <div class="flex flex-wrap">
                            <label for="edition" class="form-label">
                                {{ __('Edition') }}:
                            </label>
                            <input id="edition" type="text"
                                class="form-input w-full @error('edition') border-red-500 @enderror" name="edition"
                                value="{{ old('edition') }}" autocomplete="edition">
                            @error('edition')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- PUBLICATION FORM --}}
                        <div class="flex items-center">
                            <p class="form-label">{{ __('Publication format') }}</p>

                            <input class="form-checkbox" type="radio" id="hardcover" name="format" value="hardcover">
                            <label class="form-check-label" for="hardcover">{{ __('Hardcover') }}</label>

                            <input class="form-checkbox" type="radio" id="softcover" name="format" value="softcover">
                            <label class="form-check-label" for="softcover">{{ __('Softcover') }}</label>

                            <input class="form-checkbox" type="radio" id="other" name="format" value="other">
                            <label class="form-check-label" for="other">{{ __('Other') }}</label>
                        </div>

                        {{-- ASIN --}}
                        <div class="flex flex-wrap">
                            <label for="asin" class="form-label">
                                ISBN-10:
                            </label>
                            <input id="asin" type="text" class="form-input w-full @error('asin') border-red-500 @enderror"
                                name="asin" value="{{ old('asin') }}" autocomplete="asin">
                            @error('asin')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap">
                            <button type="submit" class="form-button">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>

                </section>
            </div>
        </div>
    </main>
@endsection
