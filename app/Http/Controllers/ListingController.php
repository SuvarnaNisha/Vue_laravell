<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(Listing::orderBy('created_at', 'desc')->paginate(10)->toArray());

        // dd(Listing::all());

        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        $query = Listing::mostRecent()->filter($filters);


        // $query = Listing::orderBy('created_at', 'desc')
        // $query = Listing::mostRecent()
        // ->when(
        //     $filters['priceFrom'] ?? false,
        //     fn($query, $value) => $query->where('price', '>=', $value)
        // )->when(
        //     $filters['priceTo'] ?? false,
        //     fn($query, $value) => $query->where('price', '>=', $value)
        // )->when(
        //     $filters['beds'] ?? false,
        //     fn($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $filters['beds'] )
        // )->when(
        //     $filters['baths'] ?? false,
        //     fn($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $filters['baths'] )
        // )->when(
        //     $filters['areaFrom'] ?? false,
        //     fn($query, $value) => $query->where('area', $filters['areaFrom'] )
        // )->when(
        //     $filters['areaTo'] ?? false,
        //     fn($query, $value) => $query->where('area', $filters['areaTo'] )
        // );

        // if($filters['priceFrom'] ?? false){
        //     $query->where('price', '>=', $filters['priceFrom'] );
        // }

        // if($filters['priceTo'] ?? false){
        //     $query->where('price', '<=', $filters['priceTo'] );
        // }

        // if($filters['beds'] ?? false){
        //     $query->where('beds', $filters['beds'] );
        // }

        // if($filters['baths'] ?? false){
        //     $query->where('baths', $filters['baths'] );
        // }

        // if($filters['areaFrom'] ?? false){
        //     $query->where('area', $filters['areaFrom'] );
        // }

        // if($filters['areaTo'] ?? false){
        //     $query->where('area', $filters['areaTo'] );
        // }

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => $query
                ->paginate(10)
                ->withQueryString()

                // 'listings' => Listing::all()
                // 'listings' => Listing::orderByDesc('created_at')->paginate(10)
                // 'listings' => Listing::orderBy('created_at', 'desc')->paginate(10)
                // 'listings' => Listing::orderBy('created_at', 'desc')->paginate(10)->toArray()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Listing::class);
        return inertia(
            'Listing/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Listing::create($request->all());

        // Listing::create([
        //     ... $request->all(),
        //     ... $request->validate([
        //         'beds' => 'required | integer | min:0 | max:20'

        //     ])
        // ]);

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
        
        // Listing::create(
        //     $request->validate([
        //         'beds' => 'required | integer | min:0 | max:20',
        //         'baths' => 'required | integer | min:0 | max:20',
        //         'area' => 'required | integer | min:15 | max:1500',
        //         'city' => 'required',
        //         'code' => 'required',
        //         'street' => 'required',
        //         'street_nr' => 'required | min:1 | max:1000',
        //         'price' => 'required | integer | min:1 | max:20000000',

        //     ])
        // );

        return redirect()->route('listing.index')->with('success', 'Listing was Created');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
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

    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit',
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

        return redirect()->route('listing.index')->with('success', 'Listing was Changed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()->with('success', 'Listing was deleted!');
    }
}
