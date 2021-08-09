@extends('layouts.main')

@section('content')

    <div class="sm:mx-auto sm:mt-10 min-h-screen">

        <div class="text-center">

            @if (isset($authorSearch))
                <p>{{ __('Search result: Authors') }}</p>
                @foreach ($authorSearch as $author)
                    <ul>
                        @foreach ($author->first()->titles as $title)
                            <li>
                                <a class="text-blue-800 font-bold"
                                    href="{{ route('authors.show', $author->first()->id) }}">*
                                    {{ $author->first()->first_name . ' ' . $author->first()->last_name }}: </a>
                                <a href="{{ route('titles.show', $title->id) }}"
                                    class="text-blue-900">{{ $title->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @endif

            @if (isset($titleSearch))
                <p>{{ __('Search result: Titles') }}</p>
                @foreach ($titleSearch as $titles)
                    @foreach ($titles as $title)
                        <ul>
                            <li>
                                <a class="text-blue-800 font-bold" href="{{ route('titles.show', $title->id) }}">*
                                    {{ $title->title . ' ' . $title->subtitle }}: </a>
                                <a href="{{ route('authors.show', $title->author->id) }}"
                                    class="text-blue-900">{{ $title->author->first_name . ' ' . $title->author->last_name }}</a>
                            </li>
                        </ul>
                    @endforeach
                @endforeach
            @endif

            {{-- @if (isset($titleSearch))
                <p class="mt-6">{{ __('Search result: Titles') }}</p>
                @foreach ($titleSearch as $title)
                    <ul>
                        <li>
                            <a class="text-blue-800 font-bold"
                                href="{{ route('titles.show', $title->first()->id) }}">{{ $title->first()->title . ' ' . $title->first()->subtitle }}:
                            </a>
                            <a href="{{  }}"
                                class="text-blue-900">{{ $title->first()->author->first_name . ' ' . $title->first()->author->last_name }}</a>
                            {{-- @foreach ($title->first()->author as $author)
                                <a class="text-blue-900 mr-3" href={{ route('authors.show', $title[0]->author->id) }}>*
                                    {{ $title[0]->author['first_name'] . ' ' . $title[0]->author->last_name }}:
                                </a>
                            @endforeach --}}
            {{-- </li>
            </ul>
            @endforeach
            @endif --}}

            @if (!isset($titleSearch) && !isset($authorSearch))
                <div>
                    <p>No results!</p>
                </div>

            @endif


        </div>
    </div>
@endsection
