<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Routes publiques (Affichage des articles)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article/{slug}', [HomeController::class, 'showArticle'])->name('article.show');
Route::get('/categorie/{slug}', [HomeController::class, 'categoryArticles'])->name('category.articles');

/*
|--------------------------------------------------------------------------
| Routes d'administration (Gestion des catégories et articles)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    
    // Gestion des catégories
    Route::resource('categories', CategoryController::class);
    
    // Gestion des articles
    Route::resource('articles', ArticleController::class);
    
    // Route spéciale pour publier/dépublier un article
    Route::post('articles/{article}/toggle-publish', [ArticleController::class, 'togglePublish'])
         ->name('articles.toggle-publish');
});