@extends('layouts.main')
@section('pageTitle', 'books')
@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <h1>{{ __('All Books') }}</h1>
                <div class="mt-8">
                    <a href="{{ route('books.create') }}" class="form-button">{{ __('register a new book') }}</a>
                </div>

                <section id="" class="dashboard-container mt-12">
                    <header class="form-header">
                        {{ __('Your books') }}
                    </header>
                    <table class="m-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"></th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $i => $item)
                                {{-- geht nicht wg pagination, dh.: --}}
                                <tr>
                                    <td></td>
                                    <td>{{ $i + $books->firstItem() }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->authors->first_name . ' ' . $item->last_mame }}</td>

                                    {{-- edit, show and delete buttons, oder edit in show --}}
                                    <td><a href="{{ route('books.show', $item->id) }}"
                                            class="btn fa fa-eye"></a></td>
                                    <td><a href="{{ route('books.edit', $item->id) }}"
                                            class="btn fa fa-edit"></a></td>
                                    <td>
                                        <form action="{{ route('books.destroy', $item->id) }}" method="POST" ,
                                            class="delete-form"
                                            data-title="{{ $item->title }}"
                                            data-body="{{ __('Do you really want to delete this book') }}?">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn fa fa-trash"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- output Pagination- Links (In laravel standardmässig mittels Tailwind gestaltet? ) --}}
                        </tbody>
                    </table>
                    {{-- <div class="pagination">
                        {{ $books->links() }}
                    </div> --}}
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
