@extends('layouts.main')
@section('pageTitle', 'Authors')
@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">
                <h1>{{ __('Authors of all currently registered books') }}</h1>
                <section id="" class="dashboard-container mt-12">
                    <header class="form-header">
                        {{ __('Authors') }}
                    </header>
                    <table class="m-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('First name') }}</th>
                                <th scope="col">{{ __('Last Name') }}</th>
                                <th scope="col">{{ __('Show Titles') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $i => $author)
                                <tr>
                                    <td>{{ $i + $authors->firstItem() }}</td>
                                    <td>{{ $author->first_name }}</td>
                                    <td>{{ $author->last_name }}</td>
                                    <td><a href="{{ route('authors.show', $author->id) }}"
                                        class="btn fa fa-eye"></a></td>
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

