<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'EcoShop API') }} — Éthique & Design</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['Roboto Mono', 'monospace'],
                    },
                }
            }
        }
    </script>

    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            opacity: 0.03;
            z-index: 9999;
            pointer-events: none;
            background-image: url("https://www.transparenttextures.com/patterns/stardust.png");
        }
    </style>
</head>
<body class="bg-[#FFFDF5] text-[#1A1A1A] font-mono antialiased overflow-x-hidden">

    <nav class="sticky top-0 w-full bg-white border-b-4 border-black px-6 py-4 z-">
        <div class="max-w-[1440px] mx-auto flex justify-between items-center">
            
            <a href="/" class="text-2xl font-black uppercase tracking-tighter flex items-center gap-2 group transition-transform hover:-rotate-1">
                <span class="bg-black text-white px-2 py-1 transition-colors group-hover:bg-emerald-500">ECO</span>
                <span class="text-black">SHOP.</span>
            </a>

            <div class="hidden md:flex gap-8 items-center text-xs font-black uppercase tracking-widest">
                <a href="#shop" class="hover:bg-emerald-300 px-3 py-1 border-2 border-transparent hover:border-black transition-all">Collections</a>
                <a href="#" class="hover:bg-emerald-300 px-3 py-1 border-2 border-transparent hover:border-black transition-all">API Docs</a>
                <a href="#" class="hover:bg-emerald-300 px-3 py-1 border-2 border-transparent hover:border-black transition-all">Panier (0)</a>
            </div>

            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="px-5 py-2 border-2 border-black font-black text-xs uppercase shadow-[4px_4px_0px_0px_#000] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all bg-white">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="hidden sm:block px-5 py-2 border-2 border-black bg-emerald-400 font-black text-xs uppercase shadow-[4px_4px_0px_0px_#000] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                        S'inscrire
                    </a>
                @else
                    <div class="flex items-center gap-3 bg-white border-2 border-black px-4 py-2 shadow-[4px_4px_0px_0px_#10b981]">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase">{{ Auth::user()->name }}</span>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="fixed bottom-10 right-10 z- bg-emerald-400 border-4 border-black p-6 shadow-[10px_10px_0px_0px_#000] animate-bounce">
            <p class="font-black uppercase text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="bg-black text-white p-12 border-t-8 border-emerald-500">
        <div class="max-w-[1440px] mx-auto grid md:grid-cols-2 gap-12">
            <div class="space-y-6">
                <div class="text-4xl font-black uppercase italic tracking-tighter">EcoShop.Core</div>
                <p class="text-emerald-500 font-bold tracking-widest uppercase text-[10px]">// End-to-End Sustainable API Solution</p>
            </div>
            <div class="grid grid-cols-2 gap-8 text-[10px] font-black uppercase tracking-[0.3em]">
                <div class="space-y-4">
                    <p class="text-gray-500">Links</p>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Documentation</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Github</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <p class="text-gray-500">Deployment</p>
                    <p class="text-white underline decoration-emerald-500">v2.4.0-stable</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>