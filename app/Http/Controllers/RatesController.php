<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Book;
use App\Models\Review;
use Auth;

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
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'review' => $request->review,
        ]);
        $rate->save();

        $book = Book::find($request->book_id);
        $rates = Rate::where('book_id', $request->book_id)->get();

        $rated = 'no';
        if(!Auth::guest()){
            foreach($rates as $rate){
                if($rate->user_id === auth()->id()){
                    $rated = 'yes';
                }
            }
        }

        return view('book.show', [$request->book_id])->with(compact('book', 'rates', 'rated'));
    }
}
