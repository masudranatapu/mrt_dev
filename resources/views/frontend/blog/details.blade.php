@extends('frontend.layouts.app')

@section('title', 'Blog Details')

@section('content')
    <!-- Article -->
    <article class="pt-32 pb-16">
        <div class="container-x max-w-3xl">
            <div class="fade-up">
                <p class="text-cyan-300 uppercase tracking-widest text-xs">Laravel · Performance</p>
                <h1 class="section-title mt-3">Scaling Laravel to <span class="text-gradient">10k req/sec</span> without
                    losing your mind</h1>
                <div class="mt-4 flex items-center gap-3 text-slate-400 text-sm">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-cyan-400 to-purple-500"></div>
                    <span>Masud Rana Tapu · May 12, 2026 · 9 min read</span>
                </div>
            </div>

            <div class="grad-border p-1 mt-8 fade-up">
                <div class="aspect-video glass rounded-2xl grid place-items-center text-7xl">🚀</div>
            </div>

            <div class="prose prose-invert mt-10 max-w-none text-slate-300 leading-relaxed space-y-5 fade-up">
                <p>Scaling Laravel is less about magic and more about removing the obvious bottlenecks one at a time. In
                    this article we'll walk through the exact stack that took our checkout API from 800 to 10,000
                    requests per second on the same hardware.</p>

                <h2 class="font-display text-2xl text-white mt-8">1. Switch to Octane</h2>
                <p>Octane keeps your app in memory between requests. The first win is usually a 3–5× throughput increase
                    with zero code changes.</p>
                <pre class="code"><span class="c">// install</span>
                    composer require laravel/octane
                    php artisan octane:install --server=swoole
                    php artisan octane:start --workers=8 --task-workers=4</pre>

                <h2 class="font-display text-2xl text-white mt-8">2. Move hot reads to Redis</h2>
                <p>Cache the 5 endpoints that account for 80% of traffic. Tag them so invalidation is surgical.</p>

                <h2 class="font-display text-2xl text-white mt-8">3. Queue everything you can</h2>
                <p>Emails, webhooks, PDF generation — none of it belongs in the request cycle. Horizon makes scaling
                    workers a one-liner.</p>

                <h2 class="font-display text-2xl text-white mt-8">4. Index like you mean it</h2>
                <p>Run <code>EXPLAIN</code> on your slowest 10 queries. You will be horrified. Add the indexes. Move on
                    with your life.</p>
            </div>

            <!-- Share -->
            <div class="mt-10 flex items-center gap-3 fade-up">
                <span class="text-slate-400 text-sm">Share:</span>
                <a class="glass glass-hover w-10 h-10 grid place-items-center" href="#">𝕏</a>
                <a class="glass glass-hover w-10 h-10 grid place-items-center" href="#">in</a>
                <a class="glass glass-hover w-10 h-10 grid place-items-center" href="#">🔗</a>
            </div>

            <!-- Comments -->
            <section class="mt-14 fade-up">
                <h3 class="font-display text-xl mb-4">Leave a comment</h3>
                <form data-demo class="glass p-6 grid gap-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <input class="input" placeholder="Name" required />
                        <input class="input" placeholder="Email" type="email" required />
                    </div>
                    <textarea class="textarea" placeholder="Drop a transmission..." required></textarea>
                    <button class="btn btn-primary">Post Comment</button>
                    <p data-msg class="hidden text-cyan-300 text-sm"></p>
                </form>
            </section>
        </div>
    </article>

    <!-- Related -->
    <section class="section pt-0">
        <div class="container-x">
            <h2 class="font-display text-2xl mb-6 fade-up">Related Articles</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="blog-details.html" class="project-card glass glass-hover relative fade-up">
                    <div
                        class="aspect-video thumb bg-gradient-to-br from-purple-500/30 to-pink-500/30 grid place-items-center text-5xl">
                        🛰</div>
                    <div class="p-5">
                        <h3 class="font-display text-lg">Designing APIs your future self won't curse</h3>
                    </div>
                </a>
                <a href="blog-details.html" class="project-card glass glass-hover relative fade-up">
                    <div
                        class="aspect-video thumb bg-gradient-to-br from-blue-500/30 to-cyan-500/30 grid place-items-center text-5xl">
                        💬</div>
                    <div class="p-5">
                        <h3 class="font-display text-lg">Laravel Echo + Pusher: a battle-tested stack</h3>
                    </div>
                </a>
                <a href="blog-details.html" class="project-card glass glass-hover relative fade-up">
                    <div
                        class="aspect-video thumb bg-gradient-to-br from-rose-500/30 to-orange-500/30 grid place-items-center text-5xl">
                        🐳</div>
                    <div class="p-5">
                        <h3 class="font-display text-lg">Zero-downtime deploys with Docker + Forge</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
