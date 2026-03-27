{{--
  Template Name: Pricacy Policy Template
--}}


@extends('layouts.app')

@section('content')
    <article>
        <div class="mx-auto max-w-295 px-6 pb-16 pt-10 md:px-8 md:pb-20 md:pt-12 lg:px-10 lg:pb-24">
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
                {!! $policy['content'] !!}
            </div>
        </div>
    </article>
@endsection
