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
                <span class="text-[#7c6a3b]">Contact</span>
            </div>

            <h1 class="mb-12 text-[40px] font-light leading-none tracking-[-0.02em] text-[#4a3910] md:mb-16 md:text-[56px]">
                Contact
            </h1>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3 md:gap-10 lg:gap-16">
                <div>
                    <h2 class="mb-6 text-[20px] font-normal text-[#b8841e]">
                        Head Office
                    </h2>

                    <div class="space-y-5 text-[18px] leading-[1.7] text-[#766f63]">
                        <div class="flex items-start gap-3">
                            <span class="mt-1 shrink-0 text-[#b7a16a]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7zm0 9.5A2.5 2.5 0 1112 6.5a2.5 2.5 0 010 5z" />
                                </svg>
                            </span>

                            <p>
                                Rose Garth, Kingston Avenue,<br>
                                Ripon, England, HG4 1TJ
                            </p>
                        </div>
                    </div>
                </div>

                <div class="md:pt-13">
                    <div class="space-y-3 text-[18px] leading-[1.7] text-[#766f63]">
                        <a href="tel:07555641081" class="flex items-center gap-3 transition hover:opacity-80">
                            <span class="shrink-0 text-[#b7a16a]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M2.003 5.884l3.172-.793a1 1 0 011.11.417l1.518 2.53a1 1 0 01-.241 1.287l-1.547 1.236a11.042 11.042 0 005.292 5.292l1.236-1.547a1 1 0 011.287-.241l2.53 1.518a1 1 0 01.417 1.11l-.793 3.172a1 1 0 01-.97.757C7.477 20 0 12.523 0 3.97a1 1 0 01.757-.97h1.246z" />
                                </svg>
                            </span>
                            <span>07555 641 081</span>
                        </a>

                        <a href="mailto:tomasz@emove-fs.co.uk" class="flex items-center gap-3 transition hover:opacity-80">
                            <span class="shrink-0 text-[#b7a16a]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path d="M2.94 6.34A2 2 0 014.5 5.5h11a2 2 0 011.56.84L10 10.88 2.94 6.34z" />
                                    <path
                                        d="M18 8.12l-7.46 4.79a1 1 0 01-1.08 0L2 8.12V13.5a2 2 0 002 2h12a2 2 0 002-2V8.12z" />
                                </svg>
                            </span>
                            <span>tomasz@emove-fs.co.uk</span>
                        </a>
                    </div>
                </div>

                <div class="md:pt-13">
                    <div class="flex items-center gap-6 text-[#b7a16a]">
                        <a href="#" aria-label="Facebook" class="transition hover:opacity-80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.9.3-1.6 1.6-1.6h1.7V4.8c-.3 0-1.3-.1-2.5-.1-2.5 0-4.3 1.5-4.3 4.4V11H7v3h2.5v8h4z" />
                            </svg>
                        </a>

                        <a href="#" aria-label="Instagram" class="transition hover:opacity-80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2.2A2.8 2.8 0 004.2 7v10A2.8 2.8 0 007 19.8h10a2.8 2.8 0 002.8-2.8V7A2.8 2.8 0 0017 4.2H7zm10.25 1.65a.85.85 0 110 1.7.85.85 0 010-1.7zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2.2A2.8 2.8 0 1014.8 12 2.8 2.8 0 0012 9.2z" />
                            </svg>
                        </a>

                        <a href="#" aria-label="LinkedIn" class="transition hover:opacity-80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M6.94 8.5H3.56V20h3.38V8.5zM5.25 3A2 2 0 103 5a2 2 0 002.25-2zM20.44 13.03c0-3.44-1.84-5.03-4.29-5.03-1.98 0-2.87 1.09-3.36 1.85V8.5H9.41c.04.89 0 11.5 0 11.5h3.38v-6.42c0-.34.02-.68.13-.92.27-.68.87-1.39 1.89-1.39 1.33 0 1.86 1.01 1.86 2.49V20h3.38z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-14 md:mt-16">
                <h2 class="mb-8 text-[20px] font-normal text-[#b8841e]">
                    Leave a message
                </h2>

                <div class="contact-form-wrap">
                    {!! do_shortcode('[contact-form-7 id="98d3aa4" title="Contact"]') !!}
                </div>
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
