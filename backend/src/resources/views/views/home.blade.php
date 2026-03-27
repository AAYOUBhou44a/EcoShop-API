@extends('layouts.app')

@section('content')
{{-- L'ajout de relative et z-0 ici garantit que le contenu reste sous le z-100 du Navbar --}}
<div class="relative z-0 min-h-screen bg-[#FFFDF5] text-[#1A1A1A] font-mono selection:bg-emerald-300 antialiased">

    <header class="border-b-4 border-black">
        <div class="max-w-[1440px] mx-auto grid lg:grid-cols-2">
            
            <div class="p-8 md:p-16 border-r-4 border-black flex flex-col justify-center space-y-10 bg-white">
                <div class="inline-block bg-emerald-400 border-2 border-black px-4 py-1 self-start shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <span class="text-[10px] font-black uppercase tracking-tighter">API Status: Operational</span>
                </div>
                
                <h1 class="text-7xl md:text-9xl font-black leading-[0.8] tracking-tighter uppercase">
                    Eco<br><span class="text-emerald-500">Shop</span><br>System.
                </h1>

                <p class="text-xl font-bold leading-tight max-w-sm">
                    L'infrastructure logicielle au service de la consommation <span class="bg-emerald-300 px-2">consciente</span>.
                </p>

                <div class="flex gap-6">
                    <button class="px-8 py-5 bg-black text-white font-black uppercase tracking-widest border-2 border-black shadow-[8px_8px_0px_0px_#10b981] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                        Get Started ->
                    </button>
                </div>
            </div>

            <div class="bg-emerald-50 flex items-center justify-center p-12 relative overflow-hidden group">
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>
                
                {{-- Correction Z-index : z-0 pour éviter de surmonter le Nav --}}
                <div class="relative z-0 w-full aspect-square border-4 border-black bg-white shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] group-hover:-translate-x-2 group-hover:-translate-y-2 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                </div>
            </div>
        </div>
    </header>

    <section class="max-w-[1440px] mx-auto p-8 md:p-16">
        <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-8">
            <h2 class="text-4xl font-black uppercase tracking-tighter border-b-8 border-emerald-400">Inventory_V1</h2>
            <div class="flex gap-4">
                <button class="px-6 py-2 border-2 border-black font-black uppercase text-xs hover:bg-emerald-200 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all">Filter: All</button>
                <button class="px-6 py-2 border-2 border-black font-black uppercase text-xs hover:bg-emerald-200 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all">Sort: Price</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            
            <div class="border-4 border-black bg-white p-6 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all group">
                <div class="aspect-square border-2 border-black mb-6 overflow-hidden relative z-0">
                    <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all">
                    <div class="absolute top-4 right-4 bg-yellow-300 border-2 border-black px-3 py-1 font-black text-[10px] uppercase">New</div>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-2xl font-black uppercase leading-none">Brosse Bambou</h3>
                        <span class="text-2xl font-black text-emerald-600">45MAD</span>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Category: Personal_Care</p>
                    <button class="w-full py-4 bg-emerald-400 border-2 border-black font-black uppercase tracking-widest hover:bg-black hover:text-white transition-colors">
                        Add to Cart +
                    </button>
                </div>
            </div>

            <div class="border-4 border-black bg-white p-6 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all group">
                <div class="aspect-square border-2 border-black mb-6 overflow-hidden relative z-0">
                    <img src="https://images.unsplash.com/photo-1602143407151-7111542de6e8?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all">
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-2xl font-black uppercase leading-none">Gourde Inox</h3>
                        <span class="text-2xl font-black text-emerald-600">240MAD</span>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Category: Accessories</p>
                    <button class="w-full py-4 bg-emerald-400 border-2 border-black font-black uppercase tracking-widest hover:bg-black hover:text-white transition-colors">
                        Add to Cart +
                    </button>
                </div>
            </div>

            <div class="border-4 border-black bg-white p-6 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all group">
                <div class="aspect-square border-2 border-black mb-6 overflow-hidden relative z-0">
                    <img src="https://images.unsplash.com/photo-1610419124449-d779fdf91eb3?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all">
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-2xl font-black uppercase leading-none">Sacs Lin</h3>
                        <span class="text-2xl font-black text-emerald-600">85MAD</span>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Category: Textile</p>
                    <button class="w-full py-4 bg-emerald-400 border-2 border-black font-black uppercase tracking-widest hover:bg-black hover:text-white transition-colors">
                        Add to Cart +
                    </button>
                </div>
            </div>

        </div>
    </section>


</div>
@endsection