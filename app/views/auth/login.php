<?php $this->layout('layouts/front', ['title' => $page->title->rendered ?? 'Login', 'seo' => $page->seo ?? '', 'seoHead' => $page->seoHead ?? '']) ?>

<section class="bg-slate-50 flex items-center justify-center p-4 py-12">
<div class="max-w-5xl w-full bg-white rounded-[3rem] shadow-2xl shadow-indigo-100 overflow-hidden flex flex-col md:flex-row min-h-[600px]">

    <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center">
        <div class="mb-10 text-center md:text-left">
            <a href="#" class="text-2xl font-black text-indigo-600 tracking-tighter uppercase mb-8 inline-block">Larnr.</a>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Welcome Back</h1>
            <p class="text-slate-500 mt-2 font-medium">Enter your details to access your learning dashboard.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-8">
            <button class="flex items-center justify-center gap-2 py-3 border border-slate-200 rounded-2xl hover:bg-slate-50 transition font-bold text-sm text-slate-700">
                <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4"> Google
            </button>
            <button class="flex items-center justify-center gap-2 py-3 border border-slate-200 rounded-2xl hover:bg-slate-50 transition font-bold text-sm text-slate-700">
                <img src="https://www.svgrepo.com/show/512317/github-142.svg" class="w-4 h-4"> Github
            </button>
        </div>

        <div class="relative mb-8 text-center">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
            <span class="relative bg-white px-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Or Email</span>
        </div>

        <form class="space-y-5">
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Email Address</label>
                <input type="email" placeholder="name@company.com" class="w-full px-5 py-4 bg-slate-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium">
            </div>
            <div>
                <div class="flex justify-between items-center mb-2 ml-1">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400">Password</label>
                    <a href="/forget" class="text-xs font-bold text-indigo-600 hover:underline">Forgot?</a>
                </div>
                <input type="password" placeholder="••••••••" class="w-full px-5 py-4 bg-slate-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium">
            </div>
            
            <button class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black text-lg shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-1 transition active:scale-95">
                Sign In
            </button>
        </form>

        <p class="mt-8 text-center text-sm font-bold text-slate-500">
            Don't have an account? <a href="/register" class="text-indigo-600 hover:underline">Join Larnr for free</a>
        </p>
    </div>

    <div class="hidden md:flex w-1/2 bg-slate-900 p-16 flex-col justify-between relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-600/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-violet-600/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="relative z-10">
            <div class="flex gap-1 mb-8">
                <span class="text-yellow-400 text-xl">★★★★★</span>
            </div>
            <h2 class="text-3xl font-bold text-white leading-tight">"The best investment I've made in my career. The mentors are world-class."</h2>
            <div class="mt-8 flex items-center gap-4">
                <img src="https://i.pravatar.cc/100?u=student2" class="w-12 h-12 rounded-2xl border-2 border-indigo-500">
                <div>
                    <p class="text-white font-bold">Alex Rivera</p>
                    <p class="text-indigo-400 text-sm font-medium">Full Stack Developer @ Vercel</p>
                </div>
            </div>
        </div>

        <div class="relative z-10 grid grid-cols-2 gap-8 border-t border-white/10 pt-8">
            <div>
                <p class="text-2xl font-black text-white">45k+</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Active Students</p>
            </div>
            <div>
                <p class="text-2xl font-black text-white">120+</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Global Mentors</p>
            </div>
        </div>
    </div>
</div>
</section>