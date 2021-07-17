@extends('layouts.main')

@section('pageTitle', 'Register a book')
@section('content')

    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <section class="form-container">

                    <header class="form-header">
                        {{ __('Register new book') }}
                    </header>

                    <form class="form sm:space-y-8 space-y-6" method="POST" action="{{ route('books.store') }}">
                        @csrf

                        {{-- AUTHOR --}}
                        {{-- 1.: Dropdown. Besser über ajax & autocomplete, später --}}
                        <div class="flex flex-wrap">
                            <label for="author" class="form-label">
                                {{ __('Author') }}:
                            </label>
                            <select name="author" id="author"
                                class="bg-white focus:shadow-outline focus:outline-none w-full" @error('author')
                                border-red-500 @enderror>
                                <option value="">{{ __('Select...') }}</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" @if (old('author') == $author->id) selected @endif>
                                        {{ $author->first_name . ' ' . $author->last_name }} </option>
                                @endforeach
                            </select>
                            {{-- 2.: author --> create NEW: besser in Modal Feld als eig Seite, ajax, später --}}
                            <p  class="form-link-text font-bold">{{ __('Author not in List?') }}
                        
                            <a href="{{ route('authors.create') }}" class="form-link ml-2">{{ __('Register new Author') }}</a>
                            </p>
                            @error('author')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- <div class="flex flex-wrap">
                            <h3 class=" w-full form-label mb-16">{{ __('Author') }}:</h3>
                            <div class="w-full sm:w-1/2">
                                <label for="fname" class="form-label">
                                    {{ __('First name') }}:
                                </label>
                                <input id="fname" type="text"
                                    class="form-input w-full block @error('name')  border-red-500 @enderror" name="fname"
                                    value="{{ old('fname') }}" autocomplete="fname" autofocus>
                                @error('fname')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="lname" class="form-label">
                                    {{ __('Last name') }}:
                                </label>
                                <input id="lname" type="text"
                                    class="form-input w-full block @error('lname')  border-red-500 @enderror" name="lname"
                                    value="{{ old('lname') }}" autocomplete="name" autofocus>
                                @error('lname')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div> --}}
                        {{-- TITLE --}}
                        <div class="flex flex-wrap">
                            <label for="title" class="form-label">
                                {{ __('Title') }}:
                            </label>
                            <input id="title" type="text" class="form-input w-full @error('title') border-red-500 @enderror"
                                name="title" value="{{ old('title') }}" autocomplete="title">
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
                            <div class="w-full sm:w-1/2">
                                <label for="isbn10" class="form-label">
                                    ISBN-10:
                                </label>
                                <input id="isbn10" type="text"
                                    class="form-input w-full block @error('isbn10') border-red-500 @enderror" name="isbn10"
                                    value="{{ old('isbn10') }}" autocomplete="isbn10">
                                @error('isbn10')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="isbn13" class="form-label">
                                    ISBN-13:
                                </label>
                                <input id="isbn13" type="text"
                                    class="form-input w-full block @error('isbn13') border-red-500 @enderror" name="isbn13"
                                    value="{{ old('isbn13') }}" autocomplete="isbn13">
                                @error('isbn13')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- KATEGORIE --}}
                        {{-- AUSWAHLFELD, dyn aus Kategorien Tabelle. Wenn Kategorien v Admin bearbeitet/ hinzugefügt: wie Übersetzungen generieren und in de.json speichern (bzw engl Übersetzungen generieren) ??? --}}

                        <div class="flex flex-wrap">
                            <label for="category" class="form-label">
                                {{ __('Category') }}:
                            </label>
                            <select name="category" id="category"
                                class="bg-white focus:shadow-outline focus:outline-none w-full" @error('category')
                                border-red-500 @enderror>
                                <option value="">{{ __('Select...') }}</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" @if (old('category') == $cat->id) selected @endif>
                                        {{ $cat->type . ': ' . $cat->category_name }} </option>
                                @endforeach
                                @error('category')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </select>
                        </div>

                        {{-- PUBLISHER --}}
                        <div class="flex flex-wrap">
                            <label for="publisher" class="form-label">
                                {{ __('Publisher') }}:
                            </label>
                            <input id="publisher" type="text"
                                class="form-input w-full @error('publisher') border-red-500 @enderror" name="publisher"
                                value="{{ old('publisher') }}" autocomplete=publisher">
                            @error('publisher')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- PUBLICATION YEAR & EDITION --}}
                        <div class="flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="year" class="form-label">
                                    {{ __('Year of publication') }}:
                                </label>
                                <input id="year" type="text"
                                    class="form-input w-full @error('year') border-red-500 @enderror" name="year"
                                    value="{{ old('year') }}" autocomplete="publisher">
                                @error('year')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="edition" class="form-label">
                                    {{ __('Edition') }}:
                                </label>
                                <input id="edition" type="text" class="form-input w-full" @error('edition') border-red-500
                                    @enderror name="edition" value="{{ old('edition') }}" autocomplete="edition">
                                @error('edition')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- PUBLICATION FORMAT --}}
                        <div class="flex flex-wrap">
                            <h3 class="w-full form-label mb-16">{{ __('Publication format') }}:</h3>
                            <div class="w-full">
                                <input class="form-checkbox" type="radio" id="hardcover" name="format" value="hardcover" @if (old('format') == 'hardcover') checked @endif>
                                <label class="form-check-label ml-1 mr-4" for="hardcover">{{ __('Hardcover') }}</label>

                                <input class="form-checkbox" type="radio" id="softcover" name="format" value="softcover" @if (old('format') == 'softcover') checked @endif>
                                <label class="form-check-label ml-1 mr-4" for="softcover">{{ __('Softcover') }}</label>

                                <input class="form-checkbox" type="radio" id="other" name="format" value="other" @if (old('format') == 'other') checked @endif>
                                <label class="form-check-label ml-1 mr-4" for="other">{{ __('Other') }}</label>
                            </div>
                        </div>

                        {{-- ASIN --}}
                        {{-- <div class="flex flex-wrap">
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
                        </div> --}}

                        {{-- MAX LOAN PERIOD default 60 days --}}
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
                                {{ __('Short description of the condition or additional Info') }}:
                            </label>
                            <textarea id="condition" type="text"
                                class="form-input w-full @error('isbn-10') border-red-500 @enderror" name="condition"
                                value="{{ old('condition') }}" autocomplete="condition" placeholder="o.k.">o.k.</textarea>
                            @error('condition')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- POSSIBLE DELIVERY/ TRANSFER METHODS --}}

                        <div class="flex flex-wrap">
                            <h3 class="form-label w-full mb-4">{{ __('Choose your possible transfer methods') }}:</h3>
                            <input type="checkbox" id="in-person" name="delivery" class="form-checkbox" value="in-person"
                                @if (is_array(old('delivery')) && in_array('in-person', old('delivery'))) checked @endif>
                            <label for="in-person" class="form-check-label ml-2 mr-4">{{ __('In person') }}</label>

                            {{-- @if (isset(Auth::user()->name) && isset(Auth::user()->address)) --}}
                            <input type="checkbox" id="postal" name="delivery" class="form-checkbox" value="postal" @if (is_array(old('delivery')) && in_array('postal', old('delivery'))) checked @endif>
                            <label for="postal" class="form-check-label ml-2 mr-4">{{ __('Postal delivery') }}</label>
                            {{-- @endif --}}

                            @error('delivery')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap">
                            <button type="submit" class="form-button mb-12">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>

                </section>
            </div>
        </div>
    </main>
@endsection

@if (session('success'))
    @section('jsScript')
        myToastr('success','{{ session('success') }}');
    @endsection
@endif