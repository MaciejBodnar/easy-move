{{--
  Template Name: Service Template
--}}

@php
    $homeUrl = home_url(‘ / ’);
    $homeLabel = get_bloginfo(‘name’);
@endphp

@extends('layouts.app')

@section('content')
    <section class="bg-[#efefef] text-[#3d2e12]">
        <div class="mx-auto max-w-260 px-6 pt-14 pb-0 md:px-10 md:pt-16 lg:px-12 lg:pt-20">
            <nav aria-label="Breadcrumb" class="mb-4 text-[18px] leading-none text-[#b9a36b]">
                <ol class="flex flex-wrap items-center gap-1">
                    <li>
                        <a href="{{ $homeUrl }}" class="transition hover:text-[#3d2e12]">
                            {{ $homeLabel }}
                        </a>
                    </li>

                    @if ($service['parentTitle'] && $service['parentUrl'])
                        <li aria-hidden="true">-</li>
                        <li>
                            <a href="{{ $service['parentUrl'] }}" class="transition hover:text-[#3d2e12]">
                                {{ $service['parentTitle'] }}
                            </a>
                        </li>
                    @endif

                    @if ($service['pageTitle'])
                        <li aria-hidden="true">-</li>
                        <li class="text-[#8b7a57]">
                            {{ $service['pageTitle'] }}
                        </li>
                    @endif
                </ol>
            </nav>

            <header class="max-w-195">
                <h1 class="text-[44px] font-light leading-[1.05] tracking-[-0.02em] md:text-[64px]">
                    {{ $service['pageTitle'] }}
                </h1>
            </header>

            <div class="mt-12 grid gap-8 md:mt-14 md:grid-cols-2 md:gap-10 lg:gap-14">
                <div class="text-[15px] leading-8 text-[#6d6047]">
                    <p>{{ $service['intro']['left'] }}</p>
                </div>

                <div class="text-[15px] leading-8 text-[#6d6047]">
                    <p>{{ $service['intro']['right'] }}</p>
                </div>
            </div>

            <div class="mt-10 md:mt-12">
                <p class="text-[18px] font-medium uppercase tracking-[0.06em] text-[#7b6944] md:text-[20px]">
                    {{ $service['highlight'] }}
                </p>
            </div>

            <div class="relative z-10 mt-12 md:mt-16">
                <div class="overflow-hidden bg-[#ddd]">
                    @if ($service['heroImage'])
                        <img src="{{ esc_url($service['heroImage']) }}" alt="{{ esc_attr($service['pageTitle']) }}"
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

        <div
            class="-mt-12 bg-[linear-gradient(90deg,#2f2309_0%,#4a360a_50%,#2f2309_100%)] pt-24 pb-16 md:-mt-16 md:pt-32 md:pb-20">
            <div class="mx-auto max-w-260 px-6 md:px-10 lg:px-12">
                <h2 class="text-center text-[42px] font-light leading-none text-[#e6c15a] md:text-[58px]">
                    More mortgages!
                </h2>

                <div class="mt-12 grid gap-8 md:mt-14 md:grid-cols-3 md:gap-4 lg:gap-6">
                    @foreach ($service['relatedServices'] as $item)
                        @php
                            $title = $item['title'] ?? '';
                            $url = $item['url'] ?? '#';
                            $image = is_array($item['image'] ?? null)
                                ? $item['image']['url'] ?? ''
                                : $item['image'] ?? '';
                            $buttonText = $item['button_text'] ?? 'Read More';
                        @endphp

                        <article class="group min-w-0">
                            <div class="relative block w-full">
                                <div class="pointer-events-none absolute top-1 left-1 h-96 w-full bg-[#F9CF6C]"
                                    aria-hidden="true"></div>

                                <a href="{{ esc_url($url) }}"
                                    class="relative z-10 block h-96 w-full overflow-hidden bg-[#ddd]">
                                    @if ($image)
                                        <img src="{{ esc_url($image) }}" alt="{{ esc_attr($title) }}"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                                    @else
                                        <div
                                            class="flex h-full w-full items-center justify-center bg-white/10 text-white/70">
                                            <span class="text-[12px] uppercase tracking-[0.2em]">No image</span>
                                        </div>
                                    @endif
                                </a>
                            </div>

                            <div class="pt-4">
                                <h3 class="text-[18px] font-light uppercase tracking-[0.04em] text-white md:text-[20px]">
                                    {{ $title }}
                                </h3>

                                <div class="mt-8">
                                    <a href="{{ esc_url($url) }}"
                                        class="inline-flex min-w-33 items-center justify-center px-6 py-3 text-[16px] uppercase tracking-[0.08em] text-[#3d2e12] transition bg-white hover:bg-[#DAD5C6] active:bg-[#BBAB79]">
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
                    {!! $service[‘cta’][‘heading’] !!}
                </h2>

                <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ esc_url($service[‘cta’][‘mortgageUrl’]) }}"
                        class="inline-flex min-w-35 items-center justify-center px-6 py-3 text-[16px] uppercase tracking-[0.08em] text-[#3d2e12] transition bg-white hover:bg-[#DAD5C6] active:bg-[#BBAB79]">
                        {{ $service[‘cta’][‘mortgageText’] }}
                    </a>

                    <a href="{{ esc_url($service[‘cta’][‘insuranceUrl’]) }}"
                        class="inline-flex min-w-35 items-center justify-center px-6 py-3 text-[16px] uppercase tracking-[0.08em] text-[#3d2e12] transition bg-[#F9CF6C] hover:bg-[#DAD5C6] active:bg-white">
                        {{ $service[‘cta’][‘insuranceText’] }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
