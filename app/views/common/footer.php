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
<footer class="bg-slate-900 text-slate-400 py-16">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12">
        <div class="col-span-3">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-200 rounded-full mb-4 flex items-center justify-center text-white font-bold">
                    <img src="/assets/images/larnr-new-2.png" alt="Larnr Logo" class="w-12 h-12" />
                </div>
                <h2 class="text-white text-2xl font-bold mb-6 italic">Larnr Education<span class="text-xs text-indigo-200">v1.0.0</span></h2>
            </div>
            <p class="max-w-xl mb-8">Leading the charge in AI-driven education. We help developers bridge the gap between code and intelligence.</p>
            <div class="flex gap-4">
                <div class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-indigo-600 cursor-pointer">FB</div>
                <div class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-indigo-600 cursor-pointer">TW</div>
                <div class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-indigo-600 cursor-pointer">LN</div>
            </div>
        </div>
        <div>
            <?php if($menus1): ?>
                <h4 class="text-white font-bold mb-6"><?= $menus1->name; ?></h4>
                <ul class="space-y-4 text-sm">
                    <?php foreach($menus1->menuItems->nodes as $item): ?>
                        <li><a href="<?= $item->path; ?>" class="hover:text-white"><?= $item->label; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <!-- <div>
            <h4 class="text-white font-bold mb-6">Platform</h4>
            <ul class="space-y-4 text-sm">
                <li><a href="#" class="hover:text-white">Courses</a></li>
                <li><a href="#" class="hover:text-white">Live Classes</a></li>
                <li><a href="#" class="hover:text-white">Bootcamps</a></li>
            </ul>
        </div> -->
        <div>
            <?php if($menus2): ?>
            <h4 class="text-white font-bold mb-6">Support</h4>
            <ul class="space-y-4 text-sm">
                <?php foreach($menus2->menuItems->nodes as $item): ?>
                    <li><a href="<?= $item->path; ?>" class="hover:text-white"><?= $item->label; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-slate-800 text-sm flex justify-between">
        <p>©2013 - <?= date('Y'); ?> Larnr Education. All rights reserved.</p>
        <p>Built by <a href="https://shibajidebnath.com" class="text-slate-200 hover:underline transition-all underline-offset-4">Shibaji Debnath</a></p>
    </div>
</footer>