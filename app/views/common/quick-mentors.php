<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
        <div>
            <h2 class="text-4xl font-bold tracking-tight">Our Top Mentors</h2>
            <p class="text-slate-500 text-lg mt-2">Curated learning paths designed by world-class instructors.</p>
        </div>
        <!-- <div class="flex bg-slate-100 p-1 rounded-xl">
            <button class="bg-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm">Popular</button>
            <button class="px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Newest</button>
            <button class="px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Trending</button>
        </div> -->
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?= $this->insert('common/mentor-card'); ?>
        <?= $this->insert('common/mentor-card'); ?>
        <?= $this->insert('common/mentor-card'); ?>
    </div>
</section>