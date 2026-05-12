<?php $this->layout('layouts/front', ['title' => $page->title->rendered ?? '', 'seo' => $page->seo ?? '', 'seoHead' => $page->seoHead ?? '']) ?>

<div>
    <?= $page->content->rendered ?? '' ?>

    <!-- Example: Cache UI Indicator -->
    <div class="text-xs text-slate-500 text-center">
        Last sync: <?= $updated_at ?? '' ?> 
        <a href="?refresh=1" style="color: blue; text-decoration: underline;">Refresh Now</a>
        
        <?php if ($is_cached): ?>
            <span style="color: green;">(Loaded from Cache)</span>
        <?php endif; ?>
    </div>
</div>