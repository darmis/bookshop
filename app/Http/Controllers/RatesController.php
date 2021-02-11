<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Book;
use App\Models\Review;

class RatesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'rate' => 'required|numeric|between:0,5',
            'review' => 'required|string',
            
        ]);

        $rate = new Rate([
            'rate' => (int)$request->rate,
            'user_id' => auth()->user()->id,
            'book_id' => $request->book_id,
            'review' => $request->review,
        ]);
        $rate->save();

        $book = Book::where('id', $request->book_id)->first();
        $rates = Rate::where('book_id', $request->book_id)->get();
        return view('book.show', [$request->book_id])->with(compact('book', 'rates'));
    }
}
