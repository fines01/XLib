@extends('layouts.main')
{{-- @extends('layouts.main') --}}

@section('content')

    {{-- HERO picture --}}

    <section id="hero">
        <div>
            <p class="txt-hero">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            <p class="txt-hero">Minima, voluptates? Lorem ipsum dolor sit. Dolorum, consectetur vel!</p>
        </div>
    </section>
    {{-- aber kein max-w-lg --}}
    <main class="sm:container main-container max-w-full">
        <div class="w-full sm:px-6">
            @if (session('status'))
                <div class="alert-ok" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <section id="info" class="dashboard-container">
                <header class="form-header">
                    Info
                </header>
                <div class="w-full p-6">
                    <h3>Lorem, ipsum? </i></h3>
                    <p>System zum gegenseitigen Teilen und zur Verwaltung von Büchern.
                    </p>
                    <p>Mutual book sharing and book management system. Lorem ipsum, dolor sit amet consectetur adipisicing
                        elit. Laudantium delectus eos porro est harum quo
                        et consectetur officiis omnis facere.</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi voluptate ut maxime non ipsum
                        asperiores unde nesciunt voluptatem enim voluptatibus alias, architecto ullam sunt deserunt eaque ad
                        quasi, mollitia laudantium facilis. Eos quae qui, tempora repudiandae quisquam repellendus,
                        accusantium nobis atque similique maiores magnam quam hic amet sit natus esse.</p>
                </div>
            </section>
            {{-- my test- content: --}}
            <section id="showcase" class="dashboard-container mt-12">
                <header class="form-header">
                    Showcase
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
                            <td><img src="https://picsum.photos/90/110" alt=""></td>
                            <td>Lorem ipsum dolor sit.</td>
                            <td>Lorem Ipsum.</td>
                        </tr>
                        <tr>
                            <td><img src="https://picsum.photos/90/110" alt=""></td>
                            <td>Lorem ipsum dolor sit. Lorem, ipsum.</td>
                            <td>Dolor Es Sit</td>
                        </tr>
                        <tr>
                            <td><img src="https://picsum.photos/90/110" alt=""></td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Jane Doe <i class="fas fa-heart"></td>
                        </tr>
                        <tr>
                            <td><img src="https://picsum.photos/90/110" alt=""></td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Joe Doe</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
@endsection
