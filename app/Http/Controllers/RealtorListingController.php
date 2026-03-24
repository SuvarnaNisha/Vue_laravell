<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Listing;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }
    
    public function index(Request $request){

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ... $request->only(['by', 'order'])
        ];

        return inertia('Realtor/Index', 
            [
                'listings' => Auth::user()
                            ->listings()
                            // ->mostRecent()
                            ->filter($filters)
                            // ->get() 
                            ->withCount('images')
                            ->paginate(5)
                            ->withQueryString()
            ]
        );
    }

    public function show(Listing $listing)
    { 
        // if(Auth::user()->cannot('view', $listing)){
        //     abort(403);
        // }
        
        $this->authorize('view', $listing);

        return inertia(
            'Listing/Show',
            [
                // 'Listings' => LIsting::find($id)
                'listing' => $listing
            ]
        );
    }

      /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia(
            'Realtor/Create'
        );
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required | integer | min:0 | max:20',
                'baths' => 'required | integer | min:0 | max:20',
                'area' => 'required | integer | min:15 | max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required | min:1 | max:1000',
                'price' => 'required | integer | min:1 | max:20000000',

            ])
        );

        return redirect()->route('realtor.listing.index')->with('success', 'Listing was Created');
    }


    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, Listing $listing)
    {

        $listing->update(
            $request->validate([
                'beds' => 'required | integer | min:0 | max:20',
                'baths' => 'required | integer | min:0 | max:20',
                'area' => 'required | integer | min:15 | max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required | min:1 | max:1000',
                'price' => 'required | integer | min:1 | max:20000000',

            ])
        );

        return redirect()->route('realtor.listing.index')->with('success', 'Listing was Changed');
    }    

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        // $listing->delete();
        // $listing->forceDelete();
        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing){
        $listing->restore();
        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
