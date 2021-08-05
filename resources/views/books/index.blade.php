@extends('layouts.main')
@section('pageTitle', 'My books')
@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <h1>{{ __('My books: overview') }}</h1>
                <div class="mt-8">
                    <a href="{{ route('books.create') }}" class="form-button">{{ __('register a new book') }}</a>
                </div>

                <section id="" class="dashboard-container mt-12">
                    <header class="form-header">
                        {{ __('My books') }}
                    </header>
                    <table class="m-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"></th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Category') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Details') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $i => $item)
                                <tr>
                                    
                                    <td>{{ $i + $books->firstItem() }}</td>
                                    <td><img src="{{ ($item->title->title_img) ? url($item->title->title_img) : url('https://picsum.photos/60/100') }}" alt=""></td>
                                    <td>{{ $item->title->author->first_name . ' ' . $item->title->author->last_name }}</td>
                                    <td><strong>{{ $item->title->title . ' ' .$item->title->subtitle}}</strong></td>
                                    <td>{{ $item->title->category->type . ': ' . $item->title->category->category_name }}</td>
                                    {{--show button, edit und delete in show.blade.php ID: auf pivot verweisen (title_id des jew auth users (==title_id wo user_id == user))--}}
                                    <td>{{ $item->status->available ? 'available' : 'not available' }}</td>
                                    <td><a href="{{ route('books.show', $item->title_id) }}"
                                            class="btn fa fa-eye"></a></td>
                                    {{-- <td><a href="{{ route('books.edit', $item->id) }}"
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
                                    </td> --}}
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
