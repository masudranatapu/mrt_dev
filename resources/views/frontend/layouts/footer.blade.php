<footer class="border-t border-white/5 py-10 mt-10">
    <div class="container-x grid md:grid-cols-3 gap-8 items-start">
        <div>
            <p class="font-display text-xl text-gradient">
                &lt;MRT/&gt; MRT.dev
            </p>
            <p class="text-slate-400 mt-3 text-sm">
                Senior Laravel Developer. Building secure, scalable, futuristic web systems.
            </p>
        </div>
        <div>
            <p class="font-display uppercase text-sm tracking-widest text-slate-300">
                Links
            </p>
            <ul class="mt-3 space-y-2 text-slate-400 text-sm">
                <li>
                    <a href="{{ route('frontend.index') }}" class="hover:text-cyan-300">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.project') }}" class="hover:text-cyan-300">
                        Projects
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.blog') }}" class="hover:text-cyan-300">
                        Blog
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.contact') }}" class="hover:text-cyan-300">
                        Contact
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <p class="font-display uppercase text-sm tracking-widest text-slate-300">Connect</p>
            <div class="mt-3 flex gap-3">
                <a href="#" class="glass glass-hover w-10 h-10 grid place-items-center">
                    🐙
                </a>
                <a href="#" class="glass glass-hover w-10 h-10 grid place-items-center">
                    in
                </a>
                <a href="#" class="glass glass-hover w-10 h-10 grid place-items-center">
                    𝕏
                </a>
                <a href="#" class="glass glass-hover w-10 h-10 grid place-items-center">
                    FB
                </a>
            </div>
        </div>
    </div>
    <p class="text-center text-slate-500 text-xs mt-10">
        © {{ date('Y') }} Masud Rana Tapu. Engineered with ⚡ Software Development.
    </p>
</footer>
