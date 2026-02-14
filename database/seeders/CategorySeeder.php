<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technologie',
                'description' => 'Articles sur les dernières technologies et innovations'
            ],
            [
                'name' => 'Voyage',
                'description' => 'Récits et conseils de voyage'
            ],
            [
                'name' => 'Cuisine',
                'description' => 'Recettes et astuces culinaires'
            ],
            [
                'name' => 'Sport',
                'description' => 'Actualités et analyses sportives'
            ],
            [
                'name' => 'Culture',
                'description' => 'Art, musique, cinéma et littérature'
            ]
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                [
                    'slug' => Str::slug($category['name']),
                    'description' => $category['description']
                ]
            );
        }
    }
}