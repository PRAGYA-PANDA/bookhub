<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

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
        $language = Language::get();
        $condition   = session('condition', 'new');
        $sections    = Section::all();
        $newProducts = Product::with(['authors', 'publisher'])
            ->where('condition', $condition)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        $category = Category::limit(10)->get();

        $footerProducts = Product::orderBy('id', 'Desc')
            ->where('condition', $condition)
            ->where('status', 1)
            ->take(3)
            ->get()
            ->toArray();

        $bestSellers = Product::where([
            'is_bestseller' => 'Yes',
            'status'        => 1,
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
            'status'      => 1,
        ])
            ->where('condition', $condition)
            ->limit(6)
            ->get()
            ->toArray();

        $meta_title       = 'Multi Vendor E-commerce Website';
        $meta_description = 'Online Shopping Website which deals in Clothing, Electronics & Appliances Products';
        $meta_keywords    = 'eshop website, online shopping, multi vendor e-commerce';

        // return view('front.index')->with(compact(
        //     'sliderBanners',
        //     'fixBanners',
        //     'newProducts',
        //     'bestSellers',
        //     'discountedProducts',
        //     'featuredProducts',
        //     'meta_title',
        //     'meta_description',
        //     'meta_keywords',
        //     'condition'
        // ));

        return view('front.index2')->with(compact(
            'sliderBanners',
            'fixBanners',
            'newProducts',
            'footerProducts',
            'bestSellers',
            'discountedProducts',
            'featuredProducts',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'condition',
            'category',
            'sections',
            'language'
        ));
    }

    public function setCondition(Request $request)
    {
        session(['condition' => $request->condition]);
        return response()->json(['success' => true]);
    }

    public function searchProducts(Request $request)
    {
        $condition      = session('condition', 'new');
        $query          = Product::where('status', 1);
        $sections       = Section::all();
        $footerProducts = Product::orderBy('id', 'Desc')
            ->where('condition', $condition)
            ->where('status', 1)
            ->take(3)
            ->get()
            ->toArray();
        $category = Category::limit(10)->get();

        // Apply search term
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('product_isbn', 'like', '%' . $search . '%');
            });
        }

        // Filter by section/category
        if ($request->filled('section_id')) {
            $query->where('section_id', $request->section_id);
        }

        // Filter by condition
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('product_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('product_price', '<=', $request->max_price);
        }

        // Get the results
        $products = $query->paginate(12);

        return view('front.products.search', compact('products', 'request', 'condition', 'sections', 'footerProducts', 'category'));
    }
}
