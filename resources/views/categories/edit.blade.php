@extends('layouts.app')

@section('title', 'Modifier la catégorie - BlogPro')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <div class="bg-white rounded-[3rem] shadow-[0_32px_64px_-16px_rgba(31,38,135,0.08)] border border-slate-50 overflow-hidden animate-fade-in">
        <div class="p-10 md:p-16">
            <div class="mb-12">
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Réglages thématiques</h1>
                <p class="text-slate-500 font-medium mt-2 text-lg">Ajustez les détails de votre catégorie.</p>
                <div class="h-1.5 w-12 bg-indigo-600 rounded-full mt-6"></div>
            </div>

            <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-10">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div class="space-y-3">
                    <label for="name" class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center">
                        <span>Nom de la catégorie</span>
                        <span class="ml-1 text-indigo-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $category->name) }}"
                           class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-900 font-bold transition-all @error('name') ring-2 ring-rose-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-[10px] font-black uppercase tracking-wider text-rose-500 animate-slide-in">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="space-y-3">
                    <label for="description" class="text-sm font-black text-slate-800 uppercase tracking-widest">
                        Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="4"
                              class="w-full px-6 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-600 font-medium transition-all">{{ old('description', $category->description) }}</textarea>
                </div>

                <!-- Boutons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-6 border-t border-slate-50">
                    <a href="{{ route('categories.index') }}" 
                       class="text-sm font-black text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Retour
                    </a>
                    <button type="submit" 
                            class="w-full sm:w-auto px-12 py-5 bg-slate-900 text-white font-black uppercase tracking-[0.2em] text-xs rounded-2xl hover:bg-indigo-600 shadow-xl shadow-slate-100 transition-all hover:-translate-y-1">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection