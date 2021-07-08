@extends('layouts.main')
@section('pageTitle', 'edit category')
@section('content')

<main class="sm:container main-container">
    <div class="flex">
        <div class="w-full">
            {{-- <div class="mx-auto"> --}}
                <a href="{{ route('categories.index') }}" class="form-button my-4">{{ __('All categories') }}</a>
             {{-- </div> --}}
            
            <section class="form-container">
                <header class="form-header">
                    {{ __('Edit category') }}
                </header>
                
                <form class="form sm:space-y-8 space-y-6" method="POST" action="{{ route('categories.update', $category->id) }}">
                    @csrf
                    @method('put')
                        {{-- CATEGORY NAME --}}
                        <div class="flex flex-wrap">
                            <label for="title" class="form-label">
                                {{ __('Category name') }}:
                            </label>
                            <input id="category" type="text"
                                class="form-input w-full @error('category') border-red-500 @enderror" name="category_name"
                                value="{{ old('category', $category->category_name) }}">
                            @error('category')
                                <p class="error-msg">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- TYPE --}}
                        <div class="flex items-center">
                            {{-- <legend class="form-label">{{ __('Type') }}</legend> --}}
                            <input class="form-checkbox" type="radio" id="fiction" name="type" value="fiction" @if (old('type') == 'fiction') checked @endif>
                            <label class="form-check-label ml-1 mr-4" for="fiction">{{ __('Fiction') }}</label>

                            <input class="form-checkbox" type="radio" id="non-fiction" name="type" value="non-fiction" @if (old('type') == 'non-fiction') checked @endif>
                            <label class="form-check-label ml-1 mr-4" for="non-fiction">{{ __('Non-fiction') }}</label>
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

@endsection