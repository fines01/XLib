@extends('layouts.main')

@section('content')

    <div class="sm:mx-auto sm:mt-10 min-h-screen">

        <div class="text-center">

            @if (isset($authorSearch))
            <p>{{ __('Search result: Authors') }}</p>
                @foreach ($authorSearch as $author)
                    <ul>
                     <li><a class="text-blue-800 font-bold" href="{{ route('authors.show', $author->first()->id) }}">* {{ $author->first()->first_name . ' ' . $author->first()->last_name }}:</a></li>
                     @foreach ( $author->first()->titles as $title )
                     <ul class="list-inside">
                        <li><a href="{{ route('titles.show', $title->id) }}" class="text-blue-900">{{ $title->title }}</a></li>
                       </ul>
                     @endforeach
                    </ul>
                @endforeach
            @endif

            @if (isset($titleSearch))
            <p class="mt-6">{{ __('Search result: Titles') }}</p>
                @foreach ($titleSearch as $title)
                    <ul>
                     <li>
                      {{-- @foreach($title->first()->author as $author) --}}
                      <a class="text-blue-900 mr-3" href={{ route('authors.show', $title->first()->author->id) }}>* {{ $title->first()->author->first_name . ' '. $title->first()->author->last_name}}:
                      </a> 
                      {{-- @endforeach --}}
                      <a class="text-blue-800 font-bold" href="{{ route('titles.show', $title->first()->id) }}">{{ $title->first()->title . ' ' . $title->first()->subtitle }}</a></li>
                    </ul>
                @endforeach
            @endif

            @if (!isset($titleSearch) && !isset($authorSearch))
            <div><p>No results!</p></div>
            
            @endif


        </div>
    </div>
@endsection
