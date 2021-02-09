<x-app-layout>
    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="m-2">
                        <x-label for="title" :value="__('Title')" />

                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                    </div>

                    <!-- Description -->
                    <div class="m-2">
                        <x-label for="description" :value="__('Description')" />

                        <textarea  id="description" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="description" :value="old('description')" required rows="5"></textarea>
                    </div>

                    <!-- Authors -->
                    <div class="m-2">
                        <x-label for="author" :value="__('Author (separate with comma if more than one author)')" />

                        <x-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author')" required autofocus />
                    </div>

                    <!-- Genre -->
                    <div class="m-2">
                        <x-label for="genre" :value="__('Genre (separate with comma if more than one genre)')" />

                        <x-input id="genre" class="block mt-1 w-full" type="text" name="genre" :value="old('genre')" required autofocus />
                    </div>

                    <!-- Price -->
                    <div class="m-2">
                        <x-label for="price" :value="__('Price')" />

                        <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required autofocus />
                    </div>

                    <!-- Cover -->
                    <div class="m-2">
                        <x-label for="cover" :value="__('Cover photo')" />

                        <x-input id="cover" class="block mt-1 w-full" type="file" name="cover" :value="old('cover')" />
                    </div>

                    <div class="flex items-center justify-center mt-4 my-4">
                        <x-button class="ml-4 p-4">
                            {{ __('Add book to listing') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>