<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $sliderBanners = Banner::where('type', 'Slider')->where('status', 1)->get()->toArray();
        $fixBanners    = Banner::where('type', 'Fix')->where('status', 1)->get()->toArray();

        // // Get 'condition' from query string (default to 'new' if not set or invalid)
        // $condition = $request->query('condition');
        // if (!in_array($condition, ['new', 'old'])) {
        //     $condition = 'new';
        // }
        $condition = session('condition', 'new');

        $newProducts = Product::orderBy('id', 'Desc')
            ->where('condition', $condition)
            ->where('status', 1)
            ->limit(8)
            ->get()
            ->toArray();

        $bestSellers = Product::where([
            'is_bestseller' => 'Yes',
            'status' => 1
        ])
            ->where('condition', $condition)
            ->inRandomOrder()
            ->get()
            ->toArray();

        $discountedProducts = Product::where('product_discount', '>', 0)
            ->where('condition', $condition)
            ->where('status', 1)
            ->limit(6)
            ->inRandomOrder()
            ->get()
            ->toArray();

        $featuredProducts = Product::where([
            'is_featured' => 'Yes',
            'status' => 1
        ])
            ->where('condition', $condition)
            ->limit(6)
            ->get()
            ->toArray();

        $meta_title = 'Multi Vendor E-commerce Website';
        $meta_description = 'Online Shopping Website which deals in Clothing, Electronics & Appliances Products';
        $meta_keywords = 'eshop website, online shopping, multi vendor e-commerce';

        return view('front.index')->with(compact(
            'sliderBanners',
            'fixBanners',
            'newProducts',
            'bestSellers',
            'discountedProducts',
            'featuredProducts',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'condition'
        ));
    }

    public function setCondition(Request $request)
    {
        session(['condition' => $request->condition]);
        return response()->json(['success' => true]);
    }
}
