{{--
Template Name: Contact Template
--}}

@extends('layouts.app')

@section('content')
    <section class="">
        <div class="mx-auto max-w-295 px-6 pb-16 pt-10 md:px-8 md:pb-20 md:pt-14 lg:px-10 lg:pb-24">
            <nav aria-label="Breadcrumb" class="mb-4 text-[18px] leading-none text-[#b9a36b]">
                <ol class="flex flex-wrap items-center gap-1">
                    @php
                        $breadcrumbItems = $contact['breadcrumb']['items'] ?? [];
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

            <h1 class="mb-12 text-[40px] font-light leading-none tracking-[-0.02em] text-[#4a3910] md:mb-16 md:text-[56px]">
                {{ $contact['heading'] }}
            </h1>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3 md:gap-10 lg:gap-16">
                <div>
                    <h2 class="mb-6 text-[20px] font-normal text-[#b8841e]">
                        {{ $contact['office']['heading'] }}
                    </h2>

                    <div class="space-y-5 text-[18px] leading-[1.7] text-[#766f63]">
                        <div class="flex items-start gap-3">
                            <span class="mt-1 shrink-0 text-[#b7a16a]">
                                <i class="fa-solid fa-location-dot text-[20px]"></i>
                            </span>

                            <p>
                                {!! $contact['office']['address'] !!}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="md:pt-13">
                    <div class="space-y-3 text-[18px] leading-[1.7] text-[#766f63]">
                        <a href="tel:{{ preg_replace('/\s+/', '', $contact['phone']) }}"
                            class="flex items-center gap-3 transition hover:opacity-80">
                            <span class="shrink-0 text-[#b7a16a]">
                                <i class="fa-solid fa-phone text-[16px]"></i>
                            </span>
                            <span>{{ $contact['phone'] }}</span>
                        </a>

                        <a href="mailto:{{ $contact['email'] }}"
                            class="flex items-center gap-3 transition hover:opacity-80">
                            <span class="shrink-0 text-[#b7a16a]">
                                <i class="fa-solid fa-envelope text-[16px]"></i>
                            </span>
                            <span>{{ $contact['email'] }}</span>
                        </a>
                    </div>
                </div>

                <div class="md:pt-13">
                    <div class="flex items-center gap-6 text-[#b7a16a]">
                        @foreach ($contact['socialLinks'] ?? [] as $socialLink)
                            <a href="{{ esc_url($socialLink['url'] ?? '#') }}" aria-label="Social link"
                                class="transition hover:opacity-80">
                                {!! $socialLink['icon_class'] ?? '' !!}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-14 md:mt-16">
                <h2 class="mb-8 text-[20px] font-normal text-[#b8841e]">
                    {{ $contact['formHeading'] }}
                </h2>

                <div class="contact-form-wrap">
                    @if (function_exists('pll_current_language'))
                        @if (pll_current_language() === 'pl')
                            {!! do_shortcode($contact['formShortcodePL']) !!}
                        @else
                            {!! do_shortcode($contact['formShortcode']) !!}
                        @endif
                    @else
                        {!! do_shortcode($contact['formShortcode']) !!}
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="relative overflow-hidden">
        <div class="absolute inset-0">
            <video class="h-full w-full object-cover" autoplay muted loop playsinline preload="metadata"
                poster="{{ $contact['banner']['videoPoster'] }}" aria-hidden="true">
                <source src="{{ esc_url($contact['banner']['video']) }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-[rgba(73,56,19,0.58)]"></div>
        </div>

        <div
            class="relative z-10 mx-auto flex min-h-90 max-w-7xl items-center justify-center px-6 py-16 text-center md:min-h-135 md:px-10 lg:px-16">
            <div class="max-w-215">
                <h2 class="text-[42px] font-light leading-[1.15] text-white md:text-[60px]">
                    {!! $contact['banner']['content'] ?? 'Your home. Your family. Your future.<br />Let\’s protect it together.' !!}
                </h2>
            </div>
        </div>
    </section>
@endsection




{{-- <div class="cf7-contact-form">
  <div class="cf7-grid">
    <div class="cf7-field">
      <label>Name</label>
      [text* first-name autocomplete:given-name]
    </div>

    <div class="cf7-field">
      <label>Surname</label>
      [text* last-name autocomplete:family-name]
    </div>

    <div class="cf7-field">
      <label>Contact number</label>
      [tel* phone autocomplete:tel]
    </div>

    <div class="cf7-field">
      <label>Email</label>
      [email* your-email autocomplete:email]
    </div>
  </div>

  <div class="cf7-field cf7-field-full">
    <label>Message</label>
    [textarea* your-message 8x10]
  </div>

  <div class="cf7-consent">
    [acceptance your-consent] I hereby agree that this data will be stored and processed for the purpose of establishing contact. I am aware that I can revoke my consent at any time. [/acceptance]
  </div>

  <div class="cf7-submit-wrap">
    [submit "SEND"]
  </div>
</div> --}}
