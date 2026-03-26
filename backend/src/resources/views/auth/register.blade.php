@extends('layouts.app')

@section('content')
<div class="min-h-[90vh] flex items-center justify-center p-6 py-20 bg-[#FFFDF5]">
    
    <div class="w-full max-w-lg bg-white border-4 border-black p-8 shadow-[12px_12px_0px_0px_#10b981]">
        
        <div class="mb-10 flex justify-between items-end border-b-4 border-black pb-6">
            <div>
                <h1 class="text-4xl font-black uppercase tracking-tighter italic">Register_</h1>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">Création d'un accès EcoShop.Core</p>
            </div>
            <span class="text-[10px] font-black bg-black text-white px-3 py-1 uppercase tracking-tighter">v.2.0</span>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="group">
                <label for="name" class="block text-xs font-black uppercase tracking-widest mb-2">Full_Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    class="w-full p-4 border-4 border-black bg-white focus:bg-emerald-50 focus:outline-none font-bold transition-colors placeholder:text-gray-300"
                    placeholder="Ex: Houdda Ayoub">
                @error('name') 
                    <p class="mt-2 text-[10px] font-black text-red-500 uppercase tracking-tighter bg-red-50 p-2 border-2 border-red-500">{{ $message }}</p> 
                @enderror
            </div>

            <div class="group">
                <label for="email" class="block text-xs font-black uppercase tracking-widest mb-2">Email_Endpoint</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full p-4 border-4 border-black bg-white focus:bg-emerald-50 focus:outline-none font-bold transition-colors placeholder:text-gray-300"
                    placeholder="dev@example.com">
                @error('email') 
                    <p class="mt-2 text-[10px] font-black text-red-500 uppercase tracking-tighter bg-red-50 p-2 border-2 border-red-500">{{ $message }}</p> 
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label for="password" class="block text-xs font-black uppercase tracking-widest mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full p-4 border-4 border-black bg-white focus:bg-emerald-50 focus:outline-none font-bold transition-colors">
                </div>
                <div class="group">
                    <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest mb-2">Confirm_Pwd</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full p-4 border-4 border-black bg-white focus:bg-emerald-50 focus:outline-none font-bold transition-colors">
                </div>
            </div>

            <div class="flex items-start gap-3 p-4 bg-gray-50 border-2 border-black">
                <input type="checkbox" id="terms" required class="mt-1 w-5 h-5 border-4 border-black checked:bg-emerald-400 appearance-none cursor-pointer transition-all">
                <label for="terms" class="text-[9px] font-bold uppercase leading-tight text-gray-500">
                    J'accepte que mes données soient traitées selon les <span class="text-black underline">Protocoles de Sécurité EcoShop</span>.
                </label>
            </div>

            <button type="submit" class="w-full py-5 bg-black text-white font-black uppercase tracking-[0.3em] border-2 border-black shadow-[8px_8px_0px_0px_#10b981] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all active:scale-95">
                Initialize Account ->
            </button>
        </form>

        <div class="mt-10 pt-6 border-t-2 border-black/10 flex flex-col items-center gap-4">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                Déjà enregistré ? 
                <a href="{{ route('login') }}" class="text-black underline decoration-emerald-400 decoration-4 hover:bg-emerald-400 hover:text-white transition-colors px-1">Login_Session</a>
            </p>
        </div>
    </div>
</div>
@endsection