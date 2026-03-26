{{--
Template Name: Contact Template
--}}

@extends('layouts.app')

@section('content')
    <section class="">
        <div class="mx-auto max-w-295 px-6 pb-16 pt-10 md:px-8 md:pb-20 md:pt-14 lg:px-10 lg:pb-24">
            <div class="mb-3 text-[18px] text-[#b7a16a]">
                <a href="{{ home_url('/') }}" class="transition hover:opacity-80">Home</a>
                <span class="mx-1">-</span>
                <span class="text-[#7c6a3b]">{{ $contact['heading'] }}</span>
            </div>

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
                        @if ($contact['socialLinks']['facebook'])
                            <a href="{{ esc_url($contact['socialLinks']['facebook']) }}" aria-label="Facebook"
                                class="transition hover:opacity-80">
                                <i class="fa-brands fa-facebook-f text-[18px]"></i>
                            </a>
                        @endif

                        @if ($contact['socialLinks']['instagram'])
                            <a href="{{ esc_url($contact['socialLinks']['instagram']) }}" aria-label="Instagram"
                                class="transition hover:opacity-80">
                                <i class="fa-brands fa-instagram text-[18px]"></i>
                            </a>
                        @endif

                        @if ($contact['socialLinks']['linkedin'])
                            <a href="{{ esc_url($contact['socialLinks']['linkedin']) }}" aria-label="LinkedIn"
                                class="transition hover:opacity-80">
                                <i class="fa-brands fa-linkedin-in text-[18px]"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-14 md:mt-16">
                <h2 class="mb-8 text-[20px] font-normal text-[#b8841e]">
                    {{ $contact['formHeading'] }}
                </h2>

                <div class="contact-form-wrap">
                    {!! do_shortcode($contact['formShortcode']) !!}
                </div>
            </div>
        </div>
    </section>
    <section class="relative overflow-hidden min-h-135">
        <div class="absolute inset-0">
            <img src={{ $contact['banner']['image'] }} alt="Aerial view of homes" class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-[rgba(73,56,19,0.58)]"></div>
        </div>

        <div
            class="relative z-10 mx-auto flex min-h-90 max-w-181.5 items-center justify-center px-6 py-16 text-center md:min-h-135 md:px-10 lg:px-16">
            <div class="max-w-215">
                <h2 class="text-[42px] font-light leading-[1.15] text-white md:text-[60px]">
                    {!! $contact['banner']['content'] !!}
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
