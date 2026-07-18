@extends('frontend.layouts.app')

@section('title', 'Project Details')

@section('content')
    <!-- Hero banner -->
    <section class="pt-32 pb-12">
        <div class="container-x">
            <div class="grad-border p-1 fade-up">
                <div class="glass rounded-2xl overflow-hidden">
                    <div
                        class="aspect-[16/7] bg-gradient-to-br from-cyan-500/30 via-purple-600/30 to-pink-500/30 grid place-items-center text-8xl">
                        🧾</div>
                    <div class="p-8 md:p-10">
                        <span class="eyebrow">Case Study</span>
                        <h1 class="section-title mt-3">Nebula<span class="text-gradient">POS</span> — Cloud Retail Suite</h1>
                        <p class="text-slate-400 mt-3 max-w-2xl">A multi-branch cloud POS built for a 200+ store retail
                            chain, processing 2M+ daily transactions with offline-first sync.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="#" class="btn btn-primary">🌐 Live Demo</a>
                            <a href="#" class="btn btn-ghost">🐙 GitHub</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Overview + meta -->
    <section class="section pt-0">
        <div class="container-x grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 fade-up">
                <h2 class="font-display text-2xl">Project Overview</h2>
                <p class="mt-4 text-slate-300 leading-relaxed">
                    RetailNova needed a unified POS that could survive flaky in-store networks while syncing inventory and
                    sales to a central HQ in real time. We engineered a Laravel back-end with a Vue/Inertia front-end, a
                    Redis-backed event bus, and a service-worker-powered offline mode. The result: 99.97% uptime, 3× faster
                    checkout, and a sales-team UI engineers actually liked maintaining.
                </p>
                <h3 class="font-display text-xl mt-8">Key Features</h3>
                <ul class="mt-4 grid sm:grid-cols-2 gap-3 text-slate-300">
                    <li>⚡ Offline-first sync engine</li>
                    <li>🧾 Receipt printing & cash drawer</li>
                    <li>📦 Multi-warehouse inventory</li>
                    <li>👥 Role-based access (RBAC)</li>
                    <li>📊 Real-time analytics dashboard</li>
                    <li>💳 Stripe + local terminal support</li>
                </ul>
                <h3 class="font-display text-xl mt-8">Technology Used</h3>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="glass px-3 py-1 text-sm">Laravel 10</span>
                    <span class="glass px-3 py-1 text-sm">Vue 3</span>
                    <span class="glass px-3 py-1 text-sm">Inertia</span>
                    <span class="glass px-3 py-1 text-sm">MySQL</span>
                    <span class="glass px-3 py-1 text-sm">Redis</span>
                    <span class="glass px-3 py-1 text-sm">Pusher</span>
                    <span class="glass px-3 py-1 text-sm">Docker</span>
                    <span class="glass px-3 py-1 text-sm">AWS</span>
                </div>
            </div>

            <aside class="glass p-6 h-fit fade-up">
                <h3 class="font-display text-lg">Client</h3>
                <p class="text-slate-300 mt-1">RetailNova Group</p>
                <hr class="border-white/10 my-4" />
                <h3 class="font-display text-lg">Industry</h3>
                <p class="text-slate-300 mt-1">Retail · Multi-store</p>
                <hr class="border-white/10 my-4" />
                <h3 class="font-display text-lg">Timeline</h3>
                <p class="text-slate-300 mt-1">2023 — 6 months</p>
                <hr class="border-white/10 my-4" />
                <h3 class="font-display text-lg">Role</h3>
                <p class="text-slate-300 mt-1">Lead Backend Engineer</p>
            </aside>
        </div>
    </section>

    <!-- Gallery -->
    <section class="section pt-0">
        <div class="container-x">
            <h2 class="font-display text-2xl mb-6 fade-up">Screenshots</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="glass glass-hover aspect-video grid place-items-center text-5xl fade-up">📊</div>
                <div class="glass glass-hover aspect-video grid place-items-center text-5xl fade-up">🧾</div>
                <div class="glass glass-hover aspect-video grid place-items-center text-5xl fade-up">📦</div>
                <div class="glass glass-hover aspect-video grid place-items-center text-5xl fade-up">💳</div>
                <div class="glass glass-hover aspect-video grid place-items-center text-5xl fade-up">📱</div>
                <div class="glass glass-hover aspect-video grid place-items-center text-5xl fade-up">⚙️</div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
