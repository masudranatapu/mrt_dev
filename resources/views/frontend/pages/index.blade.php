@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero-section relative pt-24 pb-16 sm:pt-28 sm:pb-20 lg:pt-44 lg:pb-32 overflow-hidden">
        <canvas id="particles" class="absolute inset-0 w-full h-full opacity-60"></canvas>
        <div class="container-x relative grid lg:grid-cols-12 gap-8 lg:gap-10 items-center">
            <div class="hero-copy lg:col-span-7 fade-up">
                <span class="eyebrow"><span class="pulse-dot inline-block align-middle mr-2"></span>Available for new
                    missions</span>
                <h1 class="mt-5 sm:mt-6 font-display font-black text-2xl sm:text-2xl md:text-2xl lg:text-5xl leading-tight">
                    Hi, I'm <span class="text-gradient text-glow">Masud Rana Tapu</span><br />
                    Senior <span class="text-gradient">Laravel</span> Developer
                </h1>
                <p class="mt-5 sm:mt-6 text-base sm:text-lg text-slate-300 max-w-xl">
                    I architect scalable PHP/Laravel back-ends, lightning-fast REST &amp; GraphQL APIs, real-time chat
                    platforms, POS systems and Shopify/Laravel storefronts — engineered like spacecraft, shipped like
                    clockwork.
                </p>
                <div class="mt-7 sm:mt-8 flex flex-wrap gap-3 sm:gap-4">
                    <a href="contact.html" class="btn btn-primary">⚡ Hire Me</a>
                    <a href="#" class="btn btn-ghost">⬇ Download CV</a>
                </div>
                <div class="hero-stats mt-8 sm:mt-10 flex items-center gap-4 sm:gap-6 text-slate-400 text-sm">
                    <div>
                        <span class="text-white font-bold text-2xl font-display">
                            7+
                        </span>
                        <br />
                        Years
                    </div>
                    <div>
                        <span class="text-white font-bold text-2xl font-display">
                            120+
                        </span>
                        <br />
                        Projects
                    </div>
                    <div>
                        <span class="text-white font-bold text-2xl font-display">
                            60+
                        </span>
                        <br />
                        Clients
                    </div>
                </div>
            </div>
            <div class="hero-card lg:col-span-5 fade-up">
                <div class="grad-border p-1">
                    <div class="glass hero-slider-card p-4 sm:p-6 rounded-2xl">
                        <div class="code-titlebar flex items-center gap-2 text-xs text-slate-400 font-mono mb-3">
                            <span class="w-3 h-3 rounded-full bg-red-500"></span>
                            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                            <span class="w-3 h-3 rounded-full bg-green-500"></span>
                            <span class="ml-2">~/alex/profile.js</span>
                        </div>
                        <div id="heroCodeSlider" class="hero-code-slider">
                            <pre data-hero-slide class="code hero-code"><span class="line"><span class="ln">1</span><span class="c">// who is this guy?</span></span>
                                <span class="line"><span class="ln">2</span><span class="k">const</span> <span class="v">alex</span> <span class="p">=</span> <span class="p">{</span></span>
                                <span class="line"><span class="ln">3</span>  <span class="key">role</span><span class="p">:</span> <span class="s">'Senior Laravel Engineer'</span><span class="p">,</span></span>
                                <span class="line"><span class="ln">4</span>  <span class="key">stack</span><span class="p">:</span> <span class="p">[</span><span class="s">'Laravel'</span><span class="p">,</span> <span class="s">'PHP 8'</span><span class="p">,</span> <span class="s">'Vue'</span><span class="p">,</span> <span class="s">'MySQL'</span><span class="p">]</span><span class="p">,</span></span>
                                <span class="line"><span class="ln">5</span>  <span class="key">focus</span><span class="p">:</span> <span class="s">'APIs · Realtime · POS · Shopify'</span><span class="p">,</span></span>
                                <span class="line"><span class="ln">6</span>  <span class="key">status</span><span class="p">:</span> <span class="s">'open to opportunities'</span></span>
                                <span class="line"><span class="ln">7</span><span class="p">}</span><span class="p">;</span></span></pre>
                            <pre data-hero-slide class="code hero-code hidden"><span class="line"><span class="ln">1</span><span class="c">// current mission</span></span>
                                <span class="line"><span class="ln">2</span><span class="k">const</span> <span class="v">delivery</span> <span class="p">=</span> <span class="p">{</span></span>
                                <span class="line"><span class="ln">3</span>  <span class="key">backend</span><span class="p">:</span> <span class="s">'Laravel + Domain Driven Design'</span><span class="p">,</span></span>
                                <span class="line"><span class="ln">4</span>  <span class="key">api</span><span class="p">:</span> <span class="s">'REST / GraphQL with tests'</span><span class="p">,</span></span>
                                <span class="line"><span class="ln">5</span>  <span class="key">infra</span><span class="p">:</span> <span class="s">'CI/CD · Docker · AWS'</span><span class="p">,</span></span>
                                <span class="line"><span class="ln">6</span>  <span class="key">result</span><span class="p">:</span> <span class="s">'fast shipping, stable systems'</span></span>
                                <span class="line"><span class="ln">7</span><span class="p">}</span><span class="p">;</span></span></pre>
                            <pre data-hero-slide class="code hero-code hidden"><span class="line"><span class="ln">1</span><span class="c">// what clients get</span></span>
                                <span class="line"><span class="ln">2</span><span class="k">const</span> <span class="v">impact</span> <span class="p">=</span> <span class="p">[</span></span>
                                <span class="line"><span class="ln">3</span>  <span class="s">'Scalable APIs for high traffic'</span><span class="p">,</span></span>
                                <span class="line"><span class="ln">4</span>  <span class="s">'Realtime chat and notifications'</span><span class="p">,</span></span>
                                <span class="line"><span class="ln">5</span>  <span class="s">'POS and Shopify integrations'</span><span class="p">,</span></span>
                                <span class="line"><span class="ln">6</span>  <span class="s">'Clean code with long-term support'</span></span>
                                <span class="line"><span class="ln">7</span><span class="p">]</span><span class="p">;</span></span>
                            </pre>
                        </div>
                        <div class="hero-slider-controls mt-3">
                            <button id="heroCodePrev" class="hero-slider-btn" aria-label="Previous code slide">←</button>
                            <div class="hero-slider-dots" aria-label="Hero code slides">
                                <button class="hero-dot active" data-hero-dot="0" aria-label="Go to slide 1"></button>
                                <button class="hero-dot" data-hero-dot="1" aria-label="Go to slide 2"></button>
                                <button class="hero-dot" data-hero-dot="2" aria-label="Go to slide 3"></button>
                            </div>
                            <button id="heroCodeNext" class="hero-slider-btn" aria-label="Next code slide">→</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="section">
        <div class="container-x grid lg:grid-cols-2 gap-12 items-center">
            <div class="fade-up">
                <span class="eyebrow">About</span>
                <h2 class="section-title mt-4">Engineer by craft. <span class="text-gradient">Architect</span> by
                    mission.</h2>
                <p class="mt-6 text-slate-300 leading-relaxed">
                    With 7+ years engineering production-grade Laravel applications, I help startups and enterprises
                    ship resilient back-ends, secure APIs, and delightful product experiences. From real-time chat at
                    scale to multi-tenant POS deployments, I treat every codebase like mission-critical infrastructure.
                </p>
                <ul class="mt-6 grid sm:grid-cols-2 gap-3 text-slate-300">
                    <li>⚡ Clean, testable, SOLID code</li>
                    <li>🛰 Real-time with WebSockets/Pusher</li>
                    <li>🛒 Shopify + Laravel integrations</li>
                    <li>🧪 PHPUnit + CI/CD pipelines</li>
                </ul>
            </div>
            <div class="fade-up grad-border p-1">
                <div class="glass p-8 rounded-2xl">
                    <h3 class="font-display text-xl mb-4">Quick Facts</h3>
                    <dl class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <dt class="text-slate-400">Location</dt>
                            <dd class="text-white">Remote · GMT+1</dd>
                        </div>
                        <div>
                            <dt class="text-slate-400">Experience</dt>
                            <dd class="text-white">7+ years</dd>
                        </div>
                        <div>
                            <dt class="text-slate-400">Languages</dt>
                            <dd class="text-white">EN · FR</dd>
                        </div>
                        <div>
                            <dt class="text-slate-400">Email</dt>
                            <dd class="text-white">hello@MRT.dev</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills -->
    <section class="section" data-skills>
        <div class="container-x">
            <div class="text-center max-w-2xl mx-auto fade-up">
                <span class="eyebrow">Skills</span>
                <h2 class="section-title mt-4">Combat-Ready <span class="text-gradient">Stack</span></h2>
            </div>
            <div class="mt-12 grid md:grid-cols-2 gap-x-12 gap-y-6 fade-up">
                <!-- skill row -->
                <div>
                    <div class="flex justify-between mb-2"><span>Laravel / PHP</span><span
                            class="text-cyan-300">95%</span></div>
                    <div class="skill-bar"><span data-val="95"></span></div>
                </div>
                <div>
                    <div class="flex justify-between mb-2"><span>REST & GraphQL APIs</span><span
                            class="text-cyan-300">92%</span></div>
                    <div class="skill-bar"><span data-val="92"></span></div>
                </div>
                <div>
                    <div class="flex justify-between mb-2"><span>Vue.js / Inertia</span><span
                            class="text-cyan-300">88%</span></div>
                    <div class="skill-bar"><span data-val="88"></span></div>
                </div>
                <div>
                    <div class="flex justify-between mb-2"><span>MySQL / PostgreSQL</span><span
                            class="text-cyan-300">90%</span></div>
                    <div class="skill-bar"><span data-val="90"></span></div>
                </div>
                <div>
                    <div class="flex justify-between mb-2"><span>Realtime (Pusher / WS)</span><span
                            class="text-cyan-300">85%</span></div>
                    <div class="skill-bar"><span data-val="85"></span></div>
                </div>
                <div>
                    <div class="flex justify-between mb-2"><span>Shopify Apps</span><span class="text-cyan-300">82%</span>
                    </div>
                    <div class="skill-bar"><span data-val="82"></span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="section">
        <div class="container-x">
            <div class="text-center max-w-2xl mx-auto fade-up">
                <span class="eyebrow">Services</span>
                <h2 class="section-title mt-4">What I <span class="text-gradient">Deploy</span></h2>
            </div>
            <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- card template -->
                <div class="glass glass-hover p-7 fade-up">
                    <div class="text-3xl float-icon">🚀</div>
                    <h3 class="mt-4 font-display text-xl">Laravel Web Apps</h3>
                    <p class="mt-2 text-slate-400 text-sm">Custom dashboards, SaaS platforms, multi-tenant systems
                        engineered for scale and security.</p>
                </div>
                <div class="glass glass-hover p-7 fade-up">
                    <div class="text-3xl float-icon">🛰</div>
                    <h3 class="mt-4 font-display text-xl">API Development</h3>
                    <p class="mt-2 text-slate-400 text-sm">REST/GraphQL APIs with OAuth, rate limiting, versioning and
                        full OpenAPI documentation.</p>
                </div>
                <div class="glass glass-hover p-7 fade-up">
                    <div class="text-3xl float-icon">💬</div>
                    <h3 class="mt-4 font-display text-xl">Realtime Chat</h3>
                    <p class="mt-2 text-slate-400 text-sm">Low-latency chat & notifications using WebSockets, Pusher,
                        Laravel Echo and Redis.</p>
                </div>
                <div class="glass glass-hover p-7 fade-up">
                    <div class="text-3xl float-icon">🧾</div>
                    <h3 class="mt-4 font-display text-xl">POS Software</h3>
                    <p class="mt-2 text-slate-400 text-sm">Cloud POS for retail & restaurants — inventory, invoicing,
                        receipt printing, offline mode.</p>
                </div>
                <div class="glass glass-hover p-7 fade-up">
                    <div class="text-3xl float-icon">🛒</div>
                    <h3 class="mt-4 font-display text-xl">Shopify + Laravel</h3>
                    <p class="mt-2 text-slate-400 text-sm">Custom Shopify apps, headless storefronts and ERP/inventory
                        sync built on Laravel.</p>
                </div>
                <div class="glass glass-hover p-7 fade-up">
                    <div class="text-3xl float-icon">⚙️</div>
                    <h3 class="mt-4 font-display text-xl">DevOps & Deployment</h3>
                    <p class="mt-2 text-slate-400 text-sm">CI/CD, Docker, zero-downtime deploys with Forge, Vapor, AWS
                        and Cloudflare.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="section">
        <div class="container-x">
            <div class="flex flex-wrap items-end justify-between gap-6 fade-up">
                <div>
                    <span class="eyebrow">Featured</span>
                    <h2 class="section-title mt-4">Recent <span class="text-gradient">Missions</span></h2>
                </div>
                <a href="projects.html" class="btn btn-ghost">All Projects →</a>
            </div>
            <div class="mt-12 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="project-details.html" class="project-card glass glass-hover relative block fade-up">
                    <div
                        class="aspect-[4/3] thumb bg-gradient-to-br from-cyan-500/30 to-purple-600/30 flex items-center justify-center text-6xl">
                        🧾</div>
                    <div class="overlay"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <p class="text-xs uppercase tracking-widest text-cyan-300">POS · Laravel · Vue</p>
                        <h3 class="font-display text-lg mt-1">NebulaPOS — Cloud Retail Suite</h3>
                    </div>
                </a>
                <a href="project-details.html" class="project-card glass glass-hover relative block fade-up">
                    <div
                        class="aspect-[4/3] thumb bg-gradient-to-br from-purple-500/30 to-pink-500/30 flex items-center justify-center text-6xl">
                        💬</div>
                    <div class="overlay"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <p class="text-xs uppercase tracking-widest text-cyan-300">Realtime · WebSockets</p>
                        <h3 class="font-display text-lg mt-1">PulseChat — Realtime Messaging</h3>
                    </div>
                </a>
                <a href="project-details.html" class="project-card glass glass-hover relative block fade-up">
                    <div
                        class="aspect-[4/3] thumb bg-gradient-to-br from-blue-500/30 to-cyan-500/30 flex items-center justify-center text-6xl">
                        🛒</div>
                    <div class="overlay"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <p class="text-xs uppercase tracking-widest text-cyan-300">Shopify · Laravel</p>
                        <h3 class="font-display text-lg mt-1">OrbitSync — Inventory Bridge</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section">
        <div class="container-x">
            <div class="text-center max-w-2xl mx-auto fade-up">
                <span class="eyebrow">Testimonials</span>
                <h2 class="section-title mt-4">Voices from the <span class="text-gradient">Fleet</span></h2>
            </div>
            <div id="testiSlider" class="mt-12 max-w-3xl mx-auto glass p-8 md:p-12 grad-border fade-up">
                <div data-slide>
                    <p class="text-lg md:text-xl text-slate-200 italic">"Alex rebuilt our POS back-end in 6 weeks.
                        Order
                        throughput tripled, and we finally sleep at night."</p>
                    <div class="mt-6 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-cyan-400 to-purple-500"></div>
                        <div>
                            <p class="font-display">Maya Chen</p>
                            <p class="text-sm text-slate-400">CTO, RetailNova</p>
                        </div>
                    </div>
                </div>
                <div data-slide class="hidden">
                    <p class="text-lg md:text-xl text-slate-200 italic">"Top 1% Laravel engineer. Clean code, brutal
                        performance, zero drama."</p>
                    <div class="mt-6 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-pink-500"></div>
                        <div>
                            <p class="font-display">Daniel Park</p>
                            <p class="text-sm text-slate-400">Founder, PulseChat</p>
                        </div>
                    </div>
                </div>
                <div data-slide class="hidden">
                    <p class="text-lg md:text-xl text-slate-200 italic">"Our Shopify ↔ ERP sync was a nightmare. Alex
                        made it boring — in the best possible way."</p>
                    <div class="mt-6 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-cyan-500"></div>
                        <div>
                            <p class="font-display">Sara Müller</p>
                            <p class="text-sm text-slate-400">Head of Ops, OrbitGoods</p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-center gap-3">
                    <button id="testiPrev" class="btn btn-ghost !py-2 !px-4">←</button>
                    <button id="testiNext" class="btn btn-ghost !py-2 !px-4">→</button>
                </div>
            </div>

            <!-- Review form -->
            <div class="mt-12 max-w-2xl mx-auto glass p-8 fade-up">
                <h3 class="font-display text-xl mb-4">Leave a Review</h3>
                <form data-demo class="grid gap-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <input class="input" placeholder="Your name" required />
                        <input class="input" placeholder="Company / Role" />
                    </div>
                    <select class="select">
                        <option>⭐⭐⭐⭐⭐ Excellent</option>
                        <option>⭐⭐⭐⭐ Great</option>
                        <option>⭐⭐⭐ Good</option>
                    </select>
                    <textarea class="textarea" placeholder="Share your experience..." required></textarea>
                    <button class="btn btn-primary">Transmit Review</button>
                    <p data-msg class="hidden text-cyan-300 text-sm"></p>
                </form>
            </div>
        </div>
    </section>

    <!-- Experience Timeline -->
    <section class="section">
        <div class="container-x grid lg:grid-cols-2 gap-12">
            <div class="fade-up">
                <span class="eyebrow">Experience</span>
                <h2 class="section-title mt-4">Mission <span class="text-gradient">Log</span></h2>
                <p class="mt-4 text-slate-400">A snapshot of where I've shipped value and led teams.</p>
            </div>
            <ol class="timeline fade-up">
                <li class="timeline-item">
                    <p class="text-cyan-300 text-sm font-mono">2023 — Present</p>
                    <h3 class="font-display text-xl mt-1">Lead Laravel Engineer · OrbitGoods</h3>
                    <p class="text-slate-400 mt-2">Built Shopify↔Laravel inventory bridge serving 800+ stores.</p>
                </li>
                <li class="timeline-item">
                    <p class="text-cyan-300 text-sm font-mono">2020 — 2023</p>
                    <h3 class="font-display text-xl mt-1">Senior Backend Engineer · RetailNova</h3>
                    <p class="text-slate-400 mt-2">Architected cloud POS handling 2M+ daily transactions.</p>
                </li>
                <li class="timeline-item">
                    <p class="text-cyan-300 text-sm font-mono">2018 — 2020</p>
                    <h3 class="font-display text-xl mt-1">Full-Stack Developer · Bytewave Studio</h3>
                    <p class="text-slate-400 mt-2">Delivered 40+ Laravel/Vue client projects on time and on spec.</p>
                </li>
            </ol>
        </div>
    </section>

    <!-- Stats -->
    <section class="section">
        <div class="container-x grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="glass p-8 text-center fade-up">
                <p class="font-display text-4xl text-gradient" data-count="120">0</p>
                <p class="text-slate-400 mt-2">Projects Shipped</p>
            </div>
            <div class="glass p-8 text-center fade-up">
                <p class="font-display text-4xl text-gradient" data-count="60">0</p>
                <p class="text-slate-400 mt-2">Happy Clients</p>
            </div>
            <div class="glass p-8 text-center fade-up">
                <p class="font-display text-4xl text-gradient" data-count="7">0</p>
                <p class="text-slate-400 mt-2">Years Experience</p>
            </div>
            <div class="glass p-8 text-center fade-up">
                <p class="font-display text-4xl text-gradient" data-count="38">0</p>
                <p class="text-slate-400 mt-2">Awards & Mentions</p>
            </div>
        </div>
    </section>

    <!-- Tech stack marquee -->
    <section class="section">
        <div class="container-x text-center fade-up">
            <span class="eyebrow">
                Tech Stack
            </span>
            <h2 class="section-title mt-4">
                Weapons of
                <span class="text-gradient">Choice</span>
            </h2>
        </div>
        <div class="marquee mt-10">
            <div class="marquee-track text-2xl md:text-3xl font-display text-slate-300">
                <span>Laravel</span>
                <span>PHP 8</span>
                <span>Vue.js</span>
                <span>MySQL</span>
                <span>Redis</span>
                <span>Pusher</span>
                <span>Inertia</span>
                <span>Tailwind</span>
                <span>Docker</span>
                <span>AWS</span>
                <span>Shopify</span>
                <span>Stripe</span>
                <span>Laravel</span>
                <span>PHP8</span>
                <span>Vue.js</span>
                <span>MySQL</span>
                <span>Redis</span>
                <span>Pusher</span>
                <span>Inertia</span>
                <span>Tailwind</span>
                <span>Docker</span>
                <span>AWS</span>
                <span>Shopify</span>
                <span>Stripe</span>
            </div>
        </div>
    </section>

    <!-- Contact preview -->
    <section class="section">
        <div class="container-x">
            <div class="grad-border p-1 fade-up">
                <div class="glass p-10 md:p-14 text-center rounded-2xl">
                    <h2 class="section-title">
                        Ready to launch your next <span class="text-gradient">mission?</span>
                    </h2>
                    <p class="mt-4 text-slate-400 max-w-xl mx-auto">
                        Tell me about your idea — I'll reply with a roadmap, timeline and quote within 24 hours.
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a href="{{ route('frontend.contact') }}" class="btn btn-primary">
                            Start a Project
                        </a>
                        <a href="masudranatapu@gmail.com" class="btn btn-ghost">
                            Hello@mrt.dev
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
