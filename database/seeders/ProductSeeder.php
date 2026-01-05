<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure brands and categories exist (BrandSeeder and CategorySeeder should be run before this)

        $products = [
            [
                'name' => 'Royal Gala Apple',
                'category_slug' => 'fresh-fruits',
                'brand_slug' => 'farm-fresh',
                'price' => 180,
                'discount_price' => 150,
                'image_source' => 'prod_royal_gala_apple_1767597651357.png',
                'description' => 'Fresh, crisp and sweet Royal Gala Apples. Perfect for snacking or salads.',
            ],
            [
                'name' => 'Fresh Broccoli',
                'category_slug' => 'fresh-vegetables',
                'brand_slug' => 'farm-fresh',
                'price' => 80,
                'discount_price' => 60,
                'image_source' => 'prod_fresh_broccoli_1767597672451.png',
                'description' => 'Nutrient-rich fresh green broccoli. Great for stir-fries and soups.',
            ],
            [
                'name' => 'Farm Fresh Milk (1L)',
                'category_slug' => 'milk',
                'brand_slug' => 'pure-dairy',
                'price' => 70,
                'discount_price' => null,
                'image_source' => 'prod_farm_milk_1767597691776.png',
                'description' => 'Pure and wholesome farm fresh milk. No preservatives.',
            ],
            [
                'name' => 'Whole Wheat Bread',
                'category_slug' => 'bread',
                'brand_slug' => 'sweet-treats', // Or pure-dairy/bakery brand
                'price' => 50,
                'discount_price' => 45,
                'image_source' => 'prod_whole_wheat_bread_1767597717579.png',
                'description' => 'Healthy whole wheat bread, perfect for sandwiches and toast.',
            ],
            [
                'name' => 'Premium Basmati Rice (5kg)',
                'category_slug' => 'rice-rice-products',
                'brand_slug' => 'grain-master',
                'price' => 850,
                'discount_price' => 750,
                'image_source' => 'prod_basmati_rice_1767597737395.png',
                'description' => 'Long grain aromatic Basmati Rice. Aged to perfection.',
            ],
            [
                'name' => 'Sunflower Cooking Oil (1L)',
                'category_slug' => 'edible-oils',
                'brand_slug' => 'grain-master',
                'price' => 160,
                'discount_price' => 145,
                'image_source' => 'prod_sunflower_oil_1767597755446.png',
                'description' => 'Refined sunflower oil, enriched with Vitamin A & D.',
            ],
            [
                'name' => 'Classic Salted Chips',
                'category_slug' => 'chips-namkeen',
                'brand_slug' => 'candy-land',
                'price' => 20,
                'discount_price' => null,
                'image_source' => 'prod_classic_chips_1767597775938.png',
                'description' => 'Crispy and salty classic potato chips.',
            ],
            // Fallback images for remaining
            [
                'name' => 'Dark Chocolate Bar',
                'category_slug' => 'chocolates-candies',
                'brand_slug' => 'sweet-treats',
                'price' => 100,
                'discount_price' => 90,
                'image_source' => 'cat_snacks_1767597417475.png', // Fallback
                'description' => 'Rich and intense dark chocolate with 70% cocoa.',
            ],
            [
                'name' => 'Fresh Orange Juice (1L)',
                'category_slug' => 'fruit-juices',
                'brand_slug' => 'pure-dairy', // Or beverages brand
                'price' => 120,
                'discount_price' => 110,
                'image_source' => 'cat_beverages_1767597438060.png', // Fallback
                'description' => '100% natural orange juice with no added sugar.',
            ],
            [
                'name' => 'Herbal Shampoo (200ml)',
                'category_slug' => 'hair-care',
                'brand_slug' => 'ocean-catch', // Placeholder brand
                'price' => 250,
                'discount_price' => 199,
                'image_source' => 'cat_personal_care_1767597455096.png', // Fallback
                'description' => 'Gentle herbal shampoo for healthy and shiny hair.',
            ],
        ];

        // Ensure products directory exists
        if (!Storage::disk('public')->exists('products')) {
            Storage::disk('public')->makeDirectory('products');
        }

        $artifactPath = 'c:\\Users\\jmrat\\.gemini\\antigravity\\brain\\1bf8dbf7-bbf1-4546-9ac5-191f3ae5068f\\';

        foreach ($products as $prodData) {
            $sourceFile = $artifactPath . $prodData['image_source'];
            $slug = Str::slug($prodData['name']);
            $targetFilename = 'products/' . $slug . '.png';

            // Check if source exists and copy
            if (File::exists($sourceFile)) {
                Storage::disk('public')->put($targetFilename, File::get($sourceFile));
            } else {
                $targetFilename = null;
            }

            // Find Category & Brand
            $category = Category::where('slug', $prodData['category_slug'])->first();
            // Fallback if specific subcategory not found, try to find by name or just pick first
            if (!$category) {
                $category = Category::first();
            }

            $brand = Brand::where('slug', $prodData['brand_slug'])->first();
            if (!$brand) {
                $brand = Brand::first();
            }

            Product::create([
                'brand_id' => $brand ? $brand->id : null,
                'category_id' => $category ? $category->id : null,
                'name' => $prodData['name'],
                'slug' => $slug,
                'sku' => strtoupper(Str::random(8)),
                'description' => $prodData['description'],
                'short_description' => Str::limit($prodData['description'], 100),
                'price' => $prodData['price'],
                'discount_price' => $prodData['discount_price'],
                'stock_quantity' => 100,
                'images' => $targetFilename ? [$targetFilename] : null,
                'is_featured' => true,
                'status' => true,
            ]);
        }
    }
}
