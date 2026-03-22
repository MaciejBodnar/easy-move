{{--
  Template Name: Service List Template
--}}

@php
    /**
     * Generic reusable breadcrumb items
     */
    $homeUrl = home_url('/');
    $homeLabel = get_bloginfo('name');

    /**
     * Example fallback data.
     * Replace with ACF/get_field() data if needed.
     */
    $mortgageItems =
        function_exists('get_field') && get_field('mortgage_items')
            ? get_field('mortgage_items')
            : [
                [
                    'title' => 'First Time Buyer',
                    'text' =>
                        'First-time buyers often face challenges such as saving for a down payment, understanding mortgage options and managing credit scores. Affordability concerns, navigating the home search process and budgeting for closing costs are also common issues. Additionally, understanding legal aspects, managing emotional stress and evaluating property conditions are critical considerations.',
                    'button' => [
                        'title' => 'Read More',
                        'url' => '#',
                    ],
                    'image' =>
                        'https://images.unsplash.com/photo-1600585154526-990dced4db0d?q=80&w=1200&auto=format&fit=crop',
                ],
                [
                    'title' => 'Remortgage',
                    'text' =>
                        'Remortgagors commonly encounter challenges such as understanding various refinancing options, navigating changes in interest rates, and managing associated fees and closing costs. Assessing the potential benefits versus costs, managing documentation and legal aspects, and ensuring the process aligns with financial goals must also be taken into account.',
                    'button' => [
                        'title' => 'Read More',
                        'url' => '#',
                    ],
                    'image' =>
                        'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1200&auto=format&fit=crop',
                ],
                [
                    'title' => 'Home Movers Mortgage',
                    'text' =>
                        'One of the main concerns people looking for residential mortgage may have is getting the best interest rates and affordable monthly payments, understanding loan terms, job stability, current market conditions and overall impact on their financial future.',
                    'button' => [
                        'title' => 'Read More',
                        'url' => '#',
                    ],
                    'image' =>
                        'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=1200&auto=format&fit=crop',
                ],
                [
                    'title' => 'Buy to Let',
                    'text' =>
                        'When considering a buy-to-let mortgage, you might be concerned about securing favourable interest rates and managing higher deposit requirements. Ensuring that your rental income will cover mortgage payments and other expenses is crucial.',
                    'button' => [
                        'title' => 'Read More',
                        'url' => '#',
                    ],
                    'image' =>
                        'https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=1200&auto=format&fit=crop',
                ],
            ];

    /**
     * Current page title
     */
    $pageTitle = get_the_title();
@endphp

@extends('layouts.app')

@section('content')
    <section class="bg-[#efefef] text-[#3d2e12]">
        <div class="mx-auto max-w-260 px-6 py-14 md:px-10 md:py-16 lg:px-12 lg:py-20">
            <nav aria-label="Breadcrumb" class="mb-4 text-[18px] leading-none text-[#8b7a57]">
                <ol class="flex flex-wrap items-center gap-1">
                    <li>
                        <a href="{{ $homeUrl }}" class="transition hover:text-[#b89a56]">
                            {{ $homeLabel }}
                        </a>
                    </li>

                    @if (!empty($pageTitle))
                        <li aria-hidden="true">-</li>
                        <li class="text-[#6d6047]">
                            {{ $pageTitle }}
                        </li>
                    @endif
                </ol>
            </nav>

            <header class="mb-12 md:mb-16">
                <h1 class="text-[44px] font-light leading-none tracking-[-0.02em] md:text-[64px]">
                    {{ $pageTitle }}
                </h1>
            </header>

            <div class="space-y-8 md:space-y-10">
                @foreach ($mortgageItems as $item)
                    @php
                        $itemTitle = $item['title'] ?? '';
                        $itemText = $item['text'] ?? '';
                        $itemImage = is_array($item['image'] ?? null)
                            ? $item['image']['url'] ?? ''
                            : $item['image'] ?? '';

                        $buttonTitle = $item['button']['title'] ?? 'Read More';
                        $buttonUrl = $item['button']['url'] ?? '#';
                    @endphp

                    <article
                        class="grid gap-20 md:grid-cols-[280px_minmax(0,1fr)] md:gap-34 lg:grid-cols-[320px_minmax(0,1fr)]">
                        <div class="overflow-hidden bg-[#ddd]">
                            @if ($itemImage)
                                <img src="{{ esc_url($itemImage) }}" alt="{{ esc_attr($itemTitle) }}"
                                    class="h-65 w-full md:w-87.5 object-cover md:h-96" />
                            @else
                                <div
                                    class="flex h-65 w-full items-center justify-center bg-[linear-gradient(90deg,#2f2309_0%,#4a360a_50%,#2f2309_100%)] text-white/80 md:h-96">
                                    <span class="text-[12px] uppercase tracking-[0.2em]">No image</span>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col justify-center pt-1 md:max-w-130">
                            <h2 class="text-[20px] font-light uppercase tracking-[0.04em]">
                                {{ $itemTitle }}
                            </h2>

                            <div class="mt-4 text-[18px] leading-8 text-[#7D7564]">
                                <p>{{ $itemText }}</p>
                            </div>

                            <div class="mt-6">
                                <a href="{{ esc_url($buttonUrl) }}"
                                    class="inline-flex min-w-33 items-center justify-center px-6 py-3 text-[16px] uppercase tracking-[0.08em] text-[#3d2e12] transition bg-[#F9CF6C] hover:bg-[#DAD5C6] active:bg-white">
                                    {{ $buttonTitle }}
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
