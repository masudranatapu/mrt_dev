@extends('frontend.layouts.app')

@section('title', 'Blogs')

@section('content')
    <!-- Hero -->
    <section class="pt-36 pb-12">
        <div class="container-x text-center fade-up">
            <span class="eyebrow">Blog</span>
            <h1 class="section-title mt-4">Field <span class="text-gradient">Notes</span></h1>
            <p class="mt-4 text-slate-400 max-w-xl mx-auto">Lessons from shipping Laravel systems at scale.</p>
            <form class="mt-8 flex max-w-md mx-auto gap-2">
                <input class="input" placeholder="🔍 Search articles..." />
                <button class="btn btn-primary">Go</button>
            </form>
            <div class="mt-6 flex flex-wrap justify-center gap-2 text-sm">
                <a class="glass px-3 py-1 hover:text-cyan-300" href="#">All</a>
                <a class="glass px-3 py-1 hover:text-cyan-300" href="#">Laravel</a>
                <a class="glass px-3 py-1 hover:text-cyan-300" href="#">APIs</a>
                <a class="glass px-3 py-1 hover:text-cyan-300" href="#">Realtime</a>
                <a class="glass px-3 py-1 hover:text-cyan-300" href="#">DevOps</a>
                <a class="glass px-3 py-1 hover:text-cyan-300" href="#">Career</a>
            </div>
        </div>
    </section>
    <!-- Featured -->
    <section class="section pt-0">
        <div class="container-x">
            <h2 class="font-display text-2xl mb-6 fade-up">⚡ Featured</h2>
            <a href="blog-details.html" class="project-card glass glass-hover relative grid md:grid-cols-2 fade-up">
                <div
                    class="aspect-video md:aspect-auto thumb bg-gradient-to-br from-cyan-500/30 to-purple-600/30 grid place-items-center text-7xl">
                    🚀</div>
                <div class="p-8">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">Laravel · Performance</p>
                    <h3 class="font-display text-2xl mt-2">Scaling Laravel to 10k req/sec without losing your mind</h3>
                    <p class="mt-3 text-slate-400">A practical playbook covering Octane, queue tuning, Redis, and
                        database
                        sharding.</p>
                    <p class="mt-6 text-sm text-slate-500">May 12, 2026 · 9 min read</p>
                </div>
            </a>
        </div>
    </section>

    <!-- Grid -->
    <section class="section pt-0">
        <div class="container-x grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="blog-details.html" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-video thumb bg-gradient-to-br from-purple-500/30 to-pink-500/30 grid place-items-center text-5xl">
                    🛰</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">APIs</p>
                    <h3 class="font-display text-lg mt-1">Designing APIs your future self won't curse</h3>
                    <p class="text-slate-500 text-sm mt-3">Apr 28 · 6 min</p>
                </div>
            </a>
            <a href="blog-details.html" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-video thumb bg-gradient-to-br from-blue-500/30 to-cyan-500/30 grid place-items-center text-5xl">
                    💬</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">Realtime</p>
                    <h3 class="font-display text-lg mt-1">Laravel Echo + Pusher: a battle-tested stack</h3>
                    <p class="text-slate-500 text-sm mt-3">Apr 15 · 7 min</p>
                </div>
            </a>
            <a href="blog-details.html" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-video thumb bg-gradient-to-br from-emerald-500/30 to-cyan-500/30 grid place-items-center text-5xl">
                    🧪</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">Testing</p>
                    <h3 class="font-display text-lg mt-1">PHPUnit patterns I steal on every project</h3>
                    <p class="text-slate-500 text-sm mt-3">Mar 30 · 5 min</p>
                </div>
            </a>
            <a href="blog-details.html" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-video thumb bg-gradient-to-br from-fuchsia-500/30 to-indigo-500/30 grid place-items-center text-5xl">
                    🛒</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">Shopify</p>
                    <h3 class="font-display text-lg mt-1">Building Shopify apps with Laravel: the right way</h3>
                    <p class="text-slate-500 text-sm mt-3">Mar 12 · 8 min</p>
                </div>
            </a>
            <a href="blog-details.html" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-video thumb bg-gradient-to-br from-rose-500/30 to-orange-500/30 grid place-items-center text-5xl">
                    🐳</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">DevOps</p>
                    <h3 class="font-display text-lg mt-1">Zero-downtime deploys with Docker + Forge</h3>
                    <p class="text-slate-500 text-sm mt-3">Feb 22 · 6 min</p>
                </div>
            </a>
            <a href="blog-details.html" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-video thumb bg-gradient-to-br from-cyan-500/30 to-indigo-500/30 grid place-items-center text-5xl">
                    🧠</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">Career</p>
                    <h3 class="font-display text-lg mt-1">From junior to senior Laravel dev in 3 years</h3>
                    <p class="text-slate-500 text-sm mt-3">Feb 02 · 7 min</p>
                </div>
            </a>
        </div>

        <!-- Pagination -->
        <div class="container-x mt-12 flex justify-center gap-2 fade-up">
            <button class="btn btn-ghost !py-2 !px-4">←</button>
            <button class="btn btn-primary !py-2 !px-4">1</button>
            <button class="btn btn-ghost !py-2 !px-4">2</button>
            <button class="btn btn-ghost !py-2 !px-4">3</button>
            <button class="btn btn-ghost !py-2 !px-4">→</button>
        </div>
    </section>
@endsection

@push('script')
@endpush
