<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Technology', 'Travel', 'Food', 'Lifestyle', 'Business'];
        $countries = ['USA', 'UK', 'Canada', 'Australia', 'Germany', 'France', 'Japan'];
        $authors = ['John Doe', 'Jane Smith', 'Mike Johnson', 'Sarah Wilson', 'David Brown'];

        for ($i = 0; $i < 10; $i++) {
            Blog::create([
                'name' => 'Sample Blog Post ' . ($i + 1),
                'text' => 'This is a sample blog post content. ' . Str::random(200),
                'publishdate' => now()->subDays(rand(1, 30)),
                'category' => $categories[array_rand($categories)],
                'tag' => implode(',', array_rand(array_flip(['web', 'design', 'programming', 'lifestyle', 'food']), 2)),
                'country' => $countries[array_rand($countries)],
                'author' => $authors[array_rand($authors)],
                'comments' => rand(0, 15) . ' comments',
                'image' => null
            ]);
        }
    }
}