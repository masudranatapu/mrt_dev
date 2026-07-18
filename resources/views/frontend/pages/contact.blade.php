@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
    <!-- Hero -->
    <section class="pt-36 pb-12">
        <div class="container-x text-center fade-up">
            <span class="eyebrow">Contact</span>
            <h1 class="section-title mt-4">Open a <span class="text-gradient">Comms Channel</span></h1>
            <p class="mt-4 text-slate-400 max-w-xl mx-auto">Tell me about your project — I respond within 24 hours,
                every
                weekday.</p>
        </div>
    </section>
    <!-- Info cards -->
    <section class="pb-6">
        <div class="container-x grid sm:grid-cols-3 gap-6">
            <div class="glass glass-hover p-6 text-center fade-up">
                <div class="text-3xl float-icon">📧</div>
                <h3 class="font-display mt-3">Email</h3>
                <a href="mailto:hello@MRT.dev" class="text-cyan-300 mt-2 inline-block">hello@MRT.dev</a>
            </div>
            <div class="glass glass-hover p-6 text-center fade-up">
                <div class="text-3xl float-icon">📱</div>
                <h3 class="font-display mt-3">Phone</h3>
                <p class="text-cyan-300 mt-2">+33 6 12 34 56 78</p>
            </div>
            <div class="glass glass-hover p-6 text-center fade-up">
                <div class="text-3xl float-icon">📍</div>
                <h3 class="font-display mt-3">Address</h3>
                <p class="text-cyan-300 mt-2">Paris, France · Remote</p>
            </div>
        </div>
    </section>

    <!-- Form + map -->
    <section class="section">
        <div class="container-x grid lg:grid-cols-2 gap-8">
            <div class="grad-border p-1 fade-up">
                <form class="glass rounded-2xl p-8 grid gap-4">
                    <h3 class="font-display text-2xl">Send Transmission</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <input class="input" placeholder="Full name" required />
                        <input class="input" type="email" placeholder="Email" required />
                    </div>
                    <input class="input" placeholder="Subject" />
                    <select class="select">
                        <option>Project type — Laravel Web App</option>
                        <option>API Development</option>
                        <option>Realtime / Chat</option>
                        <option>POS Software</option>
                        <option>Shopify + Laravel</option>
                    </select>
                    <textarea class="textarea" placeholder="Describe your mission..." required></textarea>
                    <button type="submit" class="btn btn-primary">
                        ⚡Launch Message
                    </button>
                    <p data-msg class="hidden text-cyan-300 text-sm"></p>
                </form>
            </div>

            <div class="fade-up">
                <div class="grad-border p-1 h-full">
                    <div class="glass rounded-2xl overflow-hidden h-full min-h-[400px]">
                        <iframe title="Map" class="w-full h-full min-h-[400px] grayscale-[0.4] contrast-125"
                            style="filter: invert(.9) hue-rotate(180deg);"
                            src="https://www.openstreetmap.org/export/embed.html?bbox=2.2945%2C48.8534%2C2.3645%2C48.8834&layer=mapnik"></iframe>
                    </div>
                </div>
                <div class="mt-6 flex gap-3 justify-center">
                    <a href="#" class="glass glass-hover w-12 h-12 grid place-items-center">🐙</a>
                    <a href="#" class="glass glass-hover w-12 h-12 grid place-items-center">in</a>
                    <a href="#" class="glass glass-hover w-12 h-12 grid place-items-center">𝕏</a>
                    <a href="#" class="glass glass-hover w-12 h-12 grid place-items-center">🏀</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
