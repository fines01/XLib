@extends('layouts.main')
@section('pageTitle', 'Bookings')
@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <h1>{{ __('My Bookings') }}</h1>
                <section id="" class="dashboard-container mt-12">
                    <header class="form-header">
                        {{ __('Present Bookings') }}
                    </header>
                    <table class="m-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Owner') }}</th>
                                <th scope="col">{{ __('Booking date') }}</th>
                                {{-- <th scope="row">{{ __('Confirmed by owner') }}</th> --}}
                                <th scope="row">{{ __('Return date') }}</th>
                                <th scope="row">{{ __('Show details') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $i => $booking)
                            @foreach ($books as $book)
                            @foreach($authos as $author)
                                <tr>
                                    <td>{{ $i + $bookings->firstItem() }}</td>
                                    <td>{{ $title->title . '. ' . $title->subtitle }}</td>
                                    <td>{{ $author->first_name . ' ' . $author->last_name }}</td>
                                    <td> {{ $book->user->username  }}</td>
                                    <td>{{ $booking->created_at }}</td>
                                    {{-- <td> </td> --}}
                                    <td>{{ $booking->status->return_date }}</td>
                                    <td><a href="{{ route('bookings.show', $booking->id) }}"
                                        class="btn fa fa-eye"></a></td>
                                    </tr>
                             @endforeach
                             @endforeach
                             @endforeach
                         </tbody>
                    </table>
                    {{-- Pagination- Links --}}
                    <div class="pagination">
                    {{ $bookings->links() }}
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection