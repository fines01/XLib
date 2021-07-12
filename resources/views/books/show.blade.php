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
                                    @foreach($title as $title)

                                    {{-- *** Haha, so funktioniert es auch: (da ->get() Collection liefert, ev find(), würde Objekt liefern) --}}
                                    @foreach($item as $item)@endforeach
                                    {{-- *** --}}

                                        <tr>
                                            <th scope="row">{{ __('Title') }}</th>
                                            <td>{{ $title->title }}</td>
                                            <td>{{ $title->subtitle }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Author') }}</th>
                                            <td>{{ $title->author->first_name }}</td>
                                            <td>{{ $title->author->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Category') }}</th>
                                            <td>{{ $title->category->type . ': ' . $title->category->category_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ISBN</th>
                                            <td>ISBN-10: {{ $title->isbn_10 }}</td>
                                            <td>ISBN-13: {{ $title->isbn_13 }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ __('Puclication') }}</th>
                                            
                                            <th scope="col">{{ __('Publisher') }}</th>
                                            <th scope="col">{{  __('Edition') }}</th>
                                            <th scope="col">{{ __('Publication format') }}</th>
                                        </tr>
                                        
                                        <tr>
                                            {{-- <th scope="row">{{ __('Puclication') }}</th> --}}
                                            <th scope="row"></th>
                                            <td>{{ $title->publisher }}</td>
                                            <td>{{ $title->publication_year . '; ' . $title->edition .'.'. __(' Edition') }}</td>
                                            <td>{{ $title->publication_format  }}</td>
                                            {{-- <td>{{ __('Publication format').': ' . $title->publication_format }}</td> --}}
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ 'Info' }}</th>
                                            <th scope="col">{{ __('Condition') }}</td>
                                            <th scope="col"></td>
                                        </tr>

                                        <tr>
                                            <th scope="row"></th>
                                            <td>{{ $item->condition }}</td>
                                            <td>{{ $title->description }} 
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ __(' Booking status') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th scope="col">{{ __('Preferred delivery methods')}} </th>
                                        </tr>
                                        
                                        <tr>
                                            <th></th>
                                            <td>
                                            @if ($item->status->available)
                                                {{ __('available') }} @else {{ __('not available') }} @endif
                                            </td>
                                            <td>
                                                {{-- @foreach --}}
                                            <ul><li>{{ $item->possible_delivery_methods }}</li></ul>
                                            </td>
                                        </tr>

                                        @if (!($item->status->available))
                                            <tr>
                                                <th scope="row">{{ __('Booking Information') }}</th>
                                                <td>{{ $item }}</td>
                                                <td>{{ __('Bookind date') }}</td>
                                                <td>{{ __('Expected return') }}</td>
                                                <td>{{ __('Delivery')  }}</td>
                                            </tr>
                                            @foreach($item->status() as $item)
                                            <tr>
                                                <th scope="row"></th>
                                                <td>{{ $item }}</td>
                                                <td>{{ $item->booking_date }}</td>
                                                <td>{{ $item->return_date }}</td>
                                                <td>{{ $item->delivery_method }}</td>
                                            </tr>
                                            @endforeach
                                        @endif                                       
                                    @endforeach    
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-8">
                            {{-- $item->title_id sn mit title_id üb ??? --}}
                            <a href="{{ route('books.edit', $title->id) }}"
                                class="form-button">{{ __('Edit') }}</a>
                            {{-- <a href="{{ route('books.index') }}" class="form-button delete-btn">{{ __('Delete') }}</a> --}}

                             <form action="{{ route('books.index') }}" method="POST" ,
                                class="inline-flex delete-form" data-title="{{ $item->title }}"
                                data-body="{{ __('Do you really want to delete the book') }}?">
                                @csrf
                                @method('delete')
                                <button type="submit" class="form-button delete-btn ">{{ __('Delete') }}</button>
                            </form>
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
