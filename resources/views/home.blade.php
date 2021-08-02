@extends('layouts.main')
@section('pageTitle', 'Dashboard')

@section('content')

    <main class="sm:container main-container max-w-full">
        <div class="w-full sm:px-6">
            @if (session('status'))
                <div class="alert-ok" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <section class="dashboard-container">
                <header class="form-header">
                    Dashboard
                </header>
                <div class="w-full p-6">
                    <p>
                        {{ __('Welcome '. Auth::user()->username .'! This is your Dashboard') }}.
                    </p>
                        @can('admin')
                           <p>{{ __('You are logged in as Admin') }}.</p>
                        @endcan
                </div>
            </section>
            {{-- test- content: --}}
            <section id="books" class="dashboard-container mt-12">
                <header class="form-header">
                    {{ __('My favorite books | Wishlist | Calendar | Reminders') }}
                </header>
                <table class="m-12">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Titel</th>
                            <th>Autor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="https://picsum.photos/100/150" alt=""></td>
                            <td>Lorem ipsum dolor sit.</td>
                            <td>Lorem Ipsum.</td>
                        </tr>
                        <tr>
                            <td><img src="https://picsum.photos/100/150" alt=""></td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Jane Doe</td>
                        </tr>
                        <tr>
                            <td><img src="https://picsum.photos/100/150" alt=""></td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Joe Doe</td>
                        </tr>
                    </tbody>
                </table>
            </section>
    </main>

    </div>
    </main>
@endsection
