@extends('layouts.main')
@section('pageTitle', 'Titles')
@section('content')
    <main class="sm:container main-container">
        <div class="flex">
            <div class="w-full">
                <h1>{{ __('All registered titles') }}</h1>
                <section id="" class="dashboard-container mt-12">
                    <header class="form-header">
                        {{ __('Titles') }}
                    </header>
                    <table class="m-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"></th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Publication') }}</th>
                                <th scope="col">{{ __('Show registered books') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($titles as $i => $title)
                                <tr>
                                    <td>{{ $i + $titles->firstItem() }}</td>
                                    <td><img src="{{ ($title->title_img) ? url($title->title_img) : url('https://picsum.photos/70/100') }}" alt=""></td>
                                    <td>{{ $title->author->first_name . ' ' .  $title->author->last_name}}</td>
                                    <td><strong>{{ $title->title . ' ' . $title->subtitle }}</strong></td>
                                    <td>{{ $title->publication_year }}</td>
                                    <td><a href="{{ route('titles.show', $title->id) }}"
                                        class="btn fa fa-eye"></a></td>
                                    </tr>
                            @endforeach
                           </tbody>
                          </table>
                    {{-- Pagination- Links --}}
                    <div class="pagination">
                    {{ $titles->links() }}
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
