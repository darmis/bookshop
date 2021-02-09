<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(25);

        return view('home')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
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
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
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
            'author' => $request->author,
            'genre' => $request->genre,
            'price' => $request->price,
            'cover' => $fileName,
        ]);
        $book->save();

        $books = Book::paginate(25);
        return view('home')->with('books', $books)->with('success', 'Book added to listing successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
