@extends('layouts.app')

@section('title', 'Accueil - BlogPro')

@section('content')
<div class="space-y-20 pb-20">
    <!-- Hero Section -->
    <section class="relative py-12 md:py-20 overflow-hidden">
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/3 w-[500px] h-[500px] bg-indigo-200/40 rounded-full blur-[120px] opacity-60"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/3 w-[500px] h-[500px] bg-sky-200/40 rounded-full blur-[120px] opacity-60"></div>
        
        <div class="relative text-center max-w-4xl mx-auto space-y-10 animate-fade-in">
            <div class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm border border-indigo-50 shadow-sm text-indigo-700 px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                </span>
                <span>Nouvelles perspectives chaque jour</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-slate-900 tracking-tighter leading-[0.9] md:leading-[1]">
                Partagez votre <br> <span class="text-gradient">Vision</span> unique.
            </h1>
            
            <p class="text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto font-medium">
                Découvrez des articles passionnants écrits par une communauté de développeurs, designers et innovateurs. Votre prochaine source d'inspiration est ici.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 pt-4">
                <a href="#articles" class="w-full sm:w-auto px-10 py-5 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:shadow-2xl hover:-translate-y-1 transition-all">
                    Explorer les articles
                </a>
                <a href="{{ route('articles.create') }}" class="w-full sm:w-auto px-10 py-5 bg-white text-slate-700 font-bold rounded-2xl shadow-sm border border-slate-100 hover:bg-slate-50 transition-all">
                    Commencer à écrire
                </a>
            </div>
        </div>
    </section>

    <!-- Catégories Horizontales -->
    @if($categories->count() > 0)
    <section class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Sujets populaires</h2>
                <div class="h-1.5 w-12 bg-indigo-600 rounded-full mt-2"></div>
            </div>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('category.articles', $category->slug) }}" 
                   class="group flex flex-col items-center p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all hover:-translate-y-2 text-center">
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 text-xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500 mb-4">
                        {{ substr($category->name, 0, 1) }}
                    </div>
                    <div>
                        <span class="block text-sm font-bold text-slate-800">{{ $category->name }}</span>
                        <span class="block text-[10px] text-indigo-500 font-bold uppercase tracking-wider mt-1">{{ $category->published_articles_count }} articles</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Articles Section -->
    <section id="articles" class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 space-y-4 md:space-y-0">
            <div class="space-y-2">
                <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.2em]">Dernières pépites</span>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight">Flux d'inspiration</h2>
            </div>
            <a href="{{ route('articles.index') }}" class="inline-flex items-center text-sm font-bold border-b-2 border-indigo-600 pb-1 text-slate-900 hover:text-indigo-600 transition-colors group">
                <span>Gestionnaire d'articles</span>
                <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
        
        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($articles as $article)
                    <article class="group relative bg-white rounded-[3rem] p-4 border border-slate-50 shadow-sm hover:shadow-[0_32px_64px_-16px_rgba(31,38,135,0.08)] hover:border-indigo-100 transition-all duration-500 flex flex-col h-full">
                        <div class="relative h-64 w-full rounded-[2.2rem] overflow-hidden mb-8">
                            <!-- Gradient background based on index -->
                            <div class="absolute inset-0 bg-gradient-to-br {{ $loop->index % 2 == 0 ? 'from-indigo-600 to-purple-500' : 'from-sky-500 to-emerald-400' }} group-hover:scale-110 transition-transform duration-700"></div>
                            <div class="absolute inset-0 bg-black/5"></div>
                            <div class="absolute top-6 left-6">
                                <span class="bg-white/20 backdrop-blur-md border border-white/30 text-white text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-2xl">
                                    {{ $article->category->name }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="px-4 flex-grow flex flex-col pb-4">
                            <div class="flex items-center text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-4">
                                <span class="text-indigo-500">Publication</span>
                                <span class="mx-2 opacity-50">•</span>
                                <span>{{ $article->published_at->translatedFormat('d M Y') }}</span>
                            </div>
                            
                            <h3 class="text-2xl font-black text-slate-900 mb-4 leading-[1.1] group-hover:text-indigo-600 transition-colors">
                                <a href="{{ route('article.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            
                            <p class="text-slate-500 text-sm mb-8 line-clamp-3 leading-relaxed font-medium">
                                {{ $article->excerpt }}
                            </p>
                            
                            <div class="mt-auto flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    </div>
                                    <span class="text-xs font-bold text-slate-700">Auteur</span>
                                </div>
                                <a href="{{ route('article.show', $article->slug) }}" class="w-12 h-12 bg-slate-50 group-hover:bg-indigo-600 transition-colors rounded-2xl flex items-center justify-center group-hover:text-white group-hover:rotate-12 duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination Custom Styling -->
            <div class="mt-20">
                {{ $articles->links() }}
            </div>
        @else
            <div class="bg-indigo-50/50 rounded-[3rem] border-2 border-dashed border-indigo-100 p-20 text-center animate-fade-in">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-sm">
                    <span class="text-4xl">✨</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900">En attente de votre talent</h3>
                <p class="text-slate-500 mt-3 font-medium">La bibliothèque est vide, mais pas pour longtemps.</p>
                <a href="{{ route('articles.create') }}" class="inline-block mt-10 px-10 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                    Lancer mon premier article
                </a>
            </div>
        @endif
    </section>
</div>
@endsection