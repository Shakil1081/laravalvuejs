<?php

namespace App\Http\Controllers\Api;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookingByReviewShowResoruce;

class BookingByReviewController extends Controller
{
    /*git *
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($reviewKey,Request $request)
    {
        $booking = Booking::findbyReviewKay($reviewKey);
        return $booking ? new BookingByReviewShowResoruce($booking) : abort(404);
    }
}
