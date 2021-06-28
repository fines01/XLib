@extends('layouts.app')
{{-- @extends('layouts.main') --}}

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Dashboard
                </header>

                <div class="w-full p-6">
                    <p class="text-gray-700">
                        You are logged in!
                    </p>
                </div>

                {{-- my test- content: --}}

                {{-- <section id="hero">

                    <div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <p>Minima, voluptates? Lorem ipsum dolor sit. Dolorum, consectetur vel!</p>
                    </div>

                </section> --}}

                {{-- <main class="grid-parent-2"> --}}
                {{-- <main class="grid grid-cols-1 xl:grid-cols-2">

                    <section id="info" class="grid-element">

                        <div class="container-col">
                            <h3>Lorem, ipsum? <i class="fas fa-heart"></i></h3>
                            <p>System zum gegenseitigen Teilen und zur Verwaltung von Büchern.
                            </p>
                            <p>Mutual book sharing and book management system. Lorem ipsum dolor sit amet consectetur
                                adipisicing
                                elit. Vero corrupti ut explicabo laborum, optio corporis
                                sunt adipisci, minima eaque ipsum ipsa dolore. Ducimus perferendis architecto culpa
                                quibusdam
                                recusandae
                                itaque.
                                Ducimus perferendis laudantium excepturi, obcaecati dolorem voluptates minus cum modi
                                doloribus aut
                                quos ut,
                                quasi commodi sit cumque officiis tenetur. Cupiditate!</p>

                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, repellendus.
                                Doloremque,
                                repellat
                                soluta, officiis totam sunt porro dolorem commodi enim laboriosam, aliquid similique
                                pariatur
                                quaerat omnis
                                autem asperiores sapiente dicta? Amet voluptates veritatis dignissimos modi ullam odit
                                reiciendis
                                obcaecati,
                                nobis cumque veniam porro consequatur sequi minima praesentium assumenda doloremque
                                molestiae!</p>
                        </div>
                    </section>

                    <section id="books" class="grid-element">

                        <table>
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
                                    <td>Lorem ipsum dolor sit. Lorem, ipsum.</td>
                                    <td>Autor Autor</td>
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

            </section> --}}
        </div>
    </main>
@endsection
