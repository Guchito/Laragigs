<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('listings',[
        'listings' => Listing::all()
    ]);
});

Route::get('/listings/{listing}', function (Listing $listing) {
  return view('listing', [
        'listing' => $listing
    ]);
});

