@extends('layouts.app')

@section('title', 'Catégorie : ' . $category->name)

@section('content')
<div class="space-y-8">
    <!-- En-tête de la catégorie -->
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-xl text-gray-600">{{ $category->description }}</p>
        @endif
    </div>

    <!-- Articles de la catégorie -->
    @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold text-indigo-600 uppercase">
                                {{ $article->category->name }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $article->published_at->format('d/m/Y') }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            <a href="{{ route('article.show', $article->slug) }}" class="hover:text-indigo-600">
                                {{ $article->title }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4">
                            {{ $article->excerpt }}
                        </p>
                        
                        <a href="{{ route('article.show', $article->slug) }}" 
                           class="text-indigo-600 hover:text-indigo-800 font-semibold">
                            Lire la suite →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <p class="text-gray-600 text-lg">Aucun article publié dans cette catégorie.</p>
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