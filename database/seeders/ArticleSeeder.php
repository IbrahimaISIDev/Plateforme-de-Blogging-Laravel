<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'category_id' => 1,
                'title' => 'L\'intelligence artificielle en 2024',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...',
                'excerpt' => 'Découvrez les avancées majeures de l\'IA cette année',
                'is_published' => true,
                'published_at' => now()
            ],
            [
                'category_id' => 2,
                'title' => 'Top 10 destinations en Afrique',
                'content' => 'L\'Afrique regorge de destinations extraordinaires. Voici notre sélection...',
                'excerpt' => 'Les meilleures destinations africaines à visiter',
                'is_published' => true,
                'published_at' => now()->subDays(5)
            ],
            [
                'category_id' => 1,
                'title' => 'Guide complet Laravel 11',
                'content' => 'Laravel 11 apporte de nouvelles fonctionnalités passionnantes...',
                'excerpt' => 'Tout ce qu\'il faut savoir sur Laravel 11',
                'is_published' => false,
                'published_at' => null
            ]
        ];

        foreach ($articles as $article) {
            $slug = Str::slug($article['title']);
            Article::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $article['category_id'],
                    'title' => $article['title'],
                    'content' => $article['content'],
                    'excerpt' => $article['excerpt'],
                    'is_published' => $article['is_published'],
                    'published_at' => $article['published_at']
                ]
            );
        }
    }
}