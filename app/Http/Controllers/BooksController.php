<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Book;
use App\Models\Rate;
use App\Models\Genre;
use App\Models\Author;
use App\Mail\BookReport;
use Auth;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('authors')->where('isApproved', true)->paginate();

        return view('home')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        return view('book.create')->with('genres', $genres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'authors' => 'required|string|max:255',
            'genres' => 'required|array',
            'price' => 'required',
        ]);

        if ($request->hasFile('cover')) {

            $request->validate([
                'cover' => 'file|image|max:5000'
            ]);

            $request->cover->store('covers', 'public');
            $fileName = $request->cover->hashName();

        } else {

            $fileName = 'default_cover.png';

        }

        $book = new Book([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'cover' => $fileName,
        ]);
        $book->save();

        $authors = explode(",", $request->authors);
        foreach($authors as $authorName){
            $author = Author::updateOrCreate(['author' => $authorName]);
            $book->authors()->attach($author->id);
        }
        $book->genres()->attach($request->genres);

        $books = Book::where('isApproved', true)->paginate();
        return view('home')->with('books', $books)->with('success', 'Book added to listing successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $rates = Rate::where('book_id', $book->id)->get();
        
        return view('book.show')->with(compact('book', 'rates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        if(auth()->user()->id == $book->user_id || auth()->user()->role == 'admin'){
            $genres = Genre::all();
            $book_genres = $book->genres->pluck('id')->toArray('id');
            $authors = '';
            foreach($book->authors as $book_author){
                $authors .= $book_author->author;
                $authors .= ', ';
            }
        } else {
            return back()->with('error', 'You cant edit this listing!');
        }
        

        return view('book.edit')->with(compact('book', 'genres', 'book_genres', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'authors' => 'required|string|max:255',
            'genres' => 'required|array',
            'price' => 'required',
            'discount' => 'required|max:99'
        ]);

        if ($request->hasFile('cover')) {

            $request->validate([
                'cover' => 'file|image|max:5000'
            ]);

            $request->cover->store('covers', 'public');
            $fileName = $request->cover->hashName();

        } else {
            $fileName = $book->cover;
        }

        $book->title = $request->title;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->discount = $request->discount;
        $book->cover = $fileName;
        $book->save();

        $book->genres()->sync($request->genres);
        $authors_array = explode(",", $request->authors);
        $book->authors()->detach();

        foreach ($authors_array as $author) {
            if (!is_null($author)) {
                $authors = Author::updateOrCreate(['author' => $author]);
                $book->authors()->attach($authors->id);
            }
        }

        $rates = Rate::where('book_id', $book->id)->get();

        return view('book.show')->with(compact('book', 'rates'))->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if(auth()->user()->id !== $book->user_id || auth()->user()->role !== 'admin'){
            return back()->with('error', 'You cant delete this listing!');
        }
        $book->delete();
        return back()->with('success', 'Book listing deleted successfully!');
    }

    /**
     * Display a listing of not approved books.
     *
     */
    public function toapprove()
    {
        $books = Book::with('authors')->where('isApproved', false)->paginate();

        return view('book.toapprove')->with('books', $books);
    }

    /**
     * Edit book to "approved" condition.
     *
     */
    public function approve(Book $book)
    {
        $book->isApproved = 1;
        $book->save();

        return redirect()->back()->with('success', 'Book was approved successfully!');
    }

    /**
     * Display search result.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string',
        ]);

        $keyword = $request->search;

        $books = Book::where('isApproved', true)
            ->where( function($query) use ($keyword) {

                $query->where('title','LIKE','%'.$keyword.'%');

                $query->orWhereHas('authors', function($query) use ($keyword) {
                    $query->where('author', 'LIKE','%'.$keyword.'%');
                });

                })->paginate();

        return view('home')->with('books', $books);
    }

    /**
     * Display a listing my books.
     *
     */
    public function mybooks()
    {
        $books = Book::with('authors')->where('user_id', auth()->user()->id)->paginate();

        return view('book.my')->with('books', $books);
    }

    /**
     * Send book report email to admin.
     *
     */
    public function report(Book $book)
    {
        $admin_email = User::where('role', 'admin')->first('email');
        Mail::to($admin_email)->send(new BookReport($book));

        $rates = Rate::where('book_id', $book->id)->get();
        
        return view('book.show')->with(compact('book', 'rates'));
    }
}
