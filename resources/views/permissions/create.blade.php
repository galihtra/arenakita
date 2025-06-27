<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('permission.store') }}" method="POST">
                        <label for="" class="text-sm font-medium">Name</label>
                        <div class="my-3 ">
                            <input placeholder="Input Name" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                    
                        </div>
                        <button class="bg-blue-700 hover:bg-blue-800 text-sm rounded-lg  text-white 
                        dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 px-5 py-3">
                        Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
