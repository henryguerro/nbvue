<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

class ListingController extends Controller
{
    private function add_image_urls($model, $id)
    {
        for($i = 1; $i <=4; $i++) {
            $model['image_' . $i] = asset('images/' . $id . '/Image_' . $i . '.jpg');
        }
        return $model;
    }

    public function getListing($listing)
    {
        $model = $listing->toArray();
        $model = $this->add_image_urls($model, $listing->id);

        return collect(['listing' => $model]);
    }

    public function get_listing_api(Listing $listing)
    {
        $data = $this->getListing();

        return response()->json($data);
    }

    public function get_listing_web(Listing $listing)
    {
        $model = $this->getListing($listing);
        $model = $this->add_image_urls($model, $listing->id);

        return view('app', ['data' => $model]);
    }

    public function get_home_web()
    {
        $collection = Listing::all([
            'id', 'address', 'title', 'price_per_night'
        ]);
        $collection->transform(function($listing) {
            $listing->thumb = asset(
                "images/{$listing->id}/Image_1_thumb.jpg"
            );
            return $listing;
        });
        $data = collect(['listings' => $collection->toArray()]);

        return view('app', ['data' => $data]);
    }
}
