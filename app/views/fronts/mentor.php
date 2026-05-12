<?= $this->layout('layouts/front', ['title' => $page->title->rendered ?? 'Mentor Details', 'seo' => $page->seo ?? '', 'seoHead' => $page->seoHead ?? '']); ?>

<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-12">
            <div class="bg-white rounded-[3rem] p-10 border border-slate-200 shadow-sm flex flex-col md:flex-row gap-10 items-center">
                <div class="relative">
                    <img src="https://i.pravatar.cc/300?u=mentor1" class="w-48 h-48 rounded-[2.5rem] object-cover shadow-2xl">
                    <div class="absolute -bottom-3 -right-3 bg-indigo-600 text-white p-2 rounded-xl shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                    </div>
                </div>
                <div class="text-center md:text-left space-y-4">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3">
                        <h1 class="text-4xl font-black text-slate-900">Marcus Thorne</h1>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Available to Book</span>
                    </div>
                    <p class="text-xl text-slate-500 font-medium leading-relaxed">Senior Software Engineer at <span class="text-indigo-600 font-bold">Google</span>. Cloud Infrastructure Expert.</p>
                    <div class="flex gap-4 justify-center md:justify-start">
                        <div class="bg-slate-100 p-2 rounded-lg hover:bg-indigo-50 cursor-pointer transition">LinkedIn</div>
                        <div class="bg-slate-100 p-2 rounded-lg hover:bg-indigo-50 cursor-pointer transition">GitHub</div>
                        <div class="bg-slate-100 p-2 rounded-lg hover:bg-indigo-50 cursor-pointer transition">Twitter</div>
                    </div>
                </div>
            </div>

            <section class="space-y-6">
                <h2 class="text-2xl font-bold">About Marcus</h2>
                <p class="text-slate-600 leading-relaxed text-lg">
                    With over 10 years of experience in the valley, I specialize in helping mid-level engineers transition into senior and staff roles. My mentoring style is hands-on: expect deep code reviews, architectural whiteboarding, and career strategy.
                </p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 text-center">
                        <p class="text-2xl font-black text-indigo-600">500+</p>
                        <p class="text-xs text-slate-400 font-bold uppercase">Hours Mentored</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 text-center">
                        <p class="text-2xl font-black text-indigo-600">98%</p>
                        <p class="text-xs text-slate-400 font-bold uppercase">Success Rate</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 text-center">
                        <p class="text-2xl font-black text-indigo-600">15 min</p>
                        <p class="text-xs text-slate-400 font-bold uppercase">Avg Response</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 text-center">
                        <p class="text-2xl font-black text-indigo-600">12+</p>
                        <p class="text-xs text-slate-400 font-bold uppercase">Talks Given</p>
                    </div>
                </div>
            </section>

            <section class="space-y-8">
                <h2 class="text-2xl font-bold">Work Experience</h2>
                <div class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
                    
                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-100 text-slate-300 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                            <svg class="fill-current w-3 h-3" viewBox="0 0 12 12"><path d="M12 10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8z"/></svg>
                        </div>
                        <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                            <div class="flex items-center justify-between space-x-2 mb-1">
                                <div class="font-bold text-slate-900 text-lg">Senior Software Engineer</div>
                                <time class="font-bold text-indigo-600 text-sm italic">2020 - Present</time>
                            </div>
                            <div class="text-slate-500 font-semibold mb-2 italic text-sm">Google (Cloud Infrastructure)</div>
                            <div class="text-slate-500 text-sm">Leading the migration of core services to a service-mesh architecture.</div>
                        </div>
                    </div>

                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-100 text-slate-300 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                            <svg class="fill-current w-3 h-3" viewBox="0 0 12 12"><path d="M12 10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8z"/></svg>
                        </div>
                        <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                            <div class="flex items-center justify-between space-x-2 mb-1">
                                <div class="font-bold text-slate-900 text-lg">Backend Engineer</div>
                                <time class="font-bold text-indigo-600 text-sm italic">2017 - 2020</time>
                            </div>
                            <div class="text-slate-500 font-semibold mb-2 italic text-sm">Stripe (Payments Team)</div>
                            <div class="text-slate-500 text-sm">Optimized transaction throughput for global payment processing.</div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-24 space-y-6">
                
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-xl">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Book a Session</h3>
                    
                    <div class="space-y-4 mb-8">
                        <label class="block p-4 rounded-2xl border-2 border-indigo-600 bg-indigo-50/50 cursor-pointer transition">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-slate-900">Career Strategy</span>
                                <span class="text-indigo-600 font-black">$60</span>
                            </div>
                            <p class="text-xs text-slate-500">60-minute deep dive into your career path.</p>
                        </label>
                        
                        <label class="block p-4 rounded-2xl border border-slate-200 hover:border-indigo-200 cursor-pointer transition">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-slate-900">Mock Interview</span>
                                <span class="text-slate-900 font-black">$85</span>
                            </div>
                            <p class="text-xs text-slate-500">90-minute technical interview simulation.</p>
                        </label>
                    </div>

                    <div class="space-y-4">
                        <p class="text-sm font-bold text-slate-900">Available next:</p>
                        <div class="flex gap-2">
                            <div class="flex-1 text-center py-2 bg-slate-100 rounded-lg text-xs font-bold">Tomorrow, 10 AM</div>
                            <div class="flex-1 text-center py-2 bg-slate-100 rounded-lg text-xs font-bold">Monday, 2 PM</div>
                        </div>
                    </div>

                    <button class="w-full mt-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                        Confirm Booking
                    </button>
                    <p class="text-center text-[10px] text-slate-400 mt-4 font-medium uppercase tracking-widest">Secure Payment via Stripe</p>
                </div>

                <div class="bg-indigo-900 text-white rounded-[2.5rem] p-8">
                    <div class="flex text-yellow-400 mb-4">★★★★★</div>
                    <p class="italic text-indigo-100 mb-6">"Marcus helped me land my dream job at Netflix within 3 months of mentoring. His system design tips are gold!"</p>
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/100?u=student1" class="w-10 h-10 rounded-full">
                        <div>
                            <p class="text-sm font-bold">James Wilson</p>
                            <p class="text-[10px] text-indigo-300 font-bold uppercase">Software Engineer @ Netflix</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>