@extends('frontend.layouts.app')

@section('title', 'Projects')

@section('content')


    <!-- Hero -->
    <section class="pt-36 pb-12">
        <div class="container-x text-center fade-up">
            <span class="eyebrow">Portfolio</span>
            <h1 class="section-title mt-4">Selected <span class="text-gradient">Projects</span></h1>
            <p class="mt-4 text-slate-400 max-w-xl mx-auto">A grid of recent missions — filter by category to scan the fleet.
            </p>
        </div>
    </section>

    <!-- Filters -->
    <section class="pb-6">
        <div class="container-x flex flex-wrap justify-center gap-3 fade-up">
            <button data-filter="all" class="btn btn-ghost active-filter">All</button>
            <button data-filter="laravel" class="btn btn-ghost">Laravel</button>
            <button data-filter="api" class="btn btn-ghost">API</button>
            <button data-filter="realtime" class="btn btn-ghost">Realtime</button>
            <button data-filter="pos" class="btn btn-ghost">POS</button>
            <button data-filter="shopify" class="btn btn-ghost">Shopify</button>
        </div>
    </section>

    <!-- Grid -->
    <section class="section pt-6">
        <div class="container-x grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- card -->
            <article data-cat="laravel pos" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-[4/3] thumb bg-gradient-to-br from-cyan-500/30 to-purple-600/30 grid place-items-center text-6xl">
                    🧾</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">Laravel · Vue · MySQL</p>
                    <h3 class="font-display text-lg mt-1">NebulaPOS</h3>
                    <p class="text-sm text-slate-400 mt-2">Cloud POS for multi-branch retail with offline-first sync.</p>
                    <a href="project-details.html" class="btn btn-ghost mt-4 w-full">View Details</a>
                </div>
            </article>
            <article data-cat="realtime api" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-[4/3] thumb bg-gradient-to-br from-purple-500/30 to-pink-500/30 grid place-items-center text-6xl">
                    💬</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">Pusher · Echo · Redis</p>
                    <h3 class="font-display text-lg mt-1">PulseChat</h3>
                    <p class="text-sm text-slate-400 mt-2">Realtime team messaging with E2E encryption.</p>
                    <a href="project-details.html" class="btn btn-ghost mt-4 w-full">View Details</a>
                </div>
            </article>
            <article data-cat="shopify laravel" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-[4/3] thumb bg-gradient-to-br from-blue-500/30 to-cyan-500/30 grid place-items-center text-6xl">
                    🛒</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">Shopify · Laravel</p>
                    <h3 class="font-display text-lg mt-1">OrbitSync</h3>
                    <p class="text-sm text-slate-400 mt-2">Inventory bridge between Shopify and Laravel ERP.</p>
                    <a href="project-details.html" class="btn btn-ghost mt-4 w-full">View Details</a>
                </div>
            </article>
            <article data-cat="api laravel" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-[4/3] thumb bg-gradient-to-br from-fuchsia-500/30 to-indigo-500/30 grid place-items-center text-6xl">
                    🛰</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">REST · OAuth · OpenAPI</p>
                    <h3 class="font-display text-lg mt-1">Quantum API Gateway</h3>
                    <p class="text-sm text-slate-400 mt-2">High-throughput API gateway with rate limiting & analytics.</p>
                    <a href="project-details.html" class="btn btn-ghost mt-4 w-full">View Details</a>
                </div>
            </article>
            <article data-cat="pos laravel" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-[4/3] thumb bg-gradient-to-br from-emerald-500/30 to-cyan-500/30 grid place-items-center text-6xl">
                    🍔</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">Laravel · Inertia · Vue</p>
                    <h3 class="font-display text-lg mt-1">ForkFleet POS</h3>
                    <p class="text-sm text-slate-400 mt-2">Restaurant POS with KDS, table mapping & QR ordering.</p>
                    <a href="project-details.html" class="btn btn-ghost mt-4 w-full">View Details</a>
                </div>
            </article>
            <article data-cat="realtime" class="project-card glass glass-hover relative fade-up">
                <div
                    class="aspect-[4/3] thumb bg-gradient-to-br from-rose-500/30 to-orange-500/30 grid place-items-center text-6xl">
                    📡</div>
                <div class="p-5">
                    <p class="text-xs uppercase tracking-widest text-cyan-300">WebSockets · Vue</p>
                    <h3 class="font-display text-lg mt-1">SignalDeck</h3>
                    <p class="text-sm text-slate-400 mt-2">Live ops dashboard streaming 10k+ events/sec.</p>
                    <a href="project-details.html" class="btn btn-ghost mt-4 w-full">View Details</a>
                </div>
            </article>
        </div>
    </section>

@endsection

@push('script')
@endpush
