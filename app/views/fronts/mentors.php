<?php $this->layout('layouts/front', [ 'title' => $page->title->rendered ?? '', 'seo' => $page->seo ?? '', 'seoHead' => $page->seoHead ?? '']) ?>

<header class="bg-white border-b border-slate-200 py-16" style="background:linear-gradient(239deg,rgb(43,41,116) 44%,rgb(52,42,153) 46%)">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-slate-200 mb-4">Learn from the <span class="text-indigo-400">Best in Class.</span></h1>
        <p class="text-slate-200 text-lg max-w-2xl mx-auto">Skip the trial and error. Get 1-on-1 guidance from industry experts working at top-tier tech companies.</p>
        
        <div class="mt-10 flex flex-wrap justify-center gap-3">
            <button class="px-6 py-2 rounded-full bg-slate-900 text-white font-semibold text-sm">All Mentors</button>
            <button class="px-6 py-2 rounded-full bg-white border border-slate-200 text-slate-600 hover:border-indigo-600 hover:text-indigo-600 transition text-sm">Software Engineering</button>
            <button class="px-6 py-2 rounded-full bg-white border border-slate-200 text-slate-600 hover:border-indigo-600 hover:text-indigo-600 transition text-sm">Data Science</button>
            <button class="px-6 py-2 rounded-full bg-white border border-slate-200 text-slate-600 hover:border-indigo-600 hover:text-indigo-600 transition text-sm">Product Design</button>
        </div>
    </div>
</header>
<main class="max-w-7xl mx-auto px-6 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($mentors as $mentor): ?>
            <?php $this->insert('common/mentor-card', [ 'mentor' => $mentor ]); ?>
        <?php endforeach; ?>
    </div>
</main>
<?php $this->insert('common/call-to-action'); ?>

<?php $this->insert('common/cache', [ 'updated_at' => $updated_at ?? '', 'is_cached' => $is_cached ?? false ]); ?>