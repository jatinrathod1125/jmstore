<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        // Define brands and their corresponding generated image filenames
        // We'll reuse the 5 generated images across 10 brands for now as requested
        // Ensure the images exist in storage/app/public/brands/ or copy them there.
        // The generated images are in the artifacts folder. We need to copy them.

        // Mapping of artifact image names to brand names
        $brands = [
            [
                'name' => 'Farm Fresh',
                'slug' => 'farm-fresh',
                'image_source' => 'brand_farmfresh_1767597160059.png', // Artifact name
            ],
            [
                'name' => 'Pure Dairy',
                'slug' => 'pure-dairy',
                'image_source' => 'brand_puredairy_1767597177193.png',
            ],
            [
                'name' => 'Grain Master',
                'slug' => 'grain-master',
                'image_source' => 'brand_grainmaster_1767597194533.png',
            ],
            [
                'name' => 'Sweet Treats',
                'slug' => 'sweet-treats',
                'image_source' => 'brand_sweettreats_1767597211054.png',
            ],
            [
                'name' => 'Ocean Catch',
                'slug' => 'ocean-catch',
                'image_source' => 'brand_oceancatch_1767597226880.png',
            ],
            // Reuse images for more brands to reach 10
            [
                'name' => 'Green Valley',
                'slug' => 'green-valley',
                'image_source' => 'brand_farmfresh_1767597160059.png',
            ],
            [
                'name' => 'Milky Way',
                'slug' => 'milky-way',
                'image_source' => 'brand_puredairy_1767597177193.png',
            ],
            [
                'name' => 'Golden Harvest',
                'slug' => 'golden-harvest',
                'image_source' => 'brand_grainmaster_1767597194533.png',
            ],
            [
                'name' => 'Candy Land',
                'slug' => 'candy-land',
                'image_source' => 'brand_sweettreats_1767597211054.png',
            ],
            [
                'name' => 'Sea Breeze',
                'slug' => 'sea-breeze',
                'image_source' => 'brand_oceancatch_1767597226880.png',
            ],
        ];

        // Ensure target directory exists
        if (!Storage::disk('public')->exists('brands')) {
            Storage::disk('public')->makeDirectory('brands');
        }

        $artifactPath = 'c:\\Users\\jmrat\\.gemini\\antigravity\\brain\\1bf8dbf7-bbf1-4546-9ac5-191f3ae5068f\\';

        foreach ($brands as $brandData) {
            $sourceFile = $artifactPath . $brandData['image_source'];
            $targetFilename = 'brands/' . $brandData['slug'] . '.png';

            // Check if source exists and copy
            if (File::exists($sourceFile)) {
                // We use copy to simulate upload
                Storage::disk('public')->put($targetFilename, File::get($sourceFile));
            } else {
                // Fallback or skip if for some reason image missing (shouldn't happen in this flow)
                $targetFilename = null;
            }

            Brand::updateOrCreate(
                ['slug' => $brandData['slug']],
                [
                    'name' => $brandData['name'],
                    'logo' => $targetFilename,
                    'status' => true,
                ]
            );
        }
    }
}
