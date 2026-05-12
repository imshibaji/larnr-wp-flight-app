<?php $this->layout('layouts/front', ['title' => $page->title->rendered ?? 'Register', 'seo' => $page->seo ?? '', 'seoHead' => $page->seoHead ?? '']) ?>

<section class="bg-slate-50 flex items-center justify-center p-4 py-12">
    <div class="max-w-6xl w-full bg-white rounded-[3rem] shadow-2xl shadow-indigo-100 overflow-hidden flex flex-col lg:flex-row">
        <div class="hidden lg:flex w-5/12 bg-indigo-600 p-16 flex-col justify-between text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            
            <div class="relative z-10">
                <a href="#" class="text-2xl font-black tracking-tighter uppercase mb-12 inline-block text-white">Larnr.</a>
                <h2 class="text-4xl font-extrabold leading-tight mb-8">Start your journey to mastery today.</h2>
                
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <span class="bg-white/20 p-2 rounded-lg text-lg">🚀</span>
                        <div>
                            <p class="font-bold">Instant Access</p>
                            <p class="text-indigo-100 text-sm">Get immediate entry to 50+ free starter courses.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="bg-white/20 p-2 rounded-lg text-lg">🎯</span>
                        <div>
                            <p class="font-bold">Personalized Roadmap</p>
                            <p class="text-indigo-100 text-sm">We'll build a custom path based on your goals.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="bg-white/20 p-2 rounded-lg text-lg">🤝</span>
                        <div>
                            <p class="font-bold">Global Community</p>
                            <p class="text-indigo-100 text-sm">Connect with 50,000+ learners worldwide.</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="relative z-10 pt-12 border-t border-white/10">
                <p class="text-sm italic text-indigo-100">"EduFlow didn't just teach me to code; they taught me how to think like an engineer."</p>
                <p class="mt-4 font-bold text-sm">— Sarah Jenkins, Senior Instructor</p>
            </div>
        </div>

        <div class="w-full lg:w-7/12 p-8 md:p-16">
            <div class="max-w-md mx-auto lg:mx-0">
                <header class="mb-10 text-center lg:text-left">
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Create your account</h1>
                    <p class="text-slate-500 mt-2 font-medium">Join the world's most robust learning ecosystem.</p>
                </header>

                <div class="grid grid-cols-2 gap-4 mb-8 p-1 bg-slate-100 rounded-2xl">
                    <label class="cursor-pointer">
                        <input type="radio" name="role" class="sr-only peer" checked>
                        <div class="text-center py-2.5 rounded-xl text-sm font-bold text-slate-500 peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-sm transition">
                            Student
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" class="sr-only peer">
                        <div class="text-center py-2.5 rounded-xl text-sm font-bold text-slate-500 peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-sm transition">
                            Instructor
                        </div>
                    </label>
                </div>

                <form class="space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">First Name</label>
                            <input type="text" placeholder="John" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Last Name</label>
                            <input type="text" placeholder="Doe" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Email Address</label>
                        <input type="email" placeholder="john@example.com" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Password</label>
                        <input type="password" placeholder="••••••••" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium">
                        <div class="mt-3 flex gap-1 px-1">
                            <div class="h-1 flex-grow bg-indigo-500 rounded-full"></div>
                            <div class="h-1 flex-grow bg-indigo-500 rounded-full"></div>
                            <div class="h-1 flex-grow bg-slate-200 rounded-full"></div>
                            <div class="h-1 flex-grow bg-slate-200 rounded-full"></div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 py-2">
                        <input type="checkbox" class="mt-1 w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <p class="text-xs text-slate-500 leading-normal">
                            I agree to the <a href="#" class="text-indigo-600 font-bold hover:underline">Terms of Service</a> and <a href="#" class="text-indigo-600 font-bold hover:underline">Privacy Policy</a>.
                        </p>
                    </div>

                    <button class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black text-lg shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-1 transition active:scale-95">
                        Create Account
                    </button>
                </form>

                <div class="mt-8 text-center text-sm font-bold text-slate-500">
                    Already have an account? <a href="/login" class="text-indigo-600 hover:underline">Log in here</a>
                </div>
            </div>
        </div>
    </div>

</section>