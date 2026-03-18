{{--
  Template Name: Service Template
--}}

@php
    $homeUrl = home_url('/');
    $homeLabel = get_bloginfo('name');
    $pageTitle = get_the_title();

    /**
     * Parent page for breadcrumb.
     * Works if the current page has a parent in WordPress.
     */
    $parentId = wp_get_post_parent_id(get_the_ID());
    $parentTitle = $parentId ? get_the_title($parentId) : null;
    $parentUrl = $parentId ? get_permalink($parentId) : null;

    /**
     * Main content fields
     */
    $introLeft = function_exists('get_field') ? get_field('intro_left') : '';
    $introRight = function_exists('get_field') ? get_field('intro_right') : '';
    $highlight = function_exists('get_field') ? get_field('highlight_text') : '';
    $heroImage = function_exists('get_field') ? get_field('hero_image') : '';

    $heroImageUrl = is_array($heroImage) ? $heroImage['url'] ?? '' : $heroImage;

    /**
     * Related services/cards
     */
    $relatedServices =
        function_exists('get_field') && get_field('related_services')
            ? get_field('related_services')
            : [
                [
                    'title' => 'Remortgage',
                    'url' => '#',
                    'image' =>
                        'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1200&auto=format&fit=crop',
                    'button_text' => 'Read More',
                ],
                [
                    'title' => 'Home Movers Mortgage',
                    'url' => '#',
                    'image' =>
                        'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=1200&auto=format&fit=crop',
                    'button_text' => 'Read More',
                ],
                [
                    'title' => 'Buy to Let',
                    'url' => '#',
                    'image' =>
                        'https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=1200&auto=format&fit=crop',
                    'button_text' => 'Read More',
                ],
            ];

    /**
     * Fallback text if ACF is not yet set
     */
    $introLeft =
        $introLeft ?:
        'First-time home buying shouldn’t be shrouded in mystery! We understand the complexities of navigating the mortgage process. Our team of dedicated professionals will break down your financing options into clear and concise terms, ensuring you make informed decisions towards achieving homeownership. Buying a home is a significant financial decision, and we’re here to help you make an informed one.';

    $introRight =
        $introRight ?:
        'We have extensive experience in helping first-time homebuyers and experienced homeowners achieve their financial goals. We take the time to understand your unique financial situation and goals, tailoring our recommendations to fit your needs. We work with a variety of lenders to offer you a wide range of mortgage products, ensuring you find the best fit for your circumstances. We handle all the paperwork and negotiations, making the mortgage process as smooth and stress-free as possible.';

    $highlight = $highlight ?: 'LET US PAVE THE PATH TO YOUR DREAM HOME WITH CLARITY, CONFIDENCE AND PEACE OF MIND!';
@endphp

@extends('layouts.app')

@section('content')
    <section class="bg-[#efefef] text-[#3d2e12]">
        <div class="mx-auto max-w-260 px-6 pt-14 pb-0 md:px-10 md:pt-16 lg:px-12 lg:pt-20">
            {{-- Breadcrumbs --}}
            <nav aria-label="Breadcrumb" class="mb-4 text-[13px] leading-none text-[#b9a36b]">
                <ol class="flex flex-wrap items-center gap-1">
                    <li>
                        <a href="{{ $homeUrl }}" class="transition hover:text-[#3d2e12]">
                            {{ $homeLabel }}
                        </a>
                    </li>

                    @if ($parentTitle && $parentUrl)
                        <li aria-hidden="true">-</li>
                        <li>
                            <a href="{{ $parentUrl }}" class="transition hover:text-[#3d2e12]">
                                {{ $parentTitle }}
                            </a>
                        </li>
                    @endif

                    @if ($pageTitle)
                        <li aria-hidden="true">-</li>
                        <li class="text-[#8b7a57]">
                            {{ $pageTitle }}
                        </li>
                    @endif
                </ol>
            </nav>

            {{-- Title --}}
            <header class="max-w-195">
                <h1 class="text-[44px] font-light leading-[1.05] tracking-[-0.02em] md:text-[64px]">
                    {{ $pageTitle }}
                </h1>
            </header>

            {{-- Intro copy --}}
            <div class="mt-12 grid gap-8 md:mt-14 md:grid-cols-2 md:gap-10 lg:gap-14">
                <div class="text-[15px] leading-8 text-[#6d6047]">
                    <p>{{ $introLeft }}</p>
                </div>

                <div class="text-[15px] leading-8 text-[#6d6047]">
                    <p>{{ $introRight }}</p>
                </div>
            </div>

            {{-- Highlight line --}}
            <div class="mt-10 md:mt-12">
                <p class="text-[18px] font-medium uppercase tracking-[0.06em] text-[#7b6944] md:text-[20px]">
                    {{ $highlight }}
                </p>
            </div>

            {{-- Hero image --}}
            <div class="relative z-10 mt-12 md:mt-16">
                <div class="overflow-hidden bg-[#ddd]">
                    @if ($heroImageUrl)
                        <img src="{{ esc_url($heroImageUrl) }}" alt="{{ esc_attr($pageTitle) }}"
                            class="h-65 w-full object-cover md:h-90" />
                    @elseif (has_post_thumbnail())
                        {!! get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'h-[260px] w-full object-cover md:h-[360px]']) !!}
                    @else
                        <div
                            class="flex h-65 w-full items-center justify-center bg-[linear-gradient(90deg,#2f2309_0%,#4a360a_50%,#2f2309_100%)] text-white/80 md:h-90">
                            <span class="text-[12px] uppercase tracking-[0.2em]">Service image</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Bottom related section --}}
        <div
            class="-mt-12 bg-[linear-gradient(90deg,#2f2309_0%,#4a360a_50%,#2f2309_100%)] pt-24 pb-16 md:-mt-16 md:pt-32 md:pb-20">
            <div class="mx-auto max-w-260 px-6 md:px-10 lg:px-12">
                <h2 class="text-center text-[42px] font-light leading-none text-[#e6c15a] md:text-[58px]">
                    More mortgages!
                </h2>

                <div class="mt-12 grid gap-8 md:mt-14 md:grid-cols-3 md:gap-4 lg:gap-6">
                    @foreach ($relatedServices as $item)
                        @php
                            $title = $item['title'] ?? '';
                            $url = $item['url'] ?? '#';
                            $image = is_array($item['image'] ?? null)
                                ? $item['image']['url'] ?? ''
                                : $item['image'] ?? '';
                            $buttonText = $item['button_text'] ?? 'Read More';
                        @endphp

                        <article class="group">
                            <a href="{{ esc_url($url) }}" class="block overflow-hidden bg-[#ddd]">
                                @if ($image)
                                    <img src="{{ esc_url($image) }}" alt="{{ esc_attr($title) }}"
                                        class="h-65 w-full object-cover transition duration-500 group-hover:scale-105" />
                                @else
                                    <div class="flex h-65 w-full items-center justify-center bg-white/10 text-white/70">
                                        <span class="text-[12px] uppercase tracking-[0.2em]">No image</span>
                                    </div>
                                @endif
                            </a>

                            <div class="pt-4">
                                <h3 class="text-[18px] font-light uppercase tracking-[0.04em] text-white md:text-[20px]">
                                    {{ $title }}
                                </h3>

                                <div class="mt-8">
                                    <a href="{{ esc_url($url) }}"
                                        class="inline-flex min-w-33 items-center justify-center bg-white px-6 py-3 text-[12px] uppercase tracking-[0.08em] text-[#3d2e12] transition hover:bg-[#e6c15a]">
                                        {{ $buttonText }}
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
