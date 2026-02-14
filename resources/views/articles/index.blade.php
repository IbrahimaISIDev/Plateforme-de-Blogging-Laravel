@extends('layouts.app')

@section('title', 'Gestion des articles')

@section('content')
<div class="space-y-8 animate-fade-in">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Gestion des articles</h1>
            <p class="text-slate-500 font-medium mt-1">Gérez le contenu de votre plateforme en toute simplicité.</p>
        </div>
        <a href="{{ route('articles.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouvel article
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Article</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Catégorie</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Statut</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Date</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($articles as $article)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $article->title }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium mt-1">/{{ $article->slug }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-wider rounded-lg">
                                    {{ $article->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-6">
                                @if($article->is_published)
                                    <span class="inline-flex items-center space-x-1.5 text-emerald-600 text-[10px] font-black uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                        <span>Publié</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center space-x-1.5 text-slate-400 text-[10px] font-black uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 bg-slate-200 rounded-full"></span>
                                        <span>Brouillon</span>
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-6">
                                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider">{{ $article->created_at->format('d/m/Y') }}</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('article.show', $article->slug) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl shadow-none hover:shadow-md transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('articles.edit', $article) }}" class="p-2 text-slate-400 hover:text-amber-500 hover:bg-white rounded-xl shadow-none hover:shadow-md transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    
                                    <form action="{{ route('articles.toggle-publish', $article) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-2 {{ $article->is_published ? 'text-rose-400 hover:text-rose-600 font-black' : 'text-emerald-400 hover:text-emerald-600 font-black' }} hover:bg-white rounded-xl shadow-none hover:shadow-md transition-all">
                                            @if($article->is_published)
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            @endif
                                        </button>
                                    </form>

                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-300 hover:text-rose-600 hover:bg-white rounded-xl shadow-none hover:shadow-md transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="pt-4 flex justify-between items-center text-sm font-medium text-slate-400">
        <p>Affichage de {{ $articles->count() }} résultats</p>
        <div>{{ $articles->links() }}</div>
    </div>
</div>
@endsection