@extends('layouts.main')

@section('content')
<h1>{{ $category->category_name }}</h1>
<div class="form-button"><a href="{{ route('categories.index') }}">{{ __('All categories') }}</a></div>

 <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <section class="form-container">
                    <header class="form-header">
                        {{ __('Edit category') }}
                    </header>
                    <form class="form sm:space-y-8 space-y-6" method="POST" action="{{ route('categories.update', $category->id) }}">
                        @csrf
                        @method('put')
                        {{-- CATEORY NAME --}}
                        <div class="flex flex-wrap">
                            <label for="title" class="form-label">
                                {{ __('Category name') }}:
                            </label>
                            <input id="category" type="text"
                                class="form-input w-full @error('category') border-red-500 @enderror" name="category"
                                value="{{ old('category', $category->category_name) }}" required>
                            @error('category')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- TYPE --}}
                        <div class="flex items-center">
                            {{-- <legend class="form-label">{{ __('Type') }}</legend> --}}
                            <input class="form-checkbox" type="radio" id=fiction" name="type" value="fiction" @if (old('type', $category->type) == 'fiction') checked @endif>
                            <label class="form-check-label" for="fiction">{{ __('Fiction') }}</label>

                            <input class="form-checkbox" type="radio" id="non-fiction" name="type" value="non-fiction" @if (old('type', $category->type) == 'non-fiction') checked @endif>
                            <label class="form-check-label" for="non-fiction">{{ __('Non-fiction') }}</label>
                        </div>
                        <div class="flex flex-wrap">
                            <button type="submit" class="form-button">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>

@endsection