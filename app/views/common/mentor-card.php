<?php
// image, name, bio
$name = $mentor->title->rendered ?? null;
$image = $mentor->image->source_url ?? null;
$highlights = $mentor->highlights ?? null;
$bio = $mentor->seo->description ?? null;
$per_hour_rate = $mentor->per_hour_rate ?? null;
$rating = $mentor->success_rate ?? null;
$sessions = $mentor->sessions ?? null;
$link = $mentor->slug ?? null;
?>
<div class="group bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
    <div class="relative w-32 h-32 mx-auto mb-6">
        <img src="<?= $image ?? "https://i.pravatar.cc/300?u=mentor1"; ?>" class="w-full h-full rounded-[2rem] object-cover ring-4 ring-indigo-50 group-hover:ring-indigo-100 transition">
        <div class="absolute -bottom-2 -right-2 bg-green-500 border-4 border-white w-6 h-6 rounded-full" title="Available Now"></div>
    </div>

    <div class="text-center space-y-2">
        <h3 class="text-xl font-bold text-slate-900"><?= $name ?? "Marcus Thorne"; ?></h3>
        <p class="text-indigo-600 font-semibold text-sm uppercase tracking-wider"><?= $highlights ?? "Sr. Dev @ Google"; ?></p>
        <p class="text-slate-500 text-sm line-clamp-2"><?= $bio ?? "Helping developers master System Design and Scalable Architectures for 8+ years."; ?></p>
    </div>

    <div class="flex justify-between py-6 mt-6 border-t border-slate-50">
        <div class="text-center">
            <p class="text-lg font-bold text-slate-900"><?= $sessions ?? "10" ?>+</p>
            <p class="text-[10px] text-slate-400 uppercase font-bold">Sessions</p>
        </div>
        <div class="text-center">
            <p class="text-lg font-bold text-slate-900"><?= $rating ?? "4.9" ?></p>
            <p class="text-[10px] text-slate-400 uppercase font-bold">Rating</p>
        </div>
        <div class="text-center">
            <p class="text-lg font-bold text-slate-900">₹<?= $per_hour_rate ?? "50" ?>/-</p>
            <p class="text-[10px] text-slate-400 uppercase font-bold">Per Hr</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 mb-8">
        <?php foreach (explode(",", $skils ?? "Kubernetes, GoLang, AWS") as $skill): ?>
        <span class="px-3 py-1 bg-slate-50 text-slate-600 text-xs font-medium rounded-lg"><?=$skill?></span>
        <?php endforeach; ?>
    </div>

    <div class="flex items-center gap-2">
        <a href="/mentors/<?= $link ?? '' ?>" class="w-full p-4 bg-slate-50 text-slate-900 font-bold rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
            View Profile
        </a>
    </div>
</div>