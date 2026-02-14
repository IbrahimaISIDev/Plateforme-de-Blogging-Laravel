@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Article principal -->
    <article class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <!-- En-tête -->
        <div class="mb-6">
            <a href="{{ route('category.articles', $article->category->slug) }}" 
               class="inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-800 uppercase mb-3">
                {{ $article->category->name }}
            </a>
            
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                {{ $article->title }}
            </h1>
            
            <div class="flex items-center text-gray-600 text-sm">
                <span>📅 Publié le {{ $article->published_at->format('d/m/Y à H:i') }}</span>
            </div>
        </div>

        <!-- Contenu -->
        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
            {!! nl2br(e($article->content)) !!}
        </div>
    </article>

    <!-- Articles similaires -->
    @if($relatedArticles->count() > 0)
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6">Articles similaires</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedArticles as $related)
                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                    <h3 class="font-bold text-lg mb-2">
                        <a href="{{ route('article.show', $related->slug) }}" class="hover:text-indigo-600">
                            {{ $related->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-3">{{ $related->excerpt }}</p>
                    <a href="{{ route('article.show', $related->slug) }}" 
                       class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                        Lire →
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Retour -->
    <div class="mt-8">
        <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
            ← Retour à l'accueil
        </a>
    </div>
</div>
@endsection