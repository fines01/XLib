@extends('layouts.main')
@section('pageTitle', 'Author details')
@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">
                <h1>{{ __('Titles of ') . $author->first_name . ' ' . $author->last_name }}</h1>
                <section id="" class="dashboard-container mt-12">
                    <header class="form-header">
                        {{ __('') }}
                    </header>
                    <table class="m-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Subtitle') }}</th>
                                <th scope="col">{{ __('Users') }}</th>
                                {{-- Titles.show --}}
                                {{-- <th scope="col">{{ __('Show Details') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($author->titles as $i => $title)
                                <tr>
                                    <td>$i</td>
                                    <td>{{ $title->title }}</td>
                                    <td>{{ $title->subtitle }}</td>
                                    <td>{{ $author->last_name }}</td>
                                    <td>
                                        <ul>
                                         {{-- All User anzeigen, welche Titel haben. Besser in titles.show ? --}}
                                            @foreach ($title->users as $user)
                                                <li><a href="">$user->username</a></li>
                                        </ul>
                                    </td>
                                    {{-- <td><a href="{{ route('titles.show', $title->id) }}" class="btn fa fa-eye"></a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Pagination- Links --}}
                    <div class="pagination">
                        {{ $authors->links() }}
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
