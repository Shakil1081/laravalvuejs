<?php

namespace App\Http\Controllers\Api;

use App\Models\Bookable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class BookableAvailabilityController extends Controller
{
       
    public function __invoke($id, Request $request)
    {
        $data = $request->validate([
            'from' =>'required|date_format:Y-m-d|after_or_equal:now',
            'to'=>  'required|date_format:Y-m-d|after_or_equal:from',
        ]);
    
        $bookabl = Bookable::findOrFail($id);
        return $bookabl->availableFor($data['from'], $data['to'])
        ? response()->json([])
        : response()->json([], 404);
    }
}
