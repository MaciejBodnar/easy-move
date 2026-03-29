{{--
  Template Name: Service List Template
--}}

@extends('layouts.app')

@section('content')
    <section class="text-[#3d2e12]">
        <div class="mx-auto max-w-260 px-6 py-14 md:px-10 md:py-16 lg:px-12 lg:py-20">
            <nav aria-label="Breadcrumb" class="mb-4 text-[18px] leading-none text-[#b9a36b]">
                <ol class="flex flex-wrap items-center gap-1">
                    @php
                        $breadcrumbItems = $services['breadcrumb']['items'] ?? [];
                        $lastBreadcrumbIndex = count($breadcrumbItems) - 1;
                    @endphp
                    @foreach ($breadcrumbItems as $index => $breadcrumbItem)
                        @if ($index > 0)
                            <li aria-hidden="true">-</li>
                        @endif
                        <li>
                            @if ($index === $lastBreadcrumbIndex)
                                <span class="text-[#8b7a57]">{{ $breadcrumbItem['label'] ?? '' }}</span>
                            @else
                                <a href="{{ $breadcrumbItem['url'] ?? '#' }}" class="transition hover:text-[#3d2e12]">
                                    {{ $breadcrumbItem['label'] ?? '' }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>

            <header class="mb-12 md:mb-16">
                <h1 class="text-[44px] font-light leading-none tracking-[-0.02em] md:text-[64px]">
                    {{ $services['pageTitle'] ?? get_the_title() }}
                </h1>
            </header>

            <div class="space-y-8 md:space-y-10">
                @foreach ($services['items'] ?? [] as $item)
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
                        <div class="overflow-hidden">
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
