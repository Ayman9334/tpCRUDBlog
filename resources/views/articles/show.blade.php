@extends('layout.auth')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto flex flex-col">
            <div class="lg:w-4/6 mx-auto">
                <div>
                    <img alt="content" class="object-cover object-center h-full w-full rounded-lg"
                        src="{{ $article->image ? asset('storage/' . $article->image) : asset('/assets/noimage.png') }}"
                        style="max-height: 600px;width:90%;max-width: 600px;margin: auto;border:1px solid rgba(0, 0, 0, 0.136)">
                </div>
                <div class="flex flex-col sm:flex-row mt-10">
                    <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8 flex flex-col justify-center items-center"
                        style="min-width: 15%">
                        <div
                            class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400 overflow-hidden">
                            <img src="{{ asset($owner['image']) }}" alt="">
                        </div>
                        <div class="flex flex-col items-center text-center justify-center">
                            <h2 class="font-medium title-font mt-4 text-gray-900 text-lg">{{ $owner['name'] }}</h2>
                            <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
                        </div>
                    </div>
                    <div
                        class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $article->title }}</h5>
                        <p class="leading-relaxed text-lg mb-4">{{ $article->description }}</p>
                        
                        @if ($owner['ownItem'] ?? false)
                            <div class="flex gap-2 justify-center">
                                <form action="/article/{{ $article->id }}/edit" method="get">
                                    @csrf
                                    <button
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                                </form>

                                <form action="/article/{{ $article->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                                </form>

                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
