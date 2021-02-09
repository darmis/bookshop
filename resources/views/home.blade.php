<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(count($books))
                <div class="grid grid-cols-5 gap-4">
                    @foreach($books as $book)
                    <div class="">
                        <div class="p-5 mx-auto shadow-sm bg-white rounded-lg block  flex flex-wrap content-center w-full h-5/6">
                            <img class="w-full h-full" src="{{ asset('storage/covers/'. $book->cover) }}" alt="Book cover">
                        </div>
                        <div>
                            {{ $book->title }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
