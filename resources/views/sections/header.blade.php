@php
    $phone = '07555 641 081';
    $phoneHref = preg_replace('/\s+/', '', $phone);
    $email = 'tomasz@emove-fs.co.uk';
@endphp

<header x-data="headerMenu()" @keydown.escape.window="closeAll()" class="relative z-50">
    {{-- Top bar --}}
    <div class="bg-[#6b5a2c] text-[#d2bb7b]">
        <div class="mx-auto flex max-w-350 items-center justify-between px-4 py-3 md:px-6 lg:px-10">
            <div class="flex flex-wrap items-center gap-4 md:gap-8">
                <a href="tel:{{ $phoneHref }}"
                    class="inline-flex items-center gap-2 text-[15px] transition hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.75 w-3.75" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M2.003 5.884l3.172-.793a1 1 0 011.11.417l1.518 2.53a1 1 0 01-.241 1.287l-1.547 1.236a11.042 11.042 0 005.292 5.292l1.236-1.547a1 1 0 011.287-.241l2.53 1.518a1 1 0 01.417 1.11l-.793 3.172a1 1 0 01-.97.757C7.477 20 0 12.523 0 3.97a1 1 0 01.757-.97h1.246z" />
                    </svg>
                    <span>{{ $phone }}</span>
                </a>

                <a href="mailto:{{ $email }}"
                    class="inline-flex items-center gap-2 text-[15px] transition hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.75 w-3.75" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path d="M2.94 6.34A2 2 0 014.5 5.5h11a2 2 0 011.56.84L10 10.88 2.94 6.34z" />
                        <path d="M18 8.12l-7.46 4.79a1 1 0 01-1.08 0L2 8.12V13.5a2 2 0 002 2h12a2 2 0 002-2V8.12z" />
                    </svg>
                    <span>{{ $email }}</span>
                </a>
            </div>

            <div class="hidden items-center gap-5 md:flex">
                <a href="#" aria-label="Facebook" class="text-[#d2bb7b] transition hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.9.3-1.6 1.6-1.6h1.7V4.8c-.3 0-1.3-.1-2.5-.1-2.5 0-4.3 1.5-4.3 4.4V11H7v3h2.5v8h4z" />
                    </svg>
                </a>

                <a href="#" aria-label="Instagram" class="text-[#d2bb7b] transition hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2.2A2.8 2.8 0 004.2 7v10A2.8 2.8 0 007 19.8h10a2.8 2.8 0 002.8-2.8V7A2.8 2.8 0 0017 4.2H7zm10.25 1.65a.85.85 0 110 1.7.85.85 0 010-1.7zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2.2A2.8 2.8 0 1014.8 12 2.8 2.8 0 0012 9.2z" />
                    </svg>
                </a>

                <a href="#" aria-label="LinkedIn" class="text-[#d2bb7b] transition hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M6.94 8.5H3.56V20h3.38V8.5zM5.25 3A2 2 0 103 5a2 2 0 002.25-2zM20.44 13.03c0-3.44-1.84-5.03-4.29-5.03-1.98 0-2.87 1.09-3.36 1.85V8.5H9.41c.04.89 0 11.5 0 11.5h3.38v-6.42c0-.34.02-.68.13-.92.27-.68.87-1.39 1.89-1.39 1.33 0 1.86 1.01 1.86 2.49V20h3.38z" />
                    </svg>
                </a>

                <div class="flex items-center gap-2 text-[15px] text-[#e8e0c6]">
                    <span>🇬🇧</span>
                    <span>eng</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Main nav --}}
    <div class="header-gradient border-t border-[rgba(255,255,255,0.08)]">
        <div class="mx-auto flex max-w-350 items-center justify-between px-4 py-6 md:px-6 lg:px-10">
            {{-- Logo --}}
            <a href="{{ home_url('/') }}" class="shrink-0">
                <div
                    class="flex h-16 w-19.5 items-center justify-center border border-[rgba(214,190,126,0.65)] text-[#f4f0e2]">
                    <div class="flex items-center text-[28px] font-serif leading-none tracking-[0.08em]">
                        <span>E</span>
                        <span class="mx-2 inline-block h-10.5 w-px bg-[rgba(214,190,126,0.65)]"></span>
                        <span>M</span>
                    </div>
                </div>
            </a>

            {{-- Desktop nav --}}
            <div class="hidden lg:block">
                @if (has_nav_menu('primary_navigation'))
                    {!! wp_nav_menu([
                        'theme_location' => 'primary_navigation',
                        'menu_class' => 'desktop-menu flex items-center gap-8 xl:gap-10',
                        'container' => false,
                        'fallback_cb' => false,
                        'echo' => false,
                    ]) !!}
                @endif
            </div>

            {{-- Mobile toggle --}}
            <button type="button" @click="toggleMobile()"
                class="inline-flex h-11 w-11 items-center justify-center text-white lg:hidden" aria-label="Toggle menu"
                :aria-expanded="mobileOpen ? 'true' : 'false'">
                <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>

                <svg x-show="mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu panel --}}
    <div x-show="mobileOpen" x-cloak x-transition.opacity class="lg:hidden">
        <div class="border-t border-[rgba(255,255,255,0.08)] bg-[#4b3a12] px-4 py-5 md:px-6">
            @if (has_nav_menu('primary_navigation'))
                {!! wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'menu_class' => 'mobile-menu',
                    'container' => false,
                    'fallback_cb' => false,
                    'echo' => false,
                ]) !!}
            @endif

            <div class="mt-6 flex items-center gap-5 border-t border-[rgba(214,190,126,0.2)] pt-5 text-[#d2bb7b]">
                <a href="#" aria-label="Facebook" class="transition hover:text-white">f</a>
                <a href="#" aria-label="Instagram" class="transition hover:text-white">◎</a>
                <a href="#" aria-label="LinkedIn" class="transition hover:text-white">in</a>
            </div>
        </div>
    </div>
</header>
