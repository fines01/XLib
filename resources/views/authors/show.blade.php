@extends('layouts.main')
@section('pageTitle', 'Author details')
@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <h1>{{ __('Titles of') }} <strong>{{ $author->first_name . ' ' . $author->last_name }}</strong></h1>
                <section id="" class="dashboard-container mt-12">
                    <header class="form-header">
                        {{ $author->first_name . ' ' . $author->last_name }}
                    </header>
                    <table class="m-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col"></th>
                                <th scope="col">{{ __('Show all books by users') }}</th>
                                {{-- TEST: --}}
                                {{-- <th scope="col">{{ __('Users') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($titles as $i => $title)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $title->title . '. ' . $title->subtitle }}</td>
                                    <td>{{ $title->edition . '. ' . _('Edition') }}</td>
                                    <td><a href="{{ route('titles.show', $title->id) }}" class="btn fa fa-eye"></a></td>
                                    {{-- <td>
                                        @foreach ($books as $book)
                                        <ul>
                                            <li><a href="">{{ $book->user->username }}</a></li>
                                        </ul>
                                        @endforeach
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </section>
            </div>
        </div>
    </main>
@endsection
