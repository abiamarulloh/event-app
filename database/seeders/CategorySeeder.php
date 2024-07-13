<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function generateRandomColor() {
            // Generate random values for RGB components
            $r = mt_rand(0, 255); // Random value for red (0-255)
            $g = mt_rand(0, 255); // Random value for green (0-255)
            $b = mt_rand(0, 255); // Random value for blue (0-255)

            // Convert RGB to HEX
            $hex = sprintf("#%02x%02x%02x", $r, $g, $b);

            return $hex;
        }
        
        $categories = [
            [
                'name' => 'Conferences and Summits',
                'description' => 'For business and professional gatherings.',
                'color' =>generateRandomColor()
            ],
            [
                'name' => 'Workshops and Training',
                'description' => 'Offering specialized learning sessions.',
                'color' =>generateRandomColor()
            ],
            [
                'name' => 'Exhibitions and Trade Shows',
                'description' => 'Facilitating interactions between exhibitors and attendees.',
                'color' =>generateRandomColor()
            ],
            [
                'name' => 'Social Events',
                'description' => 'Covering parties, weddings, and other personal celebrations.',
                'color' =>generateRandomColor()
            ],
            [
                'name' => 'Community and Non-profit Events',
                'description' => 'Including fundraisers, charity events, and local community gatherings.',
                'color' =>generateRandomColor()
            ],
            [
                'name' => 'Sports Events',
                'description' => 'Managing tournaments, matches, and fitness events.',
                'color' =>generateRandomColor()
            ],
            [
                'name' => 'Performances and Entertainment',
                'description' => 'Listing concerts, theater shows, and cultural performances.',
                'color' =>generateRandomColor()
            ],
            [
                'name' => 'Educational Events',
                'description' => 'For seminars, lectures, and academic conferences.',
                'color' =>generateRandomColor()
            ],
            [
                'name' => 'Networking Events',
                'description' => 'Focused on building professional connections.',
                'color' =>generateRandomColor()
            ],
            [
                'name' => 'Virtual Events',
                'description' => 'Providing a platform for online gatherings and webinars.',
                'color' =>generateRandomColor()
            ]
        ];
        

        // Create Categories
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
