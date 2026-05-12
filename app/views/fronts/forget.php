<?= $this->layout('layouts/front', ['title' => $page->title->rendered ?? 'Forget Password', 'seo' => $page->seo ?? '', 'seoHead' => $page->seoHead ?? '']); ?>

<section class="bg-slate-50 flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-[3rem] shadow-2xl shadow-indigo-100 p-10 md:p-14 border border-slate-100">
        <div class="text-center mb-10">
            <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-[2rem] flex items-center justify-center text-3xl mx-auto mb-6">
                🔑
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Forgot Password?</h1>
            <p class="text-slate-500 mt-3 font-medium leading-relaxed">
                No worries, it happens! Enter your email and we'll send you a secure link to reset it.
            </p>
        </div>
        <form class="space-y-6">
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Registered Email</label>
                <div class="relative">
                    <span class="absolute left-5 top-4 opacity-40">📧</span>
                    <input type="email" placeholder="you@example.com" 
                        class="w-full pl-12 pr-5 py-4 bg-slate-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium">
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black text-lg shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-1 transition active:scale-95">
                Send Reset Link
            </button>
        </form>

        <div class="mt-2 pt-8 border-t border-slate-50 text-center">
            <a href="javascript:history.back()" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition flex items-center justify-center gap-2">
                <span>←</span> Back to Login
            </a>
        </div>
    </div>
</section>