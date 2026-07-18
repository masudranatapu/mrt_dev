<!-- Background -->
<div class="bg-grid"></div>
<div class="bg-orb one"></div>
<div class="bg-orb two"></div>
<!-- Navbar -->
<header id="navbar" class="fixed top-0 inset-x-0 z-50 transition-all duration-300">
    <nav class="container-x flex items-center justify-between py-4">
        <a href="{{ route('frontend.index') }}" class="flex items-center gap-2 font-display font-bold text-lg">
            <span class="text-gradient">
                &lt;MRT/&gt;
            </span>
            <span class="hidden sm:inline text-white">
                MRT.dev
            </span>
        </a>
        <ul class="hidden lg:flex items-center gap-8 text-sm font-display tracking-widest uppercase">
            <li>
                <a href="{{ route('frontend.index') }}" class="nav-link active">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('frontend.project') }}" class="nav-link">
                    Projects
                </a>
            </li>
            <li>
                <a href="{{ route('frontend.blog') }}" class="nav-link">
                    Blog
                </a>
            </li>
            <li>
                <a href="{{ route('frontend.contact') }}" class="nav-link">
                    Contact
                </a>
            </li>
        </ul>
        <div class="flex items-center gap-3">
            <a href="{{ route('frontend.contact') }}" class="btn btn-primary hire-sticky hidden sm:inline-flex">
                Hire Me
            </a>
            <button id="menuBtn" class="lg:hidden text-white p-2" aria-label="menu">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M3 6h18M3 12h18M3 18h18" />
                </svg>
            </button>
        </div>
    </nav>
    <div id="mobileMenu" class="hidden lg:hidden glass mx-4 mb-4 p-4">
        <ul class="flex flex-col gap-3 font-display tracking-widest uppercase text-sm">
            <li>
                <a href="{{ route('frontend.index') }}" class="nav-link active">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('frontend.project') }}" class="nav-link">
                    Projects
                </a>
            </li>
            <li>
                <a href="{{ route('frontend.blog') }}" class="nav-link">
                    Blog
                </a>
            </li>
            <li>
                <a href="{{ route('frontend.contact') }}" class="nav-link">
                    Contact
                </a>
            </li>
            <li>
                <a href="{{ route('frontend.contact') }}" class="btn btn-primary w-full mt-2">
                    Hire Me
                </a>
            </li>
        </ul>
    </div>
</header>
