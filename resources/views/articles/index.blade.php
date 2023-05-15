@extends('layout.auth')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto max-w-7xl p-4 pt-8">
        @forelse ($articles as $article)
            <div class="overflow-hidden max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 grid gap-4 mx-auto"
                style="max-width: 300px">
                <div class="flex justify-center overflow-hidden" style="width: 100%;">
                    <img class="rounded-t-lg"
                        src="{{ $article->image ? asset('storage/' . $article->image) : asset('/assets/noimage.png') }}"
                        alt="" style="height: 190px;width: auto;" />
                </div>

                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $article->title }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 mx-line-2">{{ $article->description }}</p>
                    <a href="/article/{{ $article->id }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <p>No listings found</p>
        @endforelse

    </div>
    <div class="paginatelinks mx-auto max-w-7xl p-4">
        {{ $articles->links() }}
    </div>
@endsection
