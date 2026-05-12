<?php $this->layout('common/layout', ['title' => $page->title->rendered ?? '', 'seo' => $page->seo ?? '', 'seoHead' => $page->seoHead ?? '']) ?>

<div class="min-h-[70vh] flex flex-col justify-center items-center px-6">
    <!-- Decorative Background Element -->
    <div class="absolute -z-10 w-64 h-64 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>

    <div class="text-center">
        <!-- Main Error Code -->
        <h1 class="text-9xl font-black text-indigo-600/20 animate-pulse">403</h1>
        
        <div class="relative -mt-16">
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight sm:text-4xl">
                Forbidden Access
            </h2>
            <p class="mt-4 text-base leading-7 text-slate-600 max-w-sm mx-auto">
                You don't have permission to access this page. Please contact your administrator.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="/" class="rounded-full bg-indigo-600 px-8 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200">
                Back to Home
            </a>
            <a href="javascript:history.back()" class="text-sm font-semibold text-slate-700 hover:text-indigo-600 transition-colors">
                <span aria-hidden="true">&larr;</span> Go Back
            </a>
        </div>
    </div>
</div>
