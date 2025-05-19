<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//All listing
Route::get('/', [ListingController::class, 'index']);


//Show create form
Route::get('/listings/create', [ListingController::class, 'create']);

//Store listing data
Route::post('/listings', [ListingController::class, 'store']);

//Single listing. 
Route::get('/listings/{listing}', [ListingController::class, 'show']);
// It has to be at the end of the route list
// because it is a wildcard route and will catch all requests
// that are not matched by the previous routes