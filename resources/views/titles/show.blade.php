@extends('layouts.main')
@section('pageTitle', 'Show Title')
@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">
                <h1><strong>{{ $title->title . ' ' . $title->subtitle }}</strong>{{ ' ' . __('by') . ' ' . $title->author->first_name . ' ' . $title->author->last_name }}
                </h1>
                <section id="" class="dashboard-container mt-12">
                    <header class="form-header">
                        {{ __('Books') }}
                    </header>
                    <table class="m-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Condition') }}</th>
                                <th scope="col">{{ __('Owner') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Reserve') }}</th>
                                {{-- <th>{{ __('Details') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $i => $book)
                                <tr @if (Auth::user()->id == $book->user->id) class="text-gray-100" @endif>
                                    <td>{{ $i + $books->firstItem() }}</td>
                                    <td>{{ $book->condition }}</td>
                                    <td>{{ $book->user->username }}</td>
                                    <td>
                                        @if ($book->status->available)
                                            {{ __('available') }} @endif
                                    </td>
                                    <td>
                                        @if ($book->status->available && $book->user->id != Auth::user()->id)
                                            <a href="{{ route('bookings.place', [$book->title_id, $book->user_id]) }}"
                                                class="btn fas fa-book"></a>
                                        @elseif (!$book->status->available)
                                            {{ __('Expected return date: ') . $book->status->return_date }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Pagination- Links --}}
                    <div class="pagination">
                        {{ $books->links() }}
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

