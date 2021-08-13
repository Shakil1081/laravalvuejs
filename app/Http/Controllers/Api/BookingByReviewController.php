<?php

namespace App\Http\Controllers\Api;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookingByReviewShowResoruce;

class BookingByReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($reviewKey,Request $request)
    {
        return new BookingByReviewShowResoruce(Booking::findbyReviewKay($reviewKey)) ?? abort(404);
    }
}
