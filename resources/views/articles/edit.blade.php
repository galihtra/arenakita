<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Articles / Edit
            </h2>
            <a href="{{ route('article.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('article.update', $article->id) }}" method="post">
                        @csrf
                        <div>
                            <label for="" class="text-sm font-medium">Title</label>
                            <div class="my-3 ">
                                <input name="title" value="{{ old('title',  $article->title) }}" placeholder="Input Title"
                                    type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('title')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <label for="" class="text-sm font-medium">Content</label>
                            <div class="my-3 ">
                                <textarea placeholder="Content" name="text" id="text" cols="30" rows="10"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                {{ old('text', $article->text) }}
                                </textarea>
                            </div>

                            <label for="" class="text-sm font-medium">Author</label>
                            <div class="my-3 ">
                                <input name="author" value="{{ old('author', $article->author) }}" placeholder="Input Author"
                                    type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('author')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                class="bg-blue-700 hover:bg-blue-800 text-sm rounded-lg  text-white 
                        dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 px-5 py-3">
                                Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
