<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'author',
        'genre',
        'price',
        'cover',
        'discount',
        'isAproved'
    ];

    protected $perPage = 25;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class);
    }

    public function authors() {
        return $this->belongsToMany(Author::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->price * (1 - $this->discount/100);
    }

    public function getIsNewAttribute()
    {
        return $this->created_at >= today()->subDays(7);
    }

    public function getCanEditAttribute()
    {
        if (!auth()->user()) {
            return false;
        }
        return auth()->user()->role === 'admin' || auth()->user()->id === $this->user_id;
    }

    public function getIsRatedAttribute()
    {
        $rated = false;
        if(!Auth::guest()){
            foreach($this->rates as $rate){
                if($rate->user_id === auth()->user()->id){
                    $rated = true;
                }
            }
        }
        return $rated;
    }
}
