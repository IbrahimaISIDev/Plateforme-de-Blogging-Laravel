<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Afficher la liste de tous les articles (publiés et brouillons)
     */
    public function index()
    {
        $articles = Article::with('category')
                          ->latest()
                          ->paginate(10);
        
        return view('articles.index', compact('articles'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('articles.create', compact('categories'));
    }

    /**
     * Enregistrer un nouvel article
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'is_published' => 'boolean'
        ], [
            'category_id.required' => 'Veuillez sélectionner une catégorie.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'content.required' => 'Le contenu est obligatoire.',
            'excerpt.max' => 'L\'extrait ne peut pas dépasser 500 caractères.'
        ]);

        // Gérer le statut de publication
        $validated['is_published'] = $request->has('is_published') ? true : false;

        Article::create($validated);

        $message = $validated['is_published'] 
                 ? 'Article publié avec succès !' 
                 : 'Article enregistré comme brouillon !';

        return redirect()->route('articles.index')
                        ->with('success', $message);
    }

    /**
     * Afficher les détails d'un article
     */
    public function show(Article $article)
    {
        $article->load('category');
        return view('articles.show', compact('article'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Article $article)
    {
        $categories = Category::orderBy('name')->get();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Mettre à jour un article
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'is_published' => 'boolean'
        ], [
            'category_id.required' => 'Veuillez sélectionner une catégorie.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'content.required' => 'Le contenu est obligatoire.',
            'excerpt.max' => 'L\'extrait ne peut pas dépasser 500 caractères.'
        ]);

        $validated['is_published'] = $request->has('is_published') ? true : false;

        $article->update($validated);

        $message = $validated['is_published'] 
                 ? 'Article mis à jour et publié !' 
                 : 'Article mis à jour comme brouillon !';

        return redirect()->route('articles.index')
                        ->with('success', $message);
    }

    /**
     * Supprimer un article
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
                        ->with('success', 'Article supprimé avec succès !');
    }

    /**
     * Basculer le statut de publication d'un article
     */
    public function togglePublish(Article $article)
    {
        $article->is_published = !$article->is_published;
        
        if ($article->is_published && !$article->published_at) {
            $article->published_at = now();
        }
        
        $article->save();

        $message = $article->is_published 
                 ? 'Article publié avec succès !' 
                 : 'Article retiré de la publication !';

        return back()->with('success', $message);
    }
}