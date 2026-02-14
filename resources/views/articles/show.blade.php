@extends('layouts.app')

@section('title', 'Détails - ' . $article->title)

@section('content')
<div class="max-w-4xl mx-auto py-10 animate-fade-in">
    <div class="bg-white rounded-[3rem] shadow-[0_32px_64px_-16px_rgba(31,38,135,0.08)] border border-slate-50 overflow-hidden relative">
        <!-- Floating Back Button -->
        <a href="{{ route('articles.index') }}" class="absolute top-10 left-10 p-3 bg-white/80 backdrop-blur-md rounded-2xl border border-slate-100 shadow-sm text-slate-900 hover:text-indigo-600 hover:shadow-xl transition-all z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>

        <!-- Accent Header -->
        <div class="h-64 md:h-80 w-full bg-gradient-to-br from-indigo-600 via-indigo-600 to-sky-500 relative flex items-end justify-center pb-20">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative px-10 text-center space-y-4">
                <span class="bg-white/20 backdrop-blur-md border border-white/30 text-white text-[10px] font-black uppercase tracking-[0.2em] px-5 py-2 rounded-full">
                    {{ $article->category->name }}
                </span>
            </div>
        </div>

        <div class="relative px-10 md:px-20 pb-20 -mt-16 bg-white rounded-t-[3rem]">
            <div class="flex flex-col items-center pt-16 space-y-10">
                <div class="text-center space-y-6">
                    <div class="flex items-center justify-center text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] space-x-3">
                        <span>Créé le {{ $article->created_at->translatedFormat('d F Y') }}</span>
                        <span class="w-1.5 h-1.5 bg-slate-200 rounded-full"></span>
                        @if($article->is_published)
                            <span class="text-emerald-500">Publié</span>
                        @else
                            <span class="text-amber-500">Brouillon</span>
                        @endif
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-[1.1]">
                        {{ $article->title }}
                    </h1>
                </div>

                <div class="w-full max-w-2xl text-center">
                    <p class="text-xl text-slate-500 font-medium leading-relaxed italic">
                        "{{ $article->excerpt }}"
                    </p>
                </div>

                <div class="w-full h-px bg-slate-50"></div>

                <div class="w-full max-w-3xl prose prose-indigo prose-lg text-slate-700 font-medium leading-[1.8] space-y-6">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <div class="w-full h-px bg-slate-50"></div>

                <div class="w-full flex flex-col md:flex-row items-center justify-between gap-6 pt-4">
                    <div class="flex items-center space-x-12">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Dernière mise à jour</span>
                            <span class="text-sm font-bold text-slate-700">{{ $article->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <a href="{{ route('articles.edit', $article) }}" class="px-8 py-4 bg-slate-900 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl hover:bg-slate-700 transition-all shadow-xl shadow-slate-100">
                            Édition
                        </a>
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Supprimer définitivement ?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-8 py-4 bg-white border border-rose-100 text-rose-500 font-black uppercase tracking-widest text-[10px] rounded-2xl hover:bg-rose-50 transition-all">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
