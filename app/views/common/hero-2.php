<section class="relative pt-32 pb-20 md:pt-48 md:pb-32 overflow-hidden bg-white">
    <div class="absolute inset-0 z-0 pointer-events-none bg-[radial-gradient(circle_at_50%_120%,rgba(79,70,229,0.05),transparent)]"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col items-center text-center">
            <div class="inline-flex items-center space-x-2 px-4 py-1.5 bg-indigo-50 rounded-full mb-8 border border-indigo-100 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-600">AI-Powered Tech Academy</span>
            </div>
            
            <h1 class="text-5xl md:text-8xl font-extrabold tracking-tight text-slate-900 mb-8 leading-tight">
                Master the Art of <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">AI Automation.</span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mb-12 leading-relaxed">
                Don't just code. Architect the future. Master JavaScript, Python, and n8n to build intelligent, automated systems <span class="text-indigo-600 font-semibold">10x faster</span>.
            </p>

            <div class="flex flex-col sm:flex-row gap-5">
                <button class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:scale-105 transition-all shadow-xl shadow-slate-200 active:scale-95">
                    Explore Courses
                </button>
                <button class="px-10 py-4 bg-white border border-slate-200 text-slate-600 rounded-2xl font-bold hover:bg-slate-50 transition shadow-sm active:scale-95">
                    View Curriculum
                </button>
            </div>
        </div>
    </div>
    
    <div class="container mx-auto px-6 mt-20 flex justify-center animate-float">
        <div class="w-full max-w-3xl bg-white p-1 rounded-3xl border border-slate-100 shadow-2xl">
            <div class="bg-slate-50 rounded-2xl p-8 font-mono text-sm overflow-hidden border border-slate-200/50">
                <div class="flex space-x-2 mb-6">
                    <div class="w-3 h-3 rounded-full bg-red-400/30"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-400/30"></div>
                    <div class="w-3 h-3 rounded-full bg-green-400/30"></div>
                </div>
                <p class="text-slate-400 italic mb-2">// Initializing your 10x productivity workflow</p>
                
                <p class="text-indigo-600">
                    import <span class="text-slate-900">&lcub;</span> 
                    <span class="text-blue-600">SmartDev</span> 
                    <span class="text-slate-900">&rcub;</span> 
                    from <span class="text-emerald-600">'@larnr/automation'</span>;
                </p>
                <br>
                <p><span class="text-purple-600">const</span> career = <span class="text-blue-600">new</span> <span class="text-indigo-600">SmartDev</span>(&lcub;</p>
                <p class="ml-6 text-slate-700">stack: [<span class="text-emerald-600">'Next.js'</span>, <span class="text-emerald-600">'n8n'</span>, <span class="text-emerald-600">'AI_SDK'</span>],</p>
                <p class="ml-6 text-slate-700">manual_work: <span class="text-red-500">false</span>,</p>
                <p class="ml-6 text-slate-700">income_growth: <span class="text-emerald-600">'exponential'</span></p>
                <p class="text-slate-700">&rcub;);</p>
            </div>
        </div>
    </div>
</section>

<style>
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
</style>