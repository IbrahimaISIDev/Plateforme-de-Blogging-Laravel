@extends('layouts.app')

@section('title', 'Gestion des catégories')

@section('content')
<div class="space-y-8 animate-fade-in">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Thématiques</h1>
            <p class="text-slate-500 font-medium mt-1">Organisez votre contenu en thématiques cohérentes.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouvelle catégorie
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Nom & Slug</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Description</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Articles</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($categories as $category)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $category->name }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium mt-1">/{{ $category->slug }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-6 max-w-xs">
                                <p class="text-xs text-slate-500 font-medium line-clamp-1">{{ $category->description ?? 'Pas de description.' }}</p>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-wider rounded-lg">
                                    {{ $category->articles_count ?? 0 }} articles
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('category.articles', $category->slug) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl shadow-none hover:shadow-md transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}" class="p-2 text-slate-400 hover:text-amber-500 hover:bg-white rounded-xl shadow-none hover:shadow-md transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ? Tous les articles liés seront orphelins.')" class="inline">
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
</div>
@endsection