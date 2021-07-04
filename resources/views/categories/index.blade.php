@extends('layouts.main')
@section('pageTitle', 'categories')
@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <h1>{{ __('All categories') }}</h1>
                <div class="mt-8">
                    <a href="{{ route('categories.create') }}" class="form-button">{{ __('Create a new category') }}</a>
                </div>

                <section id="" class="dashboard-container mt-12">
                    <header class="form-header">
                        {{ __('All categories') }}
                    </header>
                    <table class="m-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Type') }}</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $i => $category)

                                <tr>
                                    {{-- ev. besser fortlaufenden Zähler verwenden als id der DB: --}}
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $category->type }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td><a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn fa fa-edit"></a></td>
                                    <td>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" ,
                                            class="delete-form" data-title="{{ $category->category_name }}"
                                            data-body="{{ __('Do you really want to delete the category') }}?">
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
                    <div class="pagination">
                    {{ $categories->links() }}
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
