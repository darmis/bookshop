<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-3 gap-4">
                    <div class="...">
                        <img class="w-full h-full p-14" src="{{ asset('storage/covers/'. $book->cover) }}" alt="Book cover">
                    </div>
                    <div class="col-span-2 ... py-10">
                        <div class="p-14">
                            <div class="divide-y">
                                <p class="text-4xl font-bold text-gray-900 py-4">{{ $book->title }}</p>
                                <p class="text-2xl font-medium text-gray-400 py2">{{ $book->author }}</p>
                            </div>
                            <p class="text-md font-light text-gray-600">{{ $book->genre }}</p>
                            <p class="py-10">{{ $book->description }}</p>
                        </div>
                    </div>
                    <div class="col-span-3 ...">3</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>