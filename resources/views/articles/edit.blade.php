@extends('layout.auth')

@section('content')
    <div class="mx-auto p-4" style="max-width: 900px;">
        <form method="post" action="/article/{{$article->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="title" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
                    <h2>title :</h2>
                </label>
                <input type="text" id="title" name="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required min="10" max="50" value="{{ $article->title }}">
                @error('title')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
                    Description :</label>
                <textarea id="description" rows="4" name="description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    min='30' required>{{ $article->description }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">
                    Update Image :</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="image" name="image" type="file" accept="image/png, image/jpeg">
                <div class="mx-auto mt-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">
                        Old Image :</label>
                    <img alt="content" class="edit-image object-cover object-center h-full w-full rounded-lg"
                        src="{{ $article->image ? asset('storage/' . $article->image) : asset('/assets/noimage.png') }}"
                        style="max-height: 600px;width:90%;max-width: 600px;margin: auto;border:1px solid rgba(0, 0, 0, 0.136)">
                </div>
                @error('image')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Update Article</button>
            </div>

        </form>
    </div>
@endsection
