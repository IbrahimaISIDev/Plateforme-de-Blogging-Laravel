<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Plateforme de Blogging')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col font-sans selection:bg-indigo-100 selection:text-indigo-900">
    <!-- Header/Navigation -->
    <header class="sticky top-0 z-50 w-full glass shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="group flex items-center space-x-2">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg group-hover:rotate-6 transition-transform">
                            <span class="text-xl">📝</span>
                        </div>
                        <span class="text-2xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700">
                            Blog<span class="text-indigo-600">Pro</span>
                        </span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors uppercase tracking-wider">
                        Accueil
                    </a>
                    <a href="{{ route('categories.index') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors uppercase tracking-wider">
                        Catégories
                    </a>
                    <a href="{{ route('articles.index') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors uppercase tracking-wider">
                        Articles
                    </a>
                    <a href="{{ route('articles.create') }}" class="relative inline-flex items-center justify-center px-6 py-3 font-bold text-white transition-all duration-200 bg-indigo-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 hover:bg-indigo-700 shadow-md hover:shadow-xl hover:-translate-y-0.5">
                        Nouvel Article
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button class="text-slate-600 hover:text-indigo-600 p-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Messages flash -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        @if(session('success'))
            <div class="animate-fade-in bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm flex items-center space-x-3" role="alert">
                <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="animate-fade-in bg-rose-50 border border-rose-100 text-rose-700 px-6 py-4 rounded-2xl shadow-sm flex items-center space-x-3" role="alert">
                <svg class="h-5 w-5 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full animate-fade-in">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 py-16 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <span class="text-sm">📝</span>
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight">BlogPro</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Votre plateforme de blogging moderne pour partager vos idées, découvertes et passions avec le monde entier.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold uppercase tracking-widest text-xs mb-6 text-indigo-400">Navigation rapide</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Accueil</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-white transition-colors">Catégories</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-white transition-colors">Articles</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold uppercase tracking-widest text-xs mb-6 text-emerald-400">Newsletter</h4>
                    <div class="flex flex-col space-y-4">
                        <p class="text-xs text-slate-400">Inscrivez-vous pour recevoir les derniers articles par email.</p>
                        <div class="relative">
                            <input type="email" placeholder="votre@email.com" class="bg-slate-800 border-none rounded-xl px-4 py-3 text-sm w-full focus:ring-2 focus:ring-indigo-500">
                            <button class="absolute right-2 top-1.5 bg-indigo-600 text-white p-1.5 rounded-lg hover:bg-indigo-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-xs text-slate-500 font-medium tracking-wide">© {{ date('Y') }} BlogPro. Tous droits réservés.</p>
                <div class="flex space-x-6 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                    <a href="#" class="hover:text-white transition-colors">Confidentialité</a>
                    <a href="#" class="hover:text-white transition-colors">CGU</a>
                    <a href="#" class="hover:text-white transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>