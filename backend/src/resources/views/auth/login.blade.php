@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center p-6 bg-[#FFFDF5]">
    
    <div class="w-full max-w-md bg-white border-4 border-black p-8 shadow-[12px_12px_0px_0px_#000]">
        
        <div class="mb-10 border-b-4 border-black pb-6">
            <h1 class="text-4xl font-black uppercase tracking-tighter italic">Login_</h1>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">Authentification EcoShop.Core</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-2 border-red-500">
                <ul class="list-disc list-inside text-[10px] font-black text-red-500 uppercase">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="group">
                <label for="email" class="block text-xs font-black uppercase tracking-widest mb-2">Email_Endpoint</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full p-4 border-4 border-black bg-white focus:bg-emerald-50 focus:outline-none font-bold transition-colors placeholder:text-gray-300"
                    placeholder="dev@example.com">
            </div>

            <div class="group">
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="text-xs font-black uppercase tracking-widest">Access_Key</label>
                    <a href="#" class="text-[9px] font-bold uppercase text-gray-400 hover:text-black underline">Forgot?</a>
                </div>
                <input type="password" name="password" id="password" required
                    class="w-full p-4 border-4 border-black bg-white focus:bg-emerald-50 focus:outline-none font-bold transition-colors">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="remember" id="remember" 
                    class="w-5 h-5 border-4 border-black checked:bg-emerald-400 appearance-none cursor-pointer transition-all">
                <label for="remember" class="text-[10px] font-black uppercase tracking-widest cursor-pointer">Maintenir la session</label>
            </div>

            <button type="submit" class="w-full py-5 bg-black text-white font-black uppercase tracking-[0.3em] border-2 border-black shadow-[8px_8px_0px_0px_#10b981] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all active:scale-95">
                Establish Session ->
            </button>
        </form>

        <div class="mt-10 pt-6 border-t-2 border-black/10 flex flex-col items-center gap-4">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                Pas encore de terminal ? 
                <a href="{{ route('register') }}" class="text-black underline decoration-emerald-400 decoration-4 hover:bg-emerald-400 hover:text-white transition-colors px-1">Create_Account</a>
            </p>
        </div>
    </div>
</div>
@endsection