@extends('layouts.main')
@section('pageTitle', 'Show book')
@section('content')

<main class="sm:container main-container">
    <div class="flex">
        <div class="w-full">

            <h1>Einzeltitlel zeigen</h1>
            <div class="mt-8">
                <a href="{{ route('books.index') }}"
                    class="form-button">{{ __('Go back') }}</a>
            </div>

            <section id="" class="flex flex-row mt-12">

                <div class="w-full sm:w-1/3 m-3">
                    <img src="https://picsum.photos/300/400" alt="" class="">
                </div>

                <div class="w-full sm:w-2/3 m-3">

                    <div class="dashboard-container">
                        <header class="form-header">
                            {{ __('Header blabla') }}
                        </header>
                        <table class="m-3 detail-table">
                            <thead>
                                <tr>
                                    {{-- <th> Eins</th>
                                    <th>Zwei</th>
                                    <th>Drei</th>
                                    <th>Vier</th>
                                    <th>Fünf</th>
                                    <th>Sechs</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($books as $i => $book)
                             <tr>
                              <th scope="row">{{ __('Title') }}</th>
                              <td>(Titel)</td>
                              <td>(Subtitel)</td>
                             </tr>
                             <tr>
                              <th scopr="row">{{ __('Author') }}</th>
                              <td>(Vorname)</td>
                              <td>(nachname)</td>
                             </tr>
                             <tr>
                              <th>ISBN</th>

                              <td>isbn10</td>
                              <td>1sbn13</td>
                             </tr>
                             <tr>
                              <th>Kategorie</th>

                              <td>cat</td>
                             </tr>
                             <tr>
                              <th>Publication</th>

                              <td>Publisher</td>
                              <td>Publication year & edition</td>
                              <td>Publication form</td>
                             </tr>
                             <tr>
                              <th>Info</th>

                              <td>condition</td>
                              <td>status</td>
                              <td>possible delivery form</td>
                             </tr>
                             <tr>
                              <th>description</th>

                              <td>description</td>
                             </tr>

                             <tr>
                              <th>more</th>
                              <td></td>
                             </tr>

                             <tr>
                              <th>even more</th>
                             </tr>
                             
                            @endforeach
                            </tbody>

                        </table>

                      
                    </div>

                    <div class="mt-8">
                <a href="{{ route('books.edit', $book->title_id) }}"
                    class="form-button">{{ __('Edit') }}</a>
                    <a href="{{ route('books.index') }}"
                    class="form-button delete-btn">{{ __('Delete') }}</a>
            </div>
                </div>

            </section>

        </div>
    </div>

</main>


{{-- <div class="flex flex-wrap content-start">
 <div class="w-full sm:w-1/5 mx-auto mt-12">
  <button class = "form-button mb-12" > zurück </button>
  <img src="https://picsum.photos/200/300" alt="">
  <button class = "form-button mt-12" > bearbeiten </button>
  <button class = "form-button" > löschen </button>
 </div>
 <div class="w-full sm:w-3/5 mx-auto">
 </div>
</div> --}}

{{-- @foreach($books as $i => $item)
{{ $item->title->author->first_name }}
@endforeach--}}
{{-- BTNS EDIT BOOK, DELETE BOOK (& back?) --}}
{{-- Table --}}

@endsection
