<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookable;
Use App\Http\Resources\BookableIndexResource;
Use App\Http\Resources\BookableShowResource;

class BookAbleController extends Controller
{
    public function index()
    {
        return BookableIndexResource::collection(Bookable::all());
 
    }
    public function show(Bookable $bookable, $id)
    {
        return new BookableShowResource(Bookable::findOrFail($id));
    }
}


