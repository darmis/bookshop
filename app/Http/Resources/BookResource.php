<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $genresStr = '';
        foreach($this->genres as $genre) {
            $genresStr .= $genre->genre;
            if($this->genres->last() != $genre){
                $genresStr .= ', ';
            }
        }

        $authorsStr = '';
        foreach($this->authors as $author) {
            $authorsStr .= $author->author;
            if($this->authors->last() != $author){
                $authorsStr .= ', ';
            }
        }

        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'authors' => $authorsStr,
            'genres' => $genresStr,
            'description' => $this->when($request->book, $this->description),
            'cover'=>asset('storage/covers/' . $this->cover),
            'price'=>$this->price
        ];
    }
}
