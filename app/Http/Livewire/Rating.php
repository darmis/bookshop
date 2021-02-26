<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rate;

class Rating extends Component
{
    public $rate;
    public $review;
    public $book;
    public $book_id;
    public $rates;
    public $rated;
    public $avg;

    public function mount($book, $is_rated)
    {
        $this->rated = $is_rated;
        $this->book = $book;
        $this->book_id = $book->id;
        $this->rates = Rate::where('book_id', $this->book_id)->get();
        $this->avg = Rate::where('book_id', $this->book_id)->avg('rate');
    }

    public function render()
    {
        $this->rates = Rate::where('book_id', $this->book_id)->get();
        $this->avg = round(Rate::where('book_id', $this->book_id)->avg('rate'), 2);
        return view('livewire.rating', $this->rates);
    }

    public function saveRating()
    {
        $this->validate([
            'book_id' => 'required',
            'rate' => 'required|numeric|between:0,5',
            'review' => 'required|string',
            
        ]);

        Rate::create([
            'rate' => (int)$this->rate,
            'user_id' => auth()->id(),
            'book_id' => $this->book_id,
            'review' => $this->review,
        ]);
        $this->rated = true;
        $this->rates = Rate::where('book_id', $this->book_id)->get();
    }
}
