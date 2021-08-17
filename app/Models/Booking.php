<?php

namespace App\Models;
use App\Models\Bookable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['from','to'];
    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

    public function review()
    {
        return $this->hasone(Review::class);
    }

    public function scopeBetweenDates($query, $from, $to){
    return $query->where('to', '>=', $from)
    ->where('from', '<=', $to);
    }

    protected static function findByReviewKey( string $reviewKey): ?Booking
    {
      return static::Where('review_kay', $reviewKey)->with('bookable')->get()->first(); // egger loading
    }
    protected static function boot()
    {
        parent::boot();
        static::creating( function($booking){
                $booking->review_kay = Str::uuid();

        });
    }
}
