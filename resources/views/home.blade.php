<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(count($books))
                <div class="grid grid-cols-5 gap-4">
                    @foreach($books as $book)
                    <div class="">
                            <div class="p-5 mx-auto shadow-sm bg-white rounded-lg block  flex flex-wrap content-center w-full h-4/6 relative">
                                <a href="{{ route('book.show', $book->id) }}">
                                    <img class="w-5/6 h-7/8 mx-auto py-8" src="{{ asset('storage/covers/'. $book->cover) }}" alt="Book cover">
                                    @if($book->discount > 0)
                                        <button type="button" class="mr-2 bg-red-600 text-white p-2 rounded  leading-none flex items-center absolute top-1 right-1">
                                            -{{ $book->discount }}%
                                        </button>
                                    @endif
                                    @if($book->isNew)
                                        <button type="button" class="mr-2 bg-green-600 text-white p-2 rounded  leading-none flex items-center absolute top-10 right-1">
                                            New
                                        </button>
                                    @endif
                                </a>
                            </div>
                            <div class="px-4 uppercase font-bold">
                                {{ $book->title }}
                            </div>
                            <div class="px-4 uppercase text-sm text-gray-400 font-bold">
                                {{ $book->author }}
                            </div>
                            @if($book->discount > 0)
                                <div class="text-center">
                                    <span>€ {{ $book->finalPrice }}</span> <span class="text-red-300 line-through">€ {{ $book->price }}</span>
                                </div>
                            @else
                                <div class="text-center">
                                    € {{ $book->price }}
                                </div>
                            @endif
                            @if($book->canEdit)
                            <div class="text-center text-yellow-400">
                                <a href="{{ url('/book') }}/{{ $book->id }}/edit">Edit</a>
                            </div>
                            <div class="text-center text-red-400">
                                <form method="POST" action="{{ route('book.destroy', $book->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                            @endif
                    </div>
                    @endforeach
                </div>
                @endif
                {!! $books->links() !!}
            </div>
        </div>
    </div>
</x-app-layout>
