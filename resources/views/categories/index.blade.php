@extends('layouts.main')

@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">

                <h1>{{ __('All categories') }}</h1>
                <div>
                    <a href="{{ route('categories.create') }}" class="form-button mt-4">{{ __('Create a new category') }}</a>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->type }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td><a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn fa fa-edit"></a></td>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" ,
                                        class="" data-title="" data-body="">
                                        @csrf@method('delete')
                                        <button type="submit" class="btn fa fa-trash"></button>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
                
            </div>
        </div>
    </main>

@endsection
