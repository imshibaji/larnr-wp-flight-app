<?= $this->layout('layouts/front', ['title' => $page->title->rendered ?? 'Dashboard', 'seo' => $page->seo ?? '', 'seoHead' => $page->seoHead ?? '']); ?>

<section class="max-w-7xl mx-auto px-4">
<div class="flex min-h-screen">
    <aside class="w-64 bg-slate-900 text-white hidden md:flex flex-col p-6">
        <div class="mb-10">
            <div class="relative w-32 h-32 mx-auto mt-3">
                <img src="https://larnr.com/wp-content/uploads/2026/04/logo_copy-scaled.jpg" class="w-full h-full rounded-[2rem] object-cover ring-4 ring-indigo-50 group-hover:ring-indigo-100 transition">
                <div class="absolute -bottom-2 -right-2 bg-green-500 border-4 border-white w-6 h-6 rounded-full" title="Available Now"></div>
            </div>
        </div>
        <nav class="space-y-2 flex-grow">
            <a href="#" class="flex items-center gap-3 bg-indigo-600 p-3 rounded-xl font-bold">📊 Dashboard</a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-800 transition font-medium text-slate-400 hover:text-white">📚 My Courses</a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-800 transition font-medium text-slate-400 hover:text-white">📝 Grading</a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-800 transition font-medium text-slate-400 hover:text-white">👥 Students</a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-800 transition font-medium text-slate-400 hover:text-white">💬 Messages</a>
        </nav>
        <div class="mt-auto p-4 bg-slate-800 rounded-2xl">
            <p class="text-xs font-bold text-slate-500 uppercase">Pro Account</p>
            <p class="text-sm font-bold mt-1">Sarah Jenkins</p>
        </div>
    </aside>

    <main class="flex-grow p-4 md:p-10 overflow-y-auto">
        
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Welcome back, Sarah 👋</h1>
                <p class="text-slate-500">Here’s what’s happening across your 4 active courses.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-white border border-slate-200 px-5 py-2.5 rounded-xl font-bold hover:bg-slate-50 transition shadow-sm">Schedule Live</button>
                <button class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">+ Create Content</button>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-slate-400 text-xs font-bold uppercase mb-2">Total Students</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-black">1,240</span>
                    <span class="text-green-500 text-xs font-bold mb-1">↑ 12%</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-slate-400 text-xs font-bold uppercase mb-2">Avg. Engagement</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-black">84%</span>
                    <span class="text-slate-400 text-xs font-bold mb-1">Stable</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-slate-400 text-xs font-bold uppercase mb-2">Pending Grading</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-black text-rose-500">28</span>
                    <span class="text-rose-200 text-xs font-bold mb-1 underline cursor-pointer">View List</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-slate-400 text-xs font-bold uppercase mb-2">Revenue (Feb)</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-black">$4,280</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                    <h3 class="text-xl font-bold mb-6">Pending Grading</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-slate-100 transition cursor-pointer">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-lg">📝</div>
                                <div>
                                    <p class="font-bold text-sm">UI/UX: Module 4 Case Study</p>
                                    <p class="text-xs text-slate-500 font-medium">Student: Alex Rivera • Submitted 2h ago</p>
                                </div>
                            </div>
                            <button class="text-indigo-600 font-bold text-xs">Grade Now</button>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-slate-100 transition cursor-pointer">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-lg">💻</div>
                                <div>
                                    <p class="font-bold text-sm">JS: Advanced Patterns Quiz</p>
                                    <p class="text-xs text-slate-500 font-medium">Student: Emma Stone • Submitted 5h ago</p>
                                </div>
                            </div>
                            <button class="text-indigo-600 font-bold text-xs">Grade Now</button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                    <h3 class="text-xl font-bold mb-6">Student Spotlight</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-50">
                                <tr>
                                    <th class="pb-4">Student</th>
                                    <th class="pb-4">Course</th>
                                    <th class="pb-4">Progress</th>
                                    <th class="pb-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <tr class="border-b border-slate-50">
                                    <td class="py-4 flex items-center gap-3">
                                        <img src="https://i.pravatar.cc/100?u=a" class="w-8 h-8 rounded-full">
                                        <span class="font-bold">David Chen</span>
                                    </td>
                                    <td class="py-4 text-slate-500">React Masterclass</td>
                                    <td class="py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="bg-green-500 h-full w-[90%]"></div>
                                            </div>
                                            <span class="text-[10px] font-bold">90%</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-right underline text-indigo-600 font-bold cursor-pointer">View</td>
                                </tr>
                                <tr>
                                    <td class="py-4 flex items-center gap-3">
                                        <img src="https://i.pravatar.cc/100?u=b" class="w-8 h-8 rounded-full">
                                        <span class="font-bold text-rose-600">Marcus Wright</span>
                                    </td>
                                    <td class="py-4 text-slate-500">Data Science 101</td>
                                    <td class="py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="bg-rose-500 h-full w-[12%]"></div>
                                            </div>
                                            <span class="text-[10px] font-bold">12%</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-right underline text-indigo-600 font-bold cursor-pointer">Nudge</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-slate-900 text-white rounded-[2.5rem] p-8">
                    <h3 class="text-lg font-bold mb-6">Upcoming Lives</h3>
                    <div class="space-y-6">
                        <div class="flex gap-4 border-l-2 border-indigo-500 pl-4">
                            <div>
                                <p class="text-xs font-bold text-indigo-400 uppercase">Today • 2:00 PM</p>
                                <p class="font-bold text-sm">UI Design Q&A Session</p>
                                <p class="text-xs text-slate-400 mt-1">42 Students Registered</p>
                            </div>
                        </div>
                        <div class="flex gap-4 border-l-2 border-slate-700 pl-4">
                            <div>
                                <p class="text-xs font-bold text-slate-500 uppercase">Feb 15 • 10:00 AM</p>
                                <p class="font-bold text-sm">Introduction to Node.js</p>
                            </div>
                        </div>
                    </div>
                    <button class="w-full mt-8 py-3 bg-white/10 rounded-xl text-xs font-bold hover:bg-white/20 transition">View Full Calendar</button>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200">
                    <h3 class="text-lg font-bold mb-4">Course Popularity</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>React Masterclass</span>
                                <span>$2,100</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="bg-indigo-600 h-full w-[75%]"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>UI/UX Bootcamp</span>
                                <span>$1,450</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="bg-indigo-400 h-full w-[45%]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
</section>