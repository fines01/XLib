@extends('layouts.main')
@section('pageTitle', 'Show book')
@section('content')

    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <h1>Einzeltitlel zeigen</h1>
                <div class="mt-8">
                    <a href="{{ route('books.index') }}" class="form-button">{{ __('Go back') }}</a>
                </div>

                <section id="" class="flex flex-row mt-12">

                    <div class="w-full sm:w-1/3 m-3">
                        <img src="https://picsum.photos/300/400" alt="" class="">
                    </div>

                    <div class="w-full sm:w-2/3 m-3">

                        <div class="dashboard-container">
                            <header class="form-header">
                                {{ __('Header blabla') }}
                            </header>
                            <table class="m-3 detail-table">
                                <thead>
                                    <tr>
                                    {{-- <th> Eins</th>
                                    <th>Zwei</th>
                                    <th>Drei</th>
                                    <th>Vier</th>
                                    <th>Fünf</th>
                                    <th>Sechs</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $i => $item)
                                        <tr>
                                            <th scope="row">{{ __('Title') }}</th>
                                            <td>{{ $item->title->title }}</td>
                                            <td>{{ $item->title->subtitle }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Author') }}</th>
                                            <td>{{ $item->title->author->first_name }}</td>
                                            <td>{{ $item->title->author->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Category') }}</th>
                                            <td>{{ $item->title->category->type . ': ' . $item->title->category_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ISBN</th>
                                            <td>ISBN-10: {{ $item->title->isbn_10 }}</td>
                                            <td>ISBN-13: {{ $item->titlel->isbn_13 }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Puclication') }}</th>
                                            <td>{{ $item->title->publisher }}</td>
                                            <td>{{ $item->title->publication_year . ', ' . $item->title->edition . __(' Edition') }}
                                            </td>
                                            <td>{{ $item->title->publication_format }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Status') }}</th>
                                            <td>{{ __('Your preferred delivery methods') . ': ' . $item->possible_delivery_methods }}
                                            </td>
                                            <td>{{ __('Status') . ': ' }}
                                                @if ($item->status->available)
                                                    {{ __('available') }} : {{ __('not available') }} @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ 'Info' }}</th>
                                            <td>{{ __('Condition') . ': ' . $item->condition }}</td>
                                            <td>{{ $item->title->description }}</td>
                                        </tr>

                                        @if ($item->status->available)
                                            <tr>
                                                <th scope="row">{{ __('Booking Information') }}</th>
                                                <td>{{ __('Booked by User ') . ': ' . $item->status->booking->user->username }}
                                                </td>
                                                <td>{{ __('Bookind date') . ': ' . $item->status->booking_date }}</td>
                                                <td>{{ __('Expected return') . ': ' . $item->status->return_date }}</td>
                                                <td>{{ __('Delivery') . ': ' . $item->status->delivery_method }}</td>
                                            </tr>
                                        @endif                                       
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-8">
                            <a href="{{ route('books.edit', $book->title_id) }}"
                                class="form-button">{{ __('Edit') }}</a>
                            <a href="{{ route('books.index') }}" class="form-button delete-btn">{{ __('Delete') }}</a>
                        </div>
                    </div>
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
