<x-app-layout>
    @livewire('rating', ['book' => $book, 'is_rated' => $book->isRated])
</x-app-layout>