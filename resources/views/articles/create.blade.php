@extends('layouts.app')

@section('title', 'Nouvel article - BlogPro')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white rounded-[3rem] shadow-[0_32px_64px_-16px_rgba(31,38,135,0.08)] border border-slate-50 overflow-hidden animate-fade-in">
        <div class="p-10 md:p-16">
            <div class="mb-12">
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Nouvelle pépite</h1>
                <p class="text-slate-500 font-medium mt-2 text-lg">Partagez votre savoir avec le reste du monde.</p>
                <div class="h-1.5 w-12 bg-indigo-600 rounded-full mt-6"></div>
            </div>

            <form action="{{ route('articles.store') }}" method="POST" class="space-y-10">
                @csrf

                <!-- Titre -->
                <div class="space-y-3">
                    <label for="title" class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center">
                        <span>Titre de l'article</span>
                        <span class="ml-1 text-indigo-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           placeholder="Un titre percutant..."
                           class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-900 font-bold placeholder:text-slate-300 transition-all @error('title') ring-2 ring-rose-500 @enderror"
                           required>
                    @error('title')
                        <p class="text-[10px] font-black uppercase tracking-wider text-rose-500 animate-slide-in">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catégorie -->
                <div class="space-y-3">
                    <label for="category_id" class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center">
                        <span>Catégorie</span>
                        <span class="ml-1 text-indigo-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="category_id" 
                                id="category_id" 
                                class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-900 font-bold appearance-none transition-all @error('category_id') ring-2 ring-rose-500 @enderror"
                                required>
                            <option value="">-- Choisir une thématique --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    @error('category_id')
                        <p class="text-[10px] font-black uppercase tracking-wider text-rose-500 animate-slide-in">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Extrait -->
                <div class="space-y-3">
                    <label for="excerpt" class="text-sm font-black text-slate-800 uppercase tracking-widest">
                        Extrait / Résumé
                    </label>
                    <textarea name="excerpt" 
                              id="excerpt" 
                              rows="3"
                              placeholder="Un court résumé qui donne envie de lire..."
                              class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-600 font-medium placeholder:text-slate-300 transition-all @error('excerpt') ring-2 ring-rose-500 @enderror">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="text-[10px] font-black uppercase tracking-wider text-rose-500 animate-slide-in">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contenu -->
                <div class="space-y-3">
                    <label for="content" class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center">
                        <span>Corps de l'article</span>
                        <span class="ml-1 text-indigo-500">*</span>
                    </label>
                    <textarea name="content" 
                              id="content" 
                              rows="12"
                              placeholder="Votre histoire commence ici..."
                              class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-700 font-medium leading-relaxed placeholder:text-slate-300 transition-all @error('content') ring-2 ring-rose-500 @enderror"
                              required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-[10px] font-black uppercase tracking-wider text-rose-500 animate-slide-in">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Publier Toggle -->
                <div class="flex items-center p-6 bg-slate-50 rounded-2xl group transition-colors hover:bg-indigo-50/50">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-indigo-600 transition-all"></div>
                        <span class="ml-4 text-sm font-black text-slate-700 uppercase tracking-widest group-hover:text-indigo-600 transition-colors">Publier immédiatement</span>
                    </label>
                </div>

                <!-- Boutons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-6 border-t border-slate-50">
                    <a href="{{ route('articles.index') }}" 
                       class="text-sm font-black text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Annuler
                    </a>
                    <button type="submit" 
                            class="w-full sm:w-auto px-12 py-5 bg-indigo-600 text-white font-black uppercase tracking-[0.2em] text-xs rounded-2xl hover:bg-indigo-700 shadow-xl shadow-indigo-100 transition-all hover:-translate-y-1">
                        Lancer l'article
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection