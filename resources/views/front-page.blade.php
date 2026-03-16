{{--
  Template Name: Front Page
--}}

@extends('layouts.app')

@section('content')
    <section id="splitHero" class="relative h-screen min-h-175 overflow-hidden bg-[#2c2418] text-white">
        <div class="absolute inset-0">
            <!-- OPEN PANEL -->
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
                            <div class="mb-8 flex items-center gap-4">
                                <div
                                    class="grid h-10 w-10 place-items-center border border-white/60 text-lg tracking-[0.28em]">
                                    EM
                                </div>
                                <div class="leading-none">
                                    <div id="openLogoTop" class="text-[24px] uppercase tracking-[0.12em]">EASYMOVE</div>
                                    <div id="openLogoBottom" class="text-[14px] uppercase tracking-[0.35em]">FINANCIAL</div>
                                </div>
                            </div>

                            <nav id="openMenu" class="hidden lg:flex items-center gap-5 text-[11px] text-white/90">
                                <a href="#" class="menu-home text-[#e6c15a]">Home</a>
                                <a href="#">About us</a>
                                <a href="#" class="menu-service">Mortgages</a>
                                <a href="#">Blog</a>
                                <a href="#">Contact us</a>
                            </nav>
                        </div>
                    </div>

                    <div id="openContentWrap" class="mt-auto mb-8 max-w-110">
                        <div id="openEyebrow" class="mb-3 text-[12px] uppercase tracking-[0.22em] text-white/90">MORTGAGES
                        </div>

                        <h1 id="openTitle" class="text-[44px] font-light leading-[1.05] md:text-[56px]">
                            Simple, Secure,<br>Stress-Free
                        </h1>

                        <p id="openText" class="mt-6 max-w-[320px] text-[13px] leading-6 text-white/75">
                            Buying your dream home?<br>We make it clear, personal, and easy.
                        </p>

                        <a id="openButton" href="#"
                            class="mt-8 inline-flex min-w-33 items-center justify-center bg-white px-6 py-3 text-[11px] uppercase tracking-[0.08em] text-[#30281b] transition hover:bg-[#e6c15a]">
                            Discover
                        </a>
                    </div>
                </div>
            </article>

            <!-- CLOSED PANEL -->
            <article id="closedPanel"
                class="hero-panel absolute right-0 top-0 z-10 overflow-hidden bg-[linear-gradient(90deg,#2b220f_0%,#3a2d14_100%)]">
                <div class="relative z-10 flex h-full flex-col px-8 pt-8 pb-10 md:px-12 lg:px-14">
                    <div class="flex justify-start">
                        <div class="mb-8 flex items-center gap-4">
                            <div class="grid h-10 w-10 place-items-center border border-white/60 text-lg tracking-[0.28em]">
                                EM
                            </div>
                            <div class="leading-none">
                                <div id="closedLogoTop" class="text-[24px] uppercase tracking-[0.12em]">EASYMOVE</div>
                                <div id="closedLogoBottom" class="text-[14px] uppercase tracking-[0.35em]">PROTECTION</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto mb-8 max-w-[320px]">
                        <div id="closedEyebrow" class="mb-3 text-[12px] uppercase tracking-[0.22em] text-white/90">INSURANCE
                        </div>

                        <h2 id="closedTitle" class="text-[44px] font-light leading-[1.05] md:text-[56px]">
                            Safe and<br>Protected
                        </h2>

                        <p id="closedText" class="mt-6 max-w-75 text-[13px] leading-6 text-white/75">
                            Protecting your home or family?<br>We make it clear, personal, and easy.
                        </p>

                        <a id="closedButton" href="#"
                            class="mt-8 inline-flex min-w-33 items-center justify-center bg-[#e6c15a] px-6 py-3 text-[11px] uppercase tracking-[0.08em] text-[#30281b] transition hover:bg-white">
                            Discover
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <!-- DIVIDER TOGGLE -->
        <button id="splitHeroToggle" type="button" aria-label="Switch hero panels"
            class="absolute z-30 grid h-[58px] w-[58px] place-items-center rounded-full bg-[#e6c15a] text-[#2b220f] shadow-xl transition hover:scale-105">
            <svg id="splitHeroIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform duration-700"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </section>
    <section class="bg-[#efefef] text-[#3d2e12]">
        <div class="mx-auto max-w-7xl px-6 pt-16 md:px-10 md:pt-24 lg:px-16 lg:pt-28">
            <div class="grid gap-10 lg:grid-cols-[1.05fr_1fr] lg:gap-16">
                <div class="max-w-107.5">
                    <h2 class="text-[42px] font-light leading-[1.12] tracking-[-0.02em] md:text-[58px]">
                        Confused by mortgages?<br />
                        Unsure about insurance?
                    </h2>
                </div>

                <div class="max-w-130 pt-2 text-[15px] leading-8 text-[#c1a15a]">
                    <ul class="space-y-1">
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
                    </ul>

                    <p class="mt-4 max-w-130 leading-8">
                        At Easy Move Mortgages, we cut through the confusion. Whether it’s securing your first home,
                        remortgaging, or protecting your loved ones, our mission is to give you
                        <span class="font-semibold">clarity, confidence, and complete peace of mind.</span>
                    </p>
                </div>
            </div>

            <div class="relative z-10 mt-16 flex justify-center md:mt-20">
                <div class="w-full max-w-186 overflow-hidden shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
                    <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=1600&auto=format&fit=crop"
                        alt="Family moving into a new home" class="h-62.5 w-full object-cover md:h-[320px]" />
                </div>
            </div>
        </div>

        <div class="-mt-16 bg-[linear-gradient(90deg,#2f2309_0%,#4a360a_50%,#2f2309_100%)] pt-28 pb-0 md:-mt-20 md:pt-36">
            <div class="mx-auto max-w-7xl px-6 md:px-10 lg:px-16">
                <div class="mx-auto max-w-186">
                    <h3 class="text-center text-[42px] font-light leading-none text-white md:text-[58px]">
                        Why choose us?
                    </h3>

                    <div class="mt-14 grid gap-10 md:mt-16 md:grid-cols-3 md:gap-5">
                        <div class="border-t border-white/20 pt-10 text-white">
                            <div class="mb-5 text-[#e6c15a]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none"
                                    viewBox="0 0 48 48" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 29.5V14.5A3.5 3.5 0 0 1 14.5 11h19A3.5 3.5 0 0 1 37 14.5v13A3.5 3.5 0 0 1 33.5 31H20l-6.5 6v-6h-1A3.5 3.5 0 0 1 11 27.5Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 18h14M17 23h14M17 28h8" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 20v14.5A2.5 2.5 0 0 0 9.5 37H13" />
                                </svg>
                            </div>

                            <h4 class="text-[32px] font-light uppercase tracking-[0.08em] md:text-[18px]">
                                We Listen
                            </h4>

                            <p class="mt-5 max-w-55 text-[16px] leading-7 text-white/55 md:text-[15px]">
                                Your goals, your story, your future.
                            </p>
                        </div>

                        <div class="border-t border-white/20 pt-10 text-white">
                            <div class="mb-5 text-[#e6c15a]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none"
                                    viewBox="0 0 48 48" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M24 10a7 7 0 1 0 0 14a7 7 0 0 0 0-14Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.5 16.5h5M24 14v5" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 31.5h8l5-3.5h6.5a3 3 0 0 1 2.9 3.8l-.4 1.4l5.1-1.7A8 8 0 0 0 42 24" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 29h4v9H6z" />
                                </svg>
                            </div>

                            <h4 class="text-[32px] font-light uppercase tracking-[0.08em] md:text-[18px]">
                                We Simplify
                            </h4>

                            <p class="mt-5 max-w-[220px] text-[16px] leading-7 text-white/55 md:text-[15px]">
                                Clear advice, no jargon, tailored options.
                            </p>
                        </div>

                        <div class="border-t border-white/20 pt-10 text-white">
                            <div class="mb-5 text-[#e6c15a]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none"
                                    viewBox="0 0 48 48" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 24h24" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M24 10v28" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M24 14l10 10l-10 10" />
                                </svg>
                            </div>

                            <h4 class="text-[32px] font-light uppercase tracking-[0.08em] md:text-[18px]">
                                We Guide
                            </h4>

                            <p class="mt-5 max-w-[240px] text-[16px] leading-7 text-white/55 md:text-[15px]">
                                From application to approval (and beyond).
                            </p>
                        </div>
                    </div>

                    <div class="mt-12 bg-[#e6c15a] px-6 py-5 text-[#3d2e12] md:mt-14">
                        <div class="flex flex-col items-center justify-center gap-3 text-center md:flex-row md:gap-6">
                            <span class="text-[15px] uppercase tracking-[0.08em]">Give us a call</span>

                            <div class="flex items-center gap-2 text-[15px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M2.8 2.8a2 2 0 0 1 2.2-.47l2.43.97a2 2 0 0 1 1.22 1.57l.2 1.66a2 2 0 0 1-.57 1.64L7.1 9.37a13.07 13.07 0 0 0 3.53 3.53l1.2-1.2a2 2 0 0 1 1.64-.57l1.66.2a2 2 0 0 1 1.57 1.22l.97 2.43a2 2 0 0 1-.47 2.2l-1.08 1.08a3 3 0 0 1-3.02.73c-3.4-.98-6.52-3.1-9-5.58S.98 6.42 0 3.02A3 3 0 0 1 .73 0L1.8 1.08Z" />
                                </svg>
                                <a href="tel:07555641081" class="hover:underline">07555 641 081</a>
                            </div>

                            <span class="text-[15px]">Open Mon-Fri, 9:00-17:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-[#efefef] text-[#3d2e12]">
        <div class="mx-auto max-w-[1280px] px-6 py-16 md:px-10 md:py-20 lg:px-16 lg:py-24">
            <h2 class="text-center text-[42px] font-light leading-[1.1] tracking-[-0.02em] md:text-[58px]">
                What our customers are saying…
            </h2>

            <div class="mt-12 md:mt-16">
                <div class="reviews-plugin-wrap relative">
                    {{--
          Replace this with your plugin shortcode, for example:
          [trustindex no-registration=google]
          or
          [grw id="12345"]
        --}}

                    {!! do_shortcode('[your_reviews_plugin_shortcode_here]') !!}
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
            class="relative z-10 mx-auto flex min-h-[360px] max-w-[1280px] items-center justify-center px-6 py-16 text-center md:min-h-[420px] md:px-10 lg:px-16">
            <div class="max-w-[860px]">
                <h2 class="text-[42px] font-light leading-[1.15] text-white md:text-[64px]">
                    Your home. Your family. Your future.<br />
                    Let’s protect it together.
                </h2>

                <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="#"
                        class="inline-flex min-w-[140px] items-center justify-center bg-white px-6 py-3 text-[12px] uppercase tracking-[0.08em] text-[#3d2e12] transition hover:bg-[#e6c15a]">
                        Mortgage
                    </a>

                    <a href="#"
                        class="inline-flex min-w-[140px] items-center justify-center bg-[#e6c15a] px-6 py-3 text-[12px] uppercase tracking-[0.08em] text-[#3d2e12] transition hover:bg-white">
                        Insurance
                    </a>
                </div>
            </div>
        </div>
    </section>
    @php
        $latestPosts = get_posts([
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post_status' => 'publish',
        ]);
    @endphp

    <section class="bg-[#efefef] text-[#3d2e12]">
        <div class="mx-auto max-w-[1280px] px-6 py-16 md:px-10 md:py-20 lg:px-16 lg:py-24">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div>
                    <span class="text-[12px] uppercase tracking-[0.22em] text-[#b89a56]">Latest insights</span>
                    <h2 class="mt-3 text-[42px] font-light leading-[1.08] tracking-[-0.02em] md:text-[58px]">
                        From our blog
                    </h2>
                </div>

                <a href="{{ get_permalink(get_option('page_for_posts')) }}"
                    class="inline-flex items-center text-[12px] uppercase tracking-[0.08em] text-[#3d2e12] transition hover:text-[#b89a56]">
                    View all posts
                </a>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($latestPosts as $post)
                    @php setup_postdata($post); @endphp

                    <article
                        class="group overflow-hidden bg-white shadow-[0_10px_30px_rgba(0,0,0,0.04)] transition hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(0,0,0,0.08)]">
                        <a href="{{ get_permalink($post) }}" class="block">
                            <div class="aspect-[16/10] overflow-hidden bg-[#ddd]">
                                @if (has_post_thumbnail($post))
                                    {!! get_the_post_thumbnail($post, 'large', [
                                        'class' => 'h-full w-full object-cover transition duration-500 group-hover:scale-105',
                                    ]) !!}
                                @else
                                    <div
                                        class="flex h-full w-full items-center justify-center bg-[linear-gradient(90deg,#2f2309_0%,#4a360a_50%,#2f2309_100%)] text-white/70">
                                        <span class="text-[12px] uppercase tracking-[0.18em]">Easymove Blog</span>
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="p-6 md:p-7">
                            <div class="flex items-center gap-3 text-[12px] uppercase tracking-[0.12em] text-[#b89a56]">
                                <span>{{ get_the_date('d M Y', $post) }}</span>
                                @if (get_the_category($post))
                                    <span class="h-[3px] w-[3px] rounded-full bg-[#b89a56]"></span>
                                    <span>{{ get_the_category($post)[0]->name }}</span>
                                @endif
                            </div>

                            <h3 class="mt-4 text-[28px] font-light leading-[1.15] md:text-[32px]">
                                <a href="{{ get_permalink($post) }}" class="transition group-hover:text-[#b89a56]">
                                    {{ get_the_title($post) }}
                                </a>
                            </h3>

                            <p class="mt-4 text-[15px] leading-7 text-[#6d6047]">
                                {{ wp_trim_words(get_the_excerpt($post), 22, '...') }}
                            </p>

                            <a href="{{ get_permalink($post) }}"
                                class="mt-6 inline-flex items-center text-[12px] uppercase tracking-[0.08em] text-[#3d2e12] transition hover:text-[#b89a56]">
                                Read more
                            </a>
                        </div>
                    </article>
                @endforeach

                @php wp_reset_postdata(); @endphp
            </div>
        </div>
    </section>
    <section class="bg-[linear-gradient(90deg,#2f2309_0%,#4a360a_50%,#2f2309_100%)] text-white">
        <div class="mx-auto max-w-[1280px] px-6 py-16 md:px-10 md:py-20 lg:px-16 lg:py-24">
            <div class="mx-auto max-w-[900px] text-center">
                <span class="text-[12px] uppercase tracking-[0.22em] text-[#e6c15a]">Our impact</span>
                <h2 class="mt-3 text-[42px] font-light leading-[1.08] md:text-[58px]">
                    Numbers that matter
                </h2>
            </div>

            <div class="mt-14 grid gap-8 border-t border-white/15 pt-10 sm:grid-cols-2 xl:grid-cols-4">
                <div class="text-center">
                    <div class="text-[48px] font-light leading-none text-[#e6c15a] md:text-[64px]">500+</div>
                    <h3 class="mt-4 text-[16px] uppercase tracking-[0.08em]">Clients helped</h3>
                    <p class="mt-3 text-[15px] leading-7 text-white/60">
                        Supporting home buyers, families, and landlords with tailored advice.
                    </p>
                </div>

                <div class="text-center">
                    <div class="text-[48px] font-light leading-none text-[#e6c15a] md:text-[64px]">10+</div>
                    <h3 class="mt-4 text-[16px] uppercase tracking-[0.08em]">Years experience</h3>
                    <p class="mt-3 text-[15px] leading-7 text-white/60">
                        Trusted guidance through mortgages, remortgaging, and protection.
                    </p>
                </div>

                <div class="text-center">
                    <div class="text-[48px] font-light leading-none text-[#e6c15a] md:text-[64px]">99%</div>
                    <h3 class="mt-4 text-[16px] uppercase tracking-[0.08em]">Client satisfaction</h3>
                    <p class="mt-3 text-[15px] leading-7 text-white/60">
                        A personal approach focused on clarity, speed, and confidence.
                    </p>
                </div>

                <div class="text-center">
                    <div class="text-[48px] font-light leading-none text-[#e6c15a] md:text-[64px]">24/7</div>
                    <h3 class="mt-4 text-[16px] uppercase tracking-[0.08em]">Peace of mind</h3>
                    <p class="mt-3 text-[15px] leading-7 text-white/60">
                        Helping protect what matters most — your home, family, and future.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
