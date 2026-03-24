<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingImage;

class RealtorListingImageController extends Controller
{
    //
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing'=>$listing]
        );
    }

    public function store(Listing $listing, Request $request)
    {
        if($request->hasfile('images'))
        {
            $request->validate([
                'images.*' => 'mimes:jpg,png,jpeg,webp|max:5000'
            ], [
                'images.*.mimes' => 'The file should be in one of the formats: jpg, png, jpeg, webp'
            ]);

            foreach($request->file('images') as $file){
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path
                ])); 
            }
        }

        return redirect()->back()->with('success', 'Image Uploaded');
    }

    public function destroy(Listing $listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image was deleted');
    }

}
 