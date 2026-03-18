@extends('layouts.app')

@section('content')
    @php
        $wysiwygContent = get_field('post_content_wysiwyg') ?: get_the_content();
    @endphp

    <article @php(post_class('bg-[#f6f6f4]'))>
        <div class="mx-auto max-w-295 px-6 pb-16 pt-10 md:px-8 md:pb-20 md:pt-12 lg:px-10 lg:pb-24">
            {{-- Breadcrumbs --}}
            <div class="mb-8 text-[12px] leading-relaxed text-[#9f926f]">
                <a href="{{ home_url('/') }}" class="transition hover:opacity-80">Home</a>
                <span> - </span>

                <a href="{{ get_permalink(get_option('page_for_posts')) ?: home_url('/blog') }}"
                    class="transition hover:opacity-80">
                    Blog
                </a>
                <span> - </span>

                <span class="text-[#8a7d61]">{{ get_the_title() }}</span>
            </div>

            {{-- Hero --}}
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-[minmax(0,1fr)_420px] lg:items-start lg:gap-14">
                <div>
                    {{-- Date --}}
                    <div
                        class="mb-4 flex items-center gap-2 text-[11px] font-medium uppercase tracking-[0.04em] text-[#9a9488]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.25 w-3.25 shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z" />
                        </svg>

                        <time datetime="{{ get_the_date('c') }}">
                            {{ strtoupper(get_the_date('M j, Y')) }}
                        </time>
                    </div>

                    {{-- Title --}}
                    <h1
                        class="max-w-130 text-[40px] font-light leading-[1.08] tracking-[-0.03em] text-[#4a3910] sm:text-[48px] md:text-[58px] lg:text-[62px]">
                        {{ get_the_title() }}
                    </h1>
                </div>

                {{-- Featured image --}}
                <div>
                    @if (has_post_thumbnail())
                        <div class="overflow-hidden bg-[#eae4da]">
                            {!! get_the_post_thumbnail(get_the_ID(), 'large', [
                                'class' => 'h-auto w-full object-cover',
                                'loading' => 'eager',
                            ]) !!}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Content --}}
            <div class="mt-10 max-w-215 lg:mt-12">
                <div
                    class="blog-post-content prose prose-neutral max-w-none
          prose-p:text-[15px] prose-p:leading-[1.9] prose-p:text-[#6d675e]
          prose-headings:font-normal prose-headings:text-[#b78d2f]
          prose-h2:mt-10 prose-h2:mb-4 prose-h2:text-[20px]
          prose-h3:mt-8 prose-h3:mb-3 prose-h3:text-[18px]
          prose-strong:text-[#5f5648]
          prose-a:text-[#b78d2f] hover:prose-a:text-[#8f6a18]
          prose-ul:my-5 prose-ol:my-5
          prose-li:text-[15px] prose-li:leading-[1.9] prose-li:text-[#6d675e]
          prose-ol:pl-6 prose-ul:pl-6
          prose-blockquote:border-l-[#d8b15a] prose-blockquote:text-[#6d675e]">
                    {!! $wysiwygContent !!}
                </div>
            </div>
        </div>
    </article>
@endsection
