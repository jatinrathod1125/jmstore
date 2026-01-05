<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Banner::where('status', true)->where('type', 'home_slider')->get();
        $promos = Banner::where('status', true)->where('type', 'promo_small')->take(3)->get();
        $categories = Category::where('status', true)->whereNull('parent_id')->with('children')->get();
        $featuredProducts = Product::where('status', true)->where('is_featured', true)->with('category')->take(10)->get();

        return view('frontend.home', compact('sliders', 'promos', 'categories', 'featuredProducts'));
    }
}
