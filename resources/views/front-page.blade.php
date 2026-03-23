{{--
  Template Name: Front Page
--}}

@extends('layouts.app')
@php
    $phone = $main['contact']['phone'] ?? '07555 641 081';
    $phoneHref = preg_replace('/\s+/', '', $phone);
    $email = $main['contact']['email'] ?? 'tomasz@emove-fs.co.uk';
@endphp


@section('content')
    <div class="bg-[#6b5a2c] text-[#d2bb7b]">
        <div class="mx-auto flex max-w-350 items-center justify-between px-4 py-3 md:px-6 lg:px-10">
            <div class="flex flex-wrap items-center gap-4 md:gap-8">
                <a href="tel:{{ $phoneHref }}"
                    class="inline-flex items-center gap-2 text-[15px] transition hover:text-white">
                    <i class="fa-solid fa-phone text-[14px]"></i>
                    <span>{{ $phone }}</span>
                </a>

                <a href="mailto:{{ $email }}"
                    class="inline-flex items-center gap-2 text-[15px] transition hover:text-white">
                    <i class="fa-solid fa-envelope text-[14px]"></i>
                    <span>{{ $email }}</span>
                </a>
            </div>

            <div class="hidden items-center gap-5 md:flex">
                @if (!empty($main['contact']['socialLinks']['facebook']))
                    <a href="{{ esc_url($main['contact']['socialLinks']['facebook']) }}" aria-label="Facebook"
                        class="text-[#d2bb7b] transition hover:text-white">
                        <i class="fa-brands fa-facebook-f text-[15px]"></i>
                    </a>
                @endif

                @if (!empty($main['contact']['socialLinks']['instagram']))
                    <a href="{{ esc_url($main['contact']['socialLinks']['instagram']) }}" aria-label="Instagram"
                        class="text-[#d2bb7b] transition hover:text-white">
                        <i class="fa-brands fa-instagram text-[15px]"></i>
                    </a>
                @endif

                @if (!empty($main['contact']['socialLinks']['linkedin']))
                    <a href="{{ esc_url($main['contact']['socialLinks']['linkedin']) }}" aria-label="LinkedIn"
                        class="text-[#d2bb7b] transition hover:text-white">
                        <i class="fa-brands fa-linkedin-in text-[15px]"></i>
                    </a>
                @endif

                <div class="flex items-center gap-2 text-[15px] text-[#e8e0c6]">
                    <img src="https://kapowaz.github.io/circle-flags/flags/uk.svg" alt="Easy Move Financial logo"
                        class="h-5 w-auto object-contain" />
                    <span>eng</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <section id="splitHero" class="relative h-screen min-h-175 overflow-hidden bg-[#2c2418] text-white">
        <div class="absolute inset-0">
            <div
                class="pointer-events-none absolute left-0 right-0 top-0 z-30 flex items-start justify-between px-8 pt-8 md:px-12 lg:px-14">
                @if (!empty($main['hero']['logo_fin']))
                    <img src="{{ esc_url($main['hero']['logo_fin']) }}" alt="Easy Move Financial logo"
                        class="h-20 w-auto object-contain" />
                @endif

                @if (!empty($main['hero']['logo_pro']))
                    <img src="{{ esc_url($main['hero']['logo_pro']) }}" alt="Easy Move Protection logo"
                        class="h-20 w-auto object-contain" />
                @endif

                <div class="hidden" aria-hidden="true">
                    <span id="openLogoTop">EASYMOVE</span>
                    <span id="openLogoBottom">FINANCIAL</span>
                    <span id="closedLogoTop">EASYMOVE</span>
                    <span id="closedLogoBottom">PROTECTION</span>
                </div>
            </div>

            <article id="openPanel" class="hero-panel absolute left-0 top-0 z-20 overflow-hidden">
                <div class="absolute inset-0">
                    <div id="openImageStage" class="absolute inset-0">
                        <img id="openImageA" src="" alt="" class="hero-image is-active" />
                        <img id="openImageB" src="" alt="" class="hero-image" />
                    </div>
                    <div class="absolute inset-0 bg-[rgba(73,56,19,0.58)]"></div>
                </div>

                <div class="relative z-10 flex h-full flex-col px-8 pt-8 pb-10 md:px-12 lg:px-14">
                    <div class="flex items-start justify-between">
                        <div id="openTopWrap" class="w-full">
                            @php
                                $heroMenuItems = [];
                                $heroMenuChildren = [];

                                if (has_nav_menu('primary_navigation')) {
                                    $locations = get_nav_menu_locations();
                                    $menuId = $locations['primary_navigation'] ?? 0;
                                    $menuItems = $menuId ? wp_get_nav_menu_items($menuId) : [];

                                    if (!empty($menuItems)) {
                                        $heroMenuItems = array_values(
                                            array_filter($menuItems, function ($item) {
                                                return (int) ($item->menu_item_parent ?? 0) === 0;
                                            }),
                                        );

                                        foreach ($menuItems as $menuItem) {
                                            $parentId = (int) ($menuItem->menu_item_parent ?? 0);

                                            if ($parentId > 0) {
                                                if (!isset($heroMenuChildren[$parentId])) {
                                                    $heroMenuChildren[$parentId] = [];
                                                }

                                                $heroMenuChildren[$parentId][] = $menuItem;
                                            }
                                        }
                                    }
                                }
                            @endphp

                            <nav id="openMenu" class="mt-28 hidden lg:flex items-center gap-5 text-[18px] text-white/90">
                                @if (!empty($heroMenuItems))
                                    @foreach ($heroMenuItems as $index => $item)
                                        @php
                                            $itemId = (int) ($item->ID ?? 0);
                                            $itemTitle = $item->title ?? '';
                                            $itemUrl = $item->url ?? '#';
                                            $childItems = $heroMenuChildren[$itemId] ?? [];
                                            $itemTitleLower = strtolower($itemTitle);
                                            $menuGroup = 'general';
                                            $itemClass = [];

                                            if ($index === 0) {
                                                $itemClass[] = 'menu-home';
                                                $itemClass[] = 'text-[#e6c15a]';
                                            }

                                            if (strpos($itemTitleLower, 'mortgage') !== false) {
                                                $menuGroup = 'mortgage';
                                                $itemClass[] = 'menu-service';
                                            } elseif (strpos($itemTitleLower, 'insurance') !== false) {
                                                $menuGroup = 'insurance';
                                            }
                                        @endphp

                                        <div class="relative" data-hero-menu-item
                                            data-hero-menu-group="{{ $menuGroup }}">
                                            <div class="flex items-center gap-1">
                                                <a href="{{ esc_url($itemUrl) }}"
                                                    class="{{ implode(' ', $itemClass) }}">{{ $itemTitle }}</a>

                                                @if (!empty($childItems))
                                                    <button type="button"
                                                        class="hero-submenu-toggle inline-flex h-6 w-6 items-center justify-center text-white/80 transition hover:text-white"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        aria-label="Open {{ $itemTitle }} submenu">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>

                                            @if (!empty($childItems))
                                                <div
                                                    class="hero-submenu-dialog invisible absolute right-0 top-full z-40 mt-3 min-w-56 translate-y-1 border border-[#f9cf6c]/35 bg-[#2f2309]/95 p-3 opacity-0 shadow-[0_14px_30px_rgba(0,0,0,0.35)] transition duration-200">
                                                    <ul class="space-y-1.5">
                                                        @foreach ($childItems as $childItem)
                                                            <li>
                                                                <a href="{{ esc_url($childItem->url ?? '#') }}"
                                                                    class="block px-3 py-2 text-[14px] text-[#e8e0c6] transition hover:bg-[#f9cf6c] hover:text-[#3d2e12]">
                                                                    {{ $childItem->title ?? '' }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <a href="#" class="menu-home text-[#e6c15a]">Home</a>
                                    <a href="#">About us</a>
                                    <a href="#">Mortgages</a>
                                    <a href="#">Insurance</a>
                                    <a href="#">Blog</a>
                                    <a href="#">Contact us</a>
                                @endif
                            </nav>
                        </div>
                    </div>

                    <div id="openContentWrap" class="mt-auto mb-8 max-w-110">
                        <div id="openEyebrow" class="mb-3 text-[20px] uppercase tracking-[0.22em] text-white/90">MORTGAGES
                        </div>

                        <h1 id="openTitle" class="text-[60px] font-light leading-[1.05] md:text-[56px]">
                            Simple, Secure,<br>Stress-Free
                        </h1>

                        <p id="openText" class="mt-6 max-w-[320px] text-[18px] leading-6 text-[#BBAB79]">
                            Buying your dream home?<br>We make it clear, personal, and easy.
                        </p>

                        <a id="openButton" href="#"
                            class="mt-8 inline-flex min-w-33 items-center justify-center px-6 py-3 text-[16px] uppercase tracking-[0.08em] text-[#30281b] transition bg-white hover:bg-[#DAD5C6] active:bg-[#BBAB79]">
                            Discover
                        </a>
                    </div>
                </div>
            </article>
            <article id="closedPanel"
                class="hero-panel absolute right-0 top-0 z-10 overflow-hidden bg-[linear-gradient(90deg,#2b220f_0%,#3a2d14_100%)]">
                <div class="relative z-10 flex h-full flex-col px-8 pt-8 pb-10 md:px-12 lg:px-14">
                    <div class="mt-auto mb-8 max-w-[320px]">
                        <div id="closedEyebrow" class="mb-3 text-[20px] uppercase tracking-[0.22em] text-white/90">
                            INSURANCE
                        </div>

                        <h2 id="closedTitle" class="text-[60px] font-light leading-[1.05] md:text-[56px]">
                            Safe and<br>Protected
                        </h2>

                        <p id="closedText" class="mt-6 max-w-75 text-[18px] leading-6 text-[#BBAB79]">
                            Protecting your home or family?<br>We make it clear, personal, and easy.
                        </p>

                        <a id="closedButton" href="#"
                            class="mt-8 inline-flex min-w-33 items-center justify-center px-6 py-3 text-[16px] uppercase tracking-[0.08em] text-[#30281b] transition bg-[#F9CF6C] hover:bg-[#DAD5C6] active:bg-white">
                            Discover
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <button id="splitHeroToggle" type="button" aria-label="Switch hero panels"
            class="absolute z-30 grid h-14.5 w-14.5 place-items-center rounded-full bg-[#e6c15a] hover:bg-[#DAD5C6] active:bg-white text-[#2b220f] shadow-xl transition hover:scale-105">
            <svg id="splitHeroIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform duration-700"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <script id="splitHeroData" type="application/json">
          {!! json_encode($main['hero'] ?? [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const heroMenu = document.getElementById('openMenu');

                if (!heroMenu) return;

                const menuItems = heroMenu.querySelectorAll('[data-hero-menu-item]');

                const closeAll = () => {
                    menuItems.forEach((menuItem) => {
                        const dialog = menuItem.querySelector('.hero-submenu-dialog');
                        const toggle = menuItem.querySelector('.hero-submenu-toggle');

                        if (dialog) {
                            dialog.classList.add('invisible', 'translate-y-1', 'opacity-0');
                            dialog.classList.remove('visible', 'translate-y-0', 'opacity-100');
                        }

                        if (toggle) {
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    });
                };

                menuItems.forEach((menuItem) => {
                    const toggle = menuItem.querySelector('.hero-submenu-toggle');
                    const dialog = menuItem.querySelector('.hero-submenu-dialog');

                    if (!toggle || !dialog) return;

                    toggle.addEventListener('click', (event) => {
                        event.preventDefault();
                        event.stopPropagation();

                        const isOpen = toggle.getAttribute('aria-expanded') === 'true';

                        closeAll();

                        if (!isOpen) {
                            dialog.classList.remove('invisible', 'translate-y-1', 'opacity-0');
                            dialog.classList.add('visible', 'translate-y-0', 'opacity-100');
                            toggle.setAttribute('aria-expanded', 'true');
                        }
                    });
                });

                document.addEventListener('click', (event) => {
                    if (!heroMenu.contains(event.target)) {
                        closeAll();
                    }
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeAll();
                    }
                });
            });
        </script>
    </section>
    <section class="mx-auto max-w-7xl px-6 pt-16 md:px-10 md:pt-24 lg:px-16 lg:pt-28">
        <div class="grid gap-10 lg:grid-cols-[1.05fr_1fr] lg:gap-16">
            <div class="max-w-107.5">
                <h2 class="text-[42px] font-light leading-[1.12] tracking-[-0.02em] md:text-[60px]">
                    {!! $main['confused']['heading'] ?? 'Confused by mortgages?<br />Unsure about insurance?' !!}
                </h2>
            </div>

            <div class="max-w-130 pt-2 text-[18px] leading-8 text-[#c1a15a]">
                <ul class="space-y-1">
                    @forelse ($main['confused']['bullets'] ?? [] as $bullet)
                        <li class="flex items-start gap-4">
                            <span class="mt-2.5 text-[10px] leading-none">○</span>
                            <span>{{ $bullet['text'] ?? '' }}</span>
                        </li>
                    @empty
                        <li class="flex items-start gap-4">
                            <span class="mt-2.5 text-[10px] leading-none">○</span>
                            <span>Not sure which mortgage deal is right for you?</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="mt-2.5 text-[10px] leading-none">○</span>
                            <span>Wondering how to protect your family or income if the unexpected happens?</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="mt-2.5 text-[10px] leading-none">○</span>
                            <span>Tired of financial jargon and sales pressure?</span>
                        </li>
                    @endforelse
                </ul>

                <p class="mt-4 max-w-130 leading-8">
                    {!! $main['confused']['text'] ??
                        'At Easy Move Mortgages, we cut through the confusion. Whether it\’s securing your first home, remortgaging, or protecting your loved ones, our mission is to give you <span class="font-semibold">clarity, confidence, and complete peace of mind.</span>' !!}
                </p>
            </div>
        </div>
    </section>

    <section class="relative mt-14 bg-[#3c2c05] pb-0 pt-27.5 md:mt-50 md:pt-37.5 lg:pt-45">
        <div
            class="absolute left-1/2 top-0 z-10 w-full max-w-275 -translate-x-1/2 -translate-y-[28%] px-6 md:px-8 lg:px-10">
            <div class="overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.18)]">
                <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=1600&auto=format&fit=crop"
                    alt="Mortgage advisor meeting with clients" class="h-55 w-full object-cover md:h-80 lg:h-90">
            </div>
        </div>

        <div class="mx-auto max-w-275 px-6 md:px-8 lg:px-10">
            <div class="text-center">
                <h2 class="text-[42px] font-light leading-tight text-white md:text-[56px]">
                    {{ $main['whyChooseUs']['heading'] ?? 'Why choose us?' }}
                </h2>
            </div>

            <div class="mt-14 grid grid-cols-1 gap-10 pb-14 md:mt-16 md:grid-cols-3 md:gap-6 lg:gap-10 lg:pb-16">
                @forelse ($main['whyChooseUs']['features'] ?? [] as $feature)
                    <div class="border-t border-[rgba(232,194,98,0.28)] pt-8 text-center md:text-left">
                        <div class="mb-5 flex justify-center md:justify-start">
                            <div class="flex h-14 w-14 items-center justify-center text-[#f0c75b]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.625 9h6.75M8.625 12.75h4.5M7.5 19.5l-3 1.5V6.75A2.25 2.25 0 016.75 4.5h10.5a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25H10.5L7.5 19.5z" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="mb-3 text-[26px] font-medium uppercase tracking-[0.06em] text-white">
                            {{ $feature['title'] ?? '' }}
                        </h3>

                        <p class="text-[16px] leading-[1.8] text-[#b7aa8a]">
                            {{ $feature['description'] ?? '' }}
                        </p>
                    </div>
                @empty
                    <div class="border-t border-[rgba(232,194,98,0.28)] pt-8 text-center md:text-left">
                        <div class="mb-5 flex justify-center md:justify-start">
                            <div class="flex h-14 w-14 items-center justify-center text-[#f0c75b]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.625 9h6.75M8.625 12.75h4.5M7.5 19.5l-3 1.5V6.75A2.25 2.25 0 016.75 4.5h10.5a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25H10.5L7.5 19.5z" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="mb-3 text-[26px] font-medium uppercase tracking-[0.06em] text-white">
                            We listen
                        </h3>

                        <p class="text-[16px] leading-[1.8] text-[#b7aa8a]">
                            Your goals, your story, your future.
                        </p>
                    </div>

                    <div class="border-t border-[rgba(232,194,98,0.28)] pt-8 text-center md:text-left">
                        <div class="mb-5 flex justify-center md:justify-start">
                            <div class="flex h-14 w-14 items-center justify-center text-[#f0c75b]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75h.008v.008H12V6.75zM10.5 10.5h1.5v4.5h1.5M3.75 15.75l4.28-1.07a2.25 2.25 0 011.01 0l2.46.615a2.25 2.25 0 00.91 0l4.688-1.172a1.875 1.875 0 012.322 1.819V16.5a1.5 1.5 0 01-1.136 1.455l-6.14 1.535a6.75 6.75 0 01-2.877.07l-5.518-1.104V15.75zM7.5 15V9.75A2.25 2.25 0 019.75 7.5h4.5a2.25 2.25 0 012.25 2.25V12" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="mb-3 text-[26px] font-medium uppercase tracking-[0.06em] text-white">
                            We simplify
                        </h3>

                        <p class="text-[16px] leading-[1.8] text-[#b7aa8a]">
                            Clear advice, no jargon, tailored options.
                        </p>
                    </div>

                    <div class="border-t border-[rgba(232,194,98,0.28)] pt-8 text-center md:text-left">
                        <div class="mb-5 flex justify-center md:justify-start">
                            <div class="flex h-14 w-14 items-center justify-center text-[#f0c75b]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3v18M12 5.25h6.878a.75.75 0 01.53 1.28L16.5 9.438l2.908 2.908a.75.75 0 01-.53 1.28H12m0-8.376H6.375a.75.75 0 00-.53 1.28L8.25 9l-2.405 2.47a.75.75 0 00.53 1.28H12" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="mb-3 text-[26px] font-medium uppercase tracking-[0.06em] text-white">
                            We guide
                        </h3>

                        <p class="text-[16px] leading-[1.8] text-[#b7aa8a]">
                            From application to approval (and beyond).
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="bg-[#e4bf62] px-5 py-5 md:px-8">
                <div class="flex flex-col items-center justify-center gap-3 text-center md:flex-row md:gap-8">
                    <span class="text-[20px] font-medium uppercase tracking-[0.08em] text-[#4a3910]">
                        Give us a call
                    </span>

                    @php
                        $contactPhone = $main['contact']['phone'] ?? '07555 641 081';
                        $contactPhoneHref = preg_replace('/\s+/', '', $contactPhone);
                    @endphp

                    <a href="tel:{{ $contactPhoneHref }}"
                        class="inline-flex items-center gap-2 text-[16px] font-medium text-[#4a3910] transition hover:opacity-80">
                        <i class="fa-solid fa-phone text-[14px]"></i>
                        {{ $contactPhone }}
                    </a>

                    <span class="text-[15px] text-[#4a3910]">
                        {{ $main['contact']['hours'] ?? 'Open Mon-Fri, 9:00-17:00' }}
                    </span>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-[#efefef] text-[#3d2e12]">
        <div class="mx-auto max-w-7xl px-6 py-16 md:px-10 md:py-20 lg:px-16 lg:py-24">
            <h2 class="text-center text-[42px] font-light leading-[1.1] tracking-[-0.02em] md:text-[58px]">
                {{ $main['reviews']['heading'] ?? 'What our customers are saying…' }}
            </h2>

            <div class="mt-12 md:mt-16">
                <div class="reviews-plugin-wrap relative">
                    {!! do_shortcode($main['reviews']['shortcode'] ?? '[your_reviews_plugin_shortcode_here]') !!}
                </div>
            </div>
        </div>
    </section>
    <section class="relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=2000&auto=format&fit=crop"
                alt="Aerial view of homes" class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-[rgba(73,56,19,0.58)]"></div>
        </div>

        <div
            class="relative z-10 mx-auto flex min-h-90 max-w-7xl items-center justify-center px-6 py-16 text-center md:min-h-135 md:px-10 lg:px-16">
            <div class="max-w-215">
                <h2 class="text-[42px] font-light leading-[1.15] text-white md:text-[60px]">
                    {!! $main['protect']['heading'] ?? 'Your home. Your family. Your future.<br />Let\’s protect it together.' !!}
                </h2>

                <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ esc_url($main['protect']['buttons']['mortgage'] ?? '#') }}"
                        class="inline-flex min-w-35 items-center justify-center px-6 py-3 text-[16px] uppercase tracking-[0.08em] text-[#3d2e12] transition bg-white hover:bg-[#DAD5C6] active:bg-[#BBAB79]">
                        Mortgage
                    </a>

                    <a href="{{ esc_url($main['protect']['buttons']['insurance'] ?? '#') }}"
                        class="inline-flex min-w-35 items-center justify-center px-6 py-3 text-[16px] uppercase tracking-[0.08em] text-[#3d2e12] transition bg-[#F9CF6C] hover:bg-[#DAD5C6] active:bg-white">
                        Insurance
                    </a>
                </div>
            </div>
        </div>
    </section>
    @php
        $latestPosts = get_posts([
            'post_type' => 'post',
            'posts_per_page' => $main['blog']['postsCount'] ?? 3,
            'post_status' => 'publish',
        ]);
    @endphp

    <section class="bg-[#efefef] text-[#3d2e12]">
        <div class="mx-auto max-w-7xl px-6 py-16 md:px-10 md:py-20 lg:px-16 lg:py-24">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div>
                    <h2 class="mt-3 text-[42px] font-light leading-[1.08] tracking-[-0.02em] md:text-[58px]">
                        {{ $main['blog']['heading'] ?? 'Blog & Articles' }}
                    </h2>
                </div>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($latestPosts as $post)
                    @php setup_postdata($post); @endphp

                    <article
                        class="group border-t-4 border-t-[#F9CF6C] min-h-125 min-w-62.5 overflow-hidden bg-white shadow-[0_10px_30px_rgba(0,0,0,0.04)] flex flex-col transition hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(0,0,0,0.08)]">
                        <a href="{{ get_permalink($post) }}" class="block">
                            <div class="aspect-16/10 overflow-hidden p-10">
                                @if (has_post_thumbnail($post))
                                    {!! get_the_post_thumbnail($post, 'large', [
                                        'class' => 'h-full w-full min-h-56.5 object-cover transition duration-500 group-hover:scale-105',
                                    ]) !!}
                                @else
                                    <div
                                        class="flex  min-h-56.5 h-full w-full items-center justify-center bg-[linear-gradient(90deg,#2f2309_0%,#4a360a_50%,#2f2309_100%)] text-white/70">
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="p-6 md:p-10 flex flex-col h-full justify-between">
                            <div>
                                <div
                                    class="mt-4 flex items-center gap-2 text-[18px] font-medium uppercase tracking-[0.06em] text-[#9a9488]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.25 w-4.25 shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                    </svg>

                                    <time datetime="{{ get_the_date('c') }}">
                                        {{ strtoupper(get_the_date('M j, Y')) }}
                                    </time>
                                </div>

                                <h3 class="mt-4 text-[28px] font-light leading-[1.15] md:text-[32px]">
                                    <a href="{{ get_permalink($post) }}" class="transition text-[#AB8022]">
                                        {{ get_the_title($post) }}
                                    </a>
                                </h3>
                            </div>

                            <a href="{{ get_permalink($post) }}"
                                class="mt-6 inline-flex items-center text-[16px] uppercase tracking-[0.08em] text-[#3d2e12] transition hover:text-[#b89a56]">
                                Read more
                            </a>
                        </div>
                    </article>
                @endforeach

                @php wp_reset_postdata(); @endphp
            </div>
            <a href="{{ get_permalink(get_option('page_for_posts')) }}"
                class="inline-flex mt-15 bg-[#423616] items-center text-[16px] uppercase tracking-[0.08em] text-white py-5 px-10 transition hover:bg-[#B8A26E] active:bg-[#F9CF6C]">
                See all articles
            </a>
        </div>
    </section>
    <section class="relative overflow-hidden bg-[#3c2c05]">
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_20%_50%,rgba(196,150,37,0.22),transparent_28%),radial-gradient(circle_at_50%_50%,rgba(196,150,37,0.18),transparent_30%),radial-gradient(circle_at_80%_50%,rgba(196,150,37,0.22),transparent_28%)]">
        </div>

        <div class="pointer-events-none absolute inset-0 flex items-center justify-center opacity-[0.08]">
            <div
                class="select-none text-[180px] font-light tracking-[0.18em] text-[#e0b84f] md:text-[260px] lg:text-[340px]">
                B M
            </div>
        </div>

        <div class="relative mx-auto max-w-300 px-6 py-14 md:px-8 md:py-20 lg:px-10 lg:py-24">
            <div class="grid grid-cols-2 gap-y-10 text-center md:grid-cols-4 md:gap-x-8">
                @forelse ($main['statistics'] ?? [] as $statistic)
                    <div>
                        <div class="text-[48px] font-light leading-none text-[#f0c75b] md:text-[62px]">
                            {{ $statistic['number'] ?? '' }}
                        </div>
                        <p class="mt-4 text-[18px] uppercase leading-[1.45] tracking-[0.08em] text-white md:text-[20px]">
                            {!! $statistic['label'] ?? '' !!}
                        </p>
                    </div>
                @empty
                    <div>
                        <div class="text-[48px] font-light leading-none text-[#f0c75b] md:text-[62px]">
                            15
                        </div>
                        <p class="mt-4 text-[18px] uppercase leading-[1.45] tracking-[0.08em] text-white md:text-[20px]">
                            Years of <br class="hidden sm:block"> experience
                        </p>
                    </div>

                    <div>
                        <div class="text-[48px] font-light leading-none text-[#f0c75b] md:text-[62px]">
                            100
                        </div>
                        <p class="mt-4 text-[18px] uppercase leading-[1.45] tracking-[0.08em] text-white md:text-[20px]">
                            Lenders available
                        </p>
                    </div>

                    <div>
                        <div class="text-[48px] font-light leading-none text-[#f0c75b] md:text-[62px]">
                            8000
                        </div>
                        <p class="mt-4 text-[18px] uppercase leading-[1.45] tracking-[0.08em] text-white md:text-[20px]">
                            Different <br class="hidden sm:block"> mortgages
                        </p>
                    </div>

                    <div>
                        <div class="text-[48px] font-light leading-none text-[#f0c75b] md:text-[62px]">
                            100%
                        </div>
                        <p class="mt-4 text-[18px] uppercase leading-[1.45] tracking-[0.08em] text-white md:text-[20px]">
                            Happy <br class="hidden sm:block"> customers
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
