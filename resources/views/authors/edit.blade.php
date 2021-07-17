@extends('layouts.main')
@section('pageTitle', 'Update Author')
@section('content')

    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

             <div class="mt-8">
                    <a href="{{ url()->previous() }}" class="form-button">{{ __('Go back') }}</a>
                    <a href="{{ route('authors.index') }}" class="form-button">{{ __('Show all authors') }}</a>
                </div>

                <section class="form-container">

                    <header class="form-header">
                        {{ __('Register new author') }}
                    </header>
                    <form class="form sm:space-y-8 space-y-6 my-8" action="{{ route('authors.update', $author->id) }}" method="POST">
                    @csrf
                    @method('put')
                        <div class="flex flex-wrap">
                            
                            <div class="w-full ">
                                <label for="fname" class="form-label mb-4">
                                    {{ __('First name') }}:
                                </label>
                                <input id="fname" type="text"
                                    class="form-input w-full block @error('name')  border-red-500 @enderror" name="fname"
                                    value="{{ old('fname', $author->first_name) }}" autocomplete="fname" autofocus>
                                @error('fname')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror


                                <label for="lname" class="form-label mt-8">
                                    {{ __('Last name') }}:
                                </label>
                                <input id="lname" type="text"
                                    class="form-input w-full block @error('lname')  border-red-500 @enderror" name="lname"
                                    value="{{ old('lname', $author->last_name) }}" autocomplete="lname" autofocus>
                                @error('lname')
                                    <p class="error-msg">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <button type="submit" class="form-button mb-8">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>

    {{-- END FORM --}}

@endsection