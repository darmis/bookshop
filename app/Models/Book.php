<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->price * (1 - $this->discount/100);
    }

    public function getIsNewAttribute()
    {
        return $this->created_at >= \Carbon\Carbon::today()->subDays(7);
    }

    public function getCanEditAttribute()
    {
        if (!auth()->user()) {
            return false;
        }
        return auth()->user()->role === 'admin' || auth()->user()->id === $this->user_id;
    }
}
