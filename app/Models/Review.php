<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
protected $fillable = ['id','content', 'rating'];
    public function bookable()
    {
        return $this->belongTo(Bookable::class);
    }

    public function booking()
    {
        return $this->belongsTO(Booking::class);
    }

    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
}
