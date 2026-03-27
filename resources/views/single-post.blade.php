@extends('layouts.app')

@section('content')
    <article @php(post_class(''))>
        <div class="mx-auto max-w-295 px-6 pb-16 pt-10 md:px-8 md:pb-20 md:pt-12 lg:px-10 lg:pb-24">
            <div class="mb-8 text-[18px] leading-relaxed text-[#9f926f]">
                <a href="{{ home_url('/') }}" class="transition hover:opacity-80">Home</a>
                <span> - </span>

                <a href="{{ $post['blogUrl'] }}" class="transition hover:opacity-80">
                    Blog
                </a>
                <span> - </span>

                <span class="text-[#8a7d61]">{{ $post['title'] }}</span>
            </div>

            <div class="grid grid-cols-1 gap-10 lg:grid-cols-[minmax(0,1fr)_420px] lg:items-start lg:gap-14">
                <div>
                    <div
                        class="mb-4 flex items-center gap-2 text-[12px] font-medium uppercase tracking-[0.04em] text-[#9a9488]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.25 w-4.25 shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z" />
                        </svg>

                        <time datetime="{{ $post['date'] }}">
                            {{ $post['dateFormatted'] }}
                        </time>
                    </div>

                    <h1
                        class="max-w-130 text-[40px] font-light leading-[1.08] tracking-[-0.03em] text-[#4a3910] sm:text-[48px] md:text-[58px] lg:text-[62px]">
                        {{ $post['title'] }}
                    </h1>
                </div>

                <div>
                    @if ($post['thumbnail'])
                        <div class="overflow-hidden bg-[#eae4da]">
                            {!! $post['thumbnail'] !!}
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-10 w-full lg:mt-12">
                <div
                    class="blog-post-content prose prose-neutral max-w-none
          prose-headings:font-normal prose-headings:text-[#b78d2f]
          prose-h2:mt-10 prose-h2:mb-4 prose-h2:text-[28px]
          prose-h3:mt-8 prose-h3:mb-3 prose-h3:text-[24px]
          prose-strong:text-[#5f5648]
          prose-a:text-[#b78d2f] hover:prose-a:text-[#8f6a18]
          prose-ul:my-5 prose-ol:my-5
          prose-ol:pl-8 prose-ul:pl-8
          prose-blockquote:border-l-[#d8b15a]">
                    {!! $post['content'] !!}
                </div>
            </div>
        </div>
    </article>
@endsection
