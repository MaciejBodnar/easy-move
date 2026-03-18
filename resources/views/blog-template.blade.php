{{--
Template Name: Blog Template
--}}

@extends('layouts.app')

@section('content')
    @php
        $paged = max(1, get_query_var('paged'), get_query_var('page'));

        $blogQuery = new WP_Query([
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 9,
            'paged' => $paged,
        ]);
    @endphp

    <section class="bg-[#f6f6f4]">
        <div class="mx-auto max-w-295 px-6 pb-16 pt-10 md:px-8 md:pb-20 md:pt-14 lg:px-10 lg:pb-24">
            <div class="mb-3 text-[12px] text-[#b7a16a]">
                <a href="{{ home_url('/') }}" class="transition hover:opacity-80">Home</a>
                <span class="mx-1">-</span>
                <span class="text-[#7c6a3b]">Blog</span>
            </div>

            <h1 class="mb-10 text-[40px] font-light leading-none tracking-[-0.02em] text-[#4a3910] md:mb-14 md:text-[56px]">
                Blog
            </h1>

            @if ($blogQuery->have_posts())
                <div class="grid grid-cols-1 gap-x-4 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-5 lg:gap-y-12">
                    @while ($blogQuery->have_posts())
                        @php($blogQuery->the_post())
                        <article @php(post_class('group'))>
                            <a href="{{ get_permalink() }}" class="block">
                                <div class="overflow-hidden border-b-[3px] border-[#e1bf68] bg-[#ece8e1]">
                                    @if (has_post_thumbnail())
                                        {!! get_the_post_thumbnail(get_the_ID(), 'large', [
                                            'class' =>
                                                'h-[220px] w-full object-cover transition duration-500 group-hover:scale-[1.03] md:h-[200px] lg:h-[205px]',
                                            'loading' => 'lazy',
                                        ]) !!}
                                    @else
                                        <div
                                            class="flex h-55 w-full items-center justify-center bg-[#ddd7ce] text-[#8f8678] md:h-50 lg:h-51.25">
                                            <span class="text-sm uppercase tracking-[0.08em]">No image</span>
                                        </div>
                                    @endif
                                </div>
                            </a>

                            <div
                                class="mt-4 flex items-center gap-2 text-[11px] font-medium uppercase tracking-[0.06em] text-[#9a9488]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.25 w-3.25 shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                </svg>

                                <time datetime="{{ get_the_date('c') }}">
                                    {{ strtoupper(get_the_date('M j, Y')) }}
                                </time>
                            </div>

                            <h2
                                class="mt-3 max-w-[95%] text-[18px] font-normal leading-[1.55] text-[#6a6257] md:text-[17px] lg:text-[18px]">
                                <a href="{{ get_permalink() }}" class="transition hover:text-[#4a3910]">
                                    {{ get_the_title() }}
                                </a>
                            </h2>

                            <div class="mt-5">
                                <a href="{{ get_permalink() }}"
                                    class="inline-flex min-h-11 items-center justify-center bg-[#efede8] px-5 py-3 text-[14px] font-medium uppercase tracking-[0.03em] text-[#4a3910] transition hover:bg-[#e4dfd5]">
                                    Read more
                                </a>
                            </div>
                        </article>
                    @endwhile
                </div>

                @if ($blogQuery->max_num_pages > 1)
                    <div class="mt-16 flex items-center justify-center">
                        {!! paginate_links([
                            'total' => $blogQuery->max_num_pages,
                            'current' => $paged,
                            'mid_size' => 2,
                            'prev_text' => '‹',
                            'next_text' => '›',
                        ]) !!}
                    </div>
                @endif

                @php(wp_reset_postdata())
            @else
                <div class="py-10">
                    <p class="text-[18px] text-[#6f675a]">No posts found.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
