<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'rate',
        'review'
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getRateInfoAttribute()
    {
        switch ($this->rate) {
            case 0:
                return "-";
                break;
            case 1:
                return "*";
                break;
            case 2:
                return "**";
                break;
            case 3:
                return "***";
                break;
            case 4:
                return "****";
                break;
            case 5:
                return "*****";
                break;
            
            default:
                return "-";
                break;
        }
    }
}
