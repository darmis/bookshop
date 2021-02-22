<div>
    <div>
        User: {{ auth()->user()->name }}
        E-mail: {{ auth()->user()->email }}
    </div>
    Reported a book:<br>
    <a href="{{ route('book.show', $book->id) }}">{{ $book->title }}</a>
</div>