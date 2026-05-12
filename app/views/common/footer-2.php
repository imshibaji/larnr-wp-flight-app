<?php
use App\Utils\WpApi;

// Menu 2
$res = WpApi::init()->graphql('{menus(where: {location:MAX_MEGA_MENU_2}){nodes{id name menuItems{nodes{id label path}}}}}');
$menus1 = $res->data->menus->nodes[0];
// dd($menus1);

// Menu 3
$res = WpApi::init()->graphql('{menus(where: {location:MAX_MEGA_MENU_3}){nodes{id name menuItems{nodes{id label path}}}}}');
$menus2 = $res->data->menus->nodes[0];

// dd($menus2);
?>
<footer class="py-20 bg-white border-t border-slate-100">
    <div class="container mx-auto max-w-7xl px-6">
        <div class="flex flex-col md:flex-row justify-between items-start gap-12 mb-16">
            <div class="max-w-xs">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-transparent rounded-full mb-4 flex items-center justify-center text-white font-bold">
                        <img src="/assets/images/larnr-new-2.png" alt="Larnr Logo" class="w-12 h-12" />
                    </div>
                    <h2 class="text-2xl font-black text-indigo-600 mb-6 tracking-tighter">
                        Larnr Education<span class="text-xs text-slate-900">v1</span>
                    </h2>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed font-medium">
                    Leading the charge in AI-driven education. We help developers bridge the gap between code and intelligence.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-2 gap-16 md:gap-24">
                <div>
                    <?php if($menus1): ?>
                        <h4 class="text-slate-900 text-[10px] font-black uppercase tracking-widest mb-6"><?= $menus1->name; ?></h4>
                        <ul class="space-y-4 text-sm text-slate-500 font-semibold">
                            <?php foreach($menus1->menuItems->nodes as $item): ?>
                                <li><a href="<?= $item->path; ?>" class="hover:text-indigo-600 transition-colors"><?= $item->label; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if($menus2): ?>
                        <h4 class="text-slate-900 text-[10px] font-black uppercase tracking-widest mb-6"><?= $menus2->name; ?></h4>
                        <ul class="space-y-4 text-sm text-slate-500 font-semibold">
                            <?php foreach($menus2->menuItems->nodes as $item): ?>
                                <li><a href="<?= $item->path; ?>" class="hover:text-indigo-600 transition-colors"><?= $item->label; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400 gap-4">
            <p>©2013 - <?= date('Y'); ?> LARNR.COM — BUILDING THE FUTURE.</p>
            <p>
                Designed by 
                <a href="https://shibajidebnath.com" class="text-indigo-600 hover:underline transition-all underline-offset-4">
                    Shibaji Debnath
                </a>
            </p>
        </div>
    </div>
</footer>