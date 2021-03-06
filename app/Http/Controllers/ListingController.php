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
        $data = $this->getListing($listing);

        return response()->json($data);
    }

    public function get_listing_web(Listing $listing, Request $request)
    {
        $model = $this->getListing($listing);
        $model = $this->add_image_urls($model, $listing->id);
        $data = $this->add_meta_data($model, $request);

        return view('app', ['data' => $model]);
    }

    private function get_listing_summaries()
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
        return collect(['listings' => $collection->toArray()]);
    }
    public function get_home_web(Request $request)
    {
        $data = $this->get_listing_summaries();
        $data = $this->add_meta_data($data, $request);

        return view('app', ['data' => $data]);
    }

    public function get_home_api()
    {
        $data = $this->get_listing_summaries();

        return response()->json($data);
    }
}
