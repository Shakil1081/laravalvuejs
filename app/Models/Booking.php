<?php

namespace App\Models;

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
    public static function findbyReviewKay( string $reviewKey): ?Booking {

    return static:: where('review_key', $reviewKey)->with('bookable')->get()->first();

    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function($booking){
            $booking->review_key= Str::uuid();
        });
    }
}
