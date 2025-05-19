<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{ 
    // Show all listings
    public function index(){
        return view('listings.index',[
        'listings' => Listing::latest()
            ->filter(request(['tag', 'search']))
            ->paginate(6)
    ]);
    // Show single listing
    }
    public function show(Listing $listing){
        return view('listings.show', [
        'listing' => $listing
    ]);
    }
    // Show create form
    public function create(){
        return view('listings.create');
    }
    // Store listing data
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email', Rule::unique('listings', 'email')],
            'tags' => 'required',
            'description' => 'required'
        ]);
        // Handle file upload
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = Auth::id();

        // Store listing
        Listing::create($formFields);
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show edit form
    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update listing
    public function update(Request $request, Listing $listing){

        // Make sure logged in user is owner
        if($listing->user_id != Auth::id()){
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        // Handle file upload
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        

        // Store listing
        $listing->update($formFields);

       return view('listings.show', [
            'listing' => $listing
        ])->with('message', 'Listing updated successfully!');
    }

    // Delete listing

    
    public function destroy(Listing $listing){
        // Make sure logged in user is owner
        if($listing->user_id != Auth::id()){
            abort(403, 'Unauthorized action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    // Manage listings
    public function manage(){
        return view('listings.manage', [
            'listings' => Auth::user()->listings()->get()
        ]);
    }

}
