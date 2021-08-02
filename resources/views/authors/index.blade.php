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
                                @can('admin')
                                <th scope="col">{{ __('Edit') }}</th>
                                {{-- <th>{{ __('Delete') }}</th> --}}
                                @endcan
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
                                        @can('admin')
                                        <td><a href="{{ route('authors.edit', $author->id) }}"
                                            class="btn fa fa-edit"></a></td>
                                            {{-- <td>
                                                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="delete-form"
                                                    data-title="{{ $author->first_name . ' ' . $author->last_name }}"
                                                    data-body="{{ __('Do you really want to delete the author') }}?">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn fa fa-trash"></button>
                                                </form>
                                            </td> --}}
                                        @endcan
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

@if (session('success'))
    @section('jsScript')
        myToastr('success','{{ session('success') }}');
    @endsection
@endif

