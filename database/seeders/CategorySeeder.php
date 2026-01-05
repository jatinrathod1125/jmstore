<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Artifact images mapping
        $categories = [
            [
                'name' => 'Fruits & Vegetables',
                'image_source' => 'cat_fruits_veg_1767597361299.png',
                'subcategories' => ['Fresh Fruits', 'Fresh Vegetables', 'Herbs & Seasonings', 'Organic Fruits']
            ],
            [
                'name' => 'Dairy & Bakery',
                'image_source' => 'cat_dairy_bakery_1767597380560.png',
                'subcategories' => ['Milk', 'Cheese', 'Bread', 'Butter']
            ],
            [
                'name' => 'Staples',
                'image_source' => 'cat_staples_1767597397827.png',
                'subcategories' => ['Atta & Flours', 'Rice & Rice Products', 'Dals & Pulses', 'Edible Oils']
            ],
            [
                'name' => 'Snacks & Branded Foods',
                'image_source' => 'cat_snacks_1767597417475.png',
                'subcategories' => ['Biscuits & Cookies', 'Chips & Namkeen', 'Chocolates & Candies']
            ],
            [
                'name' => 'Beverages',
                'image_source' => 'cat_beverages_1767597438060.png',
                'subcategories' => ['Tea', 'Coffee', 'Fruit Juices', 'Soft Drinks']
            ],
            [
                'name' => 'Personal Care',
                'image_source' => 'cat_personal_care_1767597455096.png',
                'subcategories' => ['Hair Care', 'Skin Care', 'Oral Care', 'Bath & Body']
            ],
            // Additional categories reusing images or generic pattern
            [
                'name' => 'Home Care',
                'image_source' => 'cat_personal_care_1767597455096.png', // Reusing similar aesthetic
                'subcategories' => ['Detergents', 'Cleaners', 'Fresheners']
            ],
            [
                'name' => 'Breakfast & Instant Food',
                'image_source' => 'cat_snacks_1767597417475.png', // Reusing snacks similar feel
                'subcategories' => ['Cereal', 'Noodles', 'Pasta']
            ],
            [
                'name' => 'Baby Care',
                'image_source' => 'cat_dairy_bakery_1767597380560.png', // Soft aesthetic
                'subcategories' => ['Diapers', 'Baby Food', 'Baby Skin Care']
            ],
            [
                'name' => 'Pet Care',
                'image_source' => 'cat_staples_1767597397827.png', // Sacks aesthetic
                'subcategories' => ['Dog Food', 'Cat Food', 'Pet Grooming']
            ],
        ];

        // Ensure category directory exists
        if (!Storage::disk('public')->exists('categories')) {
            Storage::disk('public')->makeDirectory('categories');
        }

        $artifactPath = 'c:\\Users\\jmrat\\.gemini\\antigravity\\brain\\1bf8dbf7-bbf1-4546-9ac5-191f3ae5068f\\';

        foreach ($categories as $catData) {
            $sourceFile = $artifactPath . $catData['image_source'];
            $slug = Str::slug($catData['name']);
            $targetFilename = 'categories/' . $slug . '.png';

            // Check if source exists and copy
            if (File::exists($sourceFile)) {
                Storage::disk('public')->put($targetFilename, File::get($sourceFile));
            } else {
                $targetFilename = null;
            }

            // Create Parent Category
            $parent = Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $catData['name'],
                    'image' => $targetFilename,
                    'status' => true,
                ]
            );

            // Create Subcategories (without images for now to keep it simple, or reuse parent image if needed)
            foreach ($catData['subcategories'] as $subName) {
                Category::updateOrCreate(
                    ['slug' => Str::slug($subName)],
                    [
                        'name' => $subName,
                        'parent_id' => $parent->id,
                        'status' => true,
                    ]
                );
            }
        }
    }
}
