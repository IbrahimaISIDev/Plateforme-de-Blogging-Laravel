<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Page d'accueil : liste des articles publiés
     */
    public function index()
    {
        $articles = Article::published()
                          ->with('category')
                          ->paginate(6);
        
        $categories = Category::has('publishedArticles')
                             ->withCount('publishedArticles')
                             ->orderBy('name')
                             ->get();

        return view('home', compact('articles', 'categories'));
    }

    /**
     * Afficher un article spécifique
     */
    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)
                         ->where('is_published', true)
                         ->with('category')
                         ->firstOrFail();

        // Articles similaires de la même catégorie
        $relatedArticles = Article::published()
                                 ->where('category_id', $article->category_id)
                                 ->where('id', '!=', $article->id)
                                 ->limit(3)
                                 ->get();

        return view('article', compact('article', 'relatedArticles'));
    }

    /**
     * Afficher les articles d'une catégorie
     */
    public function categoryArticles($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $articles = Article::published()
                          ->where('category_id', $category->id)
                          ->with('category')
                          ->paginate(6);

        return view('category-articles', compact('category', 'articles'));
    }
}