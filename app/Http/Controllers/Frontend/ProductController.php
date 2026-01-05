<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', true);

        // Category Filter
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                // Should include children products too
                // For now exact match or parent match
                $query->where(function ($q) use ($category) {
                    $q->where('category_id', $category->id)
                        ->orWhereIn('category_id', $category->children->pluck('id'));
                });
            }
        }

        // Search
        if ($request->has('q')) {
            $term = $request->q;
            $query->where('name', 'like', "%{$term}%");
        }

        $products = $query->with('category')->latest()->paginate(12);

        // Sidebar Data
        $categories = Category::where('status', true)->whereNull('parent_id')->with('children')->get();
        $brands = Brand::where('status', true)->get();

        return view('frontend.products.index', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('status', true)->with(['category', 'brand'])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }
}
