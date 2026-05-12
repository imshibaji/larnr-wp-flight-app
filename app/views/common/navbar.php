<?php
use App\Utils\WpApi;

// Menu 1
$res = WpApi::init()->graphql('{menus(where: {location:MAX_MEGA_MENU_1}){nodes{id name menuItems{nodes{id label path}}}}}');
$menus = $res->data->menus->nodes[0]->menuItems->nodes; 
// dd($menus);
?>

<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center gap-8">
            <div class="flex items-center justify-center text-sm font-bold animate-bump">
                <img src="/assets/images/larnr-new-2.png" alt="Larnr Logo" class="w-10 h-10" />
                <a href="/" class="text-2xl font-bold text-indigo-600 px-1 py-1 rounded-lg">Larnr<span
                        class="text-xs text-indigo-200">v1</span></a>
            </div>
            <div class="hidden md:flex gap-6 text-sm font-medium text-slate-600">
                <?php foreach ($menus as $menu): ?>
                    <a href="<?= $menu->path ?>" class="hover:text-indigo-600 transition <?= active_url($menu->path) ?>"><?= $menu->label ?></a>
                <?php endforeach; ?>
                <!-- <a href="#" class="hover:text-indigo-600 transition">Mentors</a>
                <a href="#" class="hover:text-indigo-600 transition">Courses</a>
                <a href="#" class="hover:text-indigo-600 transition">For Business</a>
                <a href="#" class="hover:text-indigo-600 transition">Resources</a> -->
            </div>
        </div>
        <div class="flex items-center gap-4">
            <?php if (isset($user)): ?>
                <div id="loggedIn" class="gap-4">
                    <span class="text-sm font-medium text-slate-700">Hello <span id="uname"></span>,</span>
                    <a href="/dashboard"
                        class="text-sm font-semibold text-slate-700 hover:text-indigo-600 transition">Dashboard</a>
                    <a href="/logout"
                        class="text-sm font-semibold text-slate-700 hover:text-red-600 transition">Logout</a>
                </div>
            <?php else: ?>
                <div id="loggedOut" class="gap-4 items-center">
                    <a href="/login"
                        class="text-sm font-semibold text-slate-700 hover:text-indigo-600 transition mr-3">Log in</a>
                    <a href="/register"
                        class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition">Join
                        for Free</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>