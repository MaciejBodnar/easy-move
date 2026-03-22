{{--
  Template Name: About Template
--}}

@extends('layouts.app')

@section('content')
    <div class="bg-[#f6f6f4] text-[#4b3b12]">
        <section class="mx-auto max-w-275 px-6 pb-0 pt-10 md:px-8 md:pt-14 lg:px-10">
            <div class="mb-4 text-[18px] text-[#b7a16a] md:mb-6">
                <a href="{{ home_url('/') }}" class="transition hover:opacity-80">Home</a>
                <span class="mx-1">-</span>
                <span class="text-[#7c6a3b]">About us</span>
            </div>

            <h1 class="mb-10 text-[40px] font-light leading-none tracking-[-0.02em] text-[#4a3910] md:mb-14 md:text-[56px]">
                About us
            </h1>

            <div class="grid grid-cols-1 gap-y-10 gap-x-12 md:grid-cols-2 lg:gap-x-20">
                <div>
                    <div class="mb-10">
                        <h2 class="mb-4 text-[24px] font-medium uppercase tracking-[0.08em] text-[#4a3910]">
                            Why us?
                        </h2>
                        <p class="max-w-117.5 text-[17px] leading-[1.9] text-[#857867]">
                            We are passionate and experienced financial advisors dedicated to helping individuals and
                            families
                            achieve their financial goals through strategic mortgage and planning. By using our services,
                            you gain
                            access to personalised advice and a wide range of mortgage options. Choosing our services
                            ensures that
                            your dreams of owning a home will be fulfilled by trusted professionals.
                        </p>
                    </div>

                    <div>
                        <h2 class="mb-4 text-[24px] font-medium uppercase tracking-[0.08em] text-[#4a3910]">
                            How can we help?
                        </h2>
                        <p class="max-w-117.5 text-[17px] leading-[1.9] text-[#857867]">
                            We understand that navigating the path to homeownership can be overwhelming. Whether you’re a
                            first-time
                            buyer or looking to refinance, our team of experts is here to guide you every step of the way.
                            Need a
                            free, personalised consultation? We’re happy to answer any of your questions.
                        </p>
                    </div>
                </div>

                <div>
                    <h2 class="mb-4 text-[24px] font-medium uppercase tracking-[0.08em] text-[#4a3910]">
                        Our mission
                    </h2>

                    <p class="mb-5 max-w-117.5 text-[18px] font-semibold leading-[1.8] text-[#7d705d]">
                        Provide exceptional mortgage solutions tailored to each client’s unique needs, ensuring a seamless
                        and
                        empowering experience on their journey to homeownership
                    </p>

                    <p class="max-w-117.5 text-[17px] leading-[1.9] text-[#857867]">
                        Empowering individuals and families to achieve their dreams of homeownership is at the heart of our
                        mission. By offering personalised mortgage solutions tailored to your specific needs and goals, we
                        strive
                        to provide a seamless and rewarding experience. With a commitment to transparency, expertise and
                        unwavering support, we aim to guide you through every step of the process, ensuring your journey to
                        owning
                        a home is as smooth and successful as possible.
                    </p>
                </div>
            </div>
        </section>

        <section class="relative mt-50 bg-[#3c2c05] pb-0 pt-27.5 lg:pt-45">
            <div
                class="absolute left-1/2 top-0 z-10 w-full max-w-275 -translate-x-1/2 -translate-y-[28%] px-6 md:px-8 lg:px-10">
                <div class="overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.18)]">
                    <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=1600&auto=format&fit=crop"
                        alt="Mortgage advisor meeting with clients" class="h-55 w-full object-cover md:h-80 lg:h-90">
                </div>
            </div>

            <div class="mx-auto max-w-275 px-6 md:px-8 lg:px-10">
                <div class="text-center">
                    <h2 class="text-[42px] font-light leading-tight text-white md:text-[56px]">
                        Why choose us?
                    </h2>
                </div>

                <div class="mt-14 grid grid-cols-1 gap-10 pb-14 md:mt-16 md:grid-cols-3 md:gap-6 lg:gap-10 lg:pb-16">
                    <div class="border-t border-[rgba(232,194,98,0.28)] pt-8 text-center md:text-left">
                        <div class="mb-5 flex justify-center md:justify-start">
                            <div class="flex h-14 w-14 items-center justify-center text-[#f0c75b]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.625 9h6.75M8.625 12.75h4.5M7.5 19.5l-3 1.5V6.75A2.25 2.25 0 016.75 4.5h10.5a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25H10.5L7.5 19.5z" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="mb-3 text-[26px] font-medium uppercase tracking-[0.06em] text-white">
                            We listen
                        </h3>

                        <p class="text-[16px] leading-[1.8] text-[#b7aa8a]">
                            Your goals, your story, your future.
                        </p>
                    </div>

                    <div class="border-t border-[rgba(232,194,98,0.28)] pt-8 text-center md:text-left">
                        <div class="mb-5 flex justify-center md:justify-start">
                            <div class="flex h-14 w-14 items-center justify-center text-[#f0c75b]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75h.008v.008H12V6.75zM10.5 10.5h1.5v4.5h1.5M3.75 15.75l4.28-1.07a2.25 2.25 0 011.01 0l2.46.615a2.25 2.25 0 00.91 0l4.688-1.172a1.875 1.875 0 012.322 1.819V16.5a1.5 1.5 0 01-1.136 1.455l-6.14 1.535a6.75 6.75 0 01-2.877.07l-5.518-1.104V15.75zM7.5 15V9.75A2.25 2.25 0 019.75 7.5h4.5a2.25 2.25 0 012.25 2.25V12" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="mb-3 text-[26px] font-medium uppercase tracking-[0.06em] text-white">
                            We simplify
                        </h3>

                        <p class="text-[16px] leading-[1.8] text-[#b7aa8a]">
                            Clear advice, no jargon, tailored options.
                        </p>
                    </div>

                    <div class="border-t border-[rgba(232,194,98,0.28)] pt-8 text-center md:text-left">
                        <div class="mb-5 flex justify-center md:justify-start">
                            <div class="flex h-14 w-14 items-center justify-center text-[#f0c75b]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3v18M12 5.25h6.878a.75.75 0 01.53 1.28L16.5 9.438l2.908 2.908a.75.75 0 01-.53 1.28H12m0-8.376H6.375a.75.75 0 00-.53 1.28L8.25 9l-2.405 2.47a.75.75 0 00.53 1.28H12" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="mb-3 text-[26px] font-medium uppercase tracking-[0.06em] text-white">
                            We guide
                        </h3>

                        <p class="text-[16px] leading-[1.8] text-[#b7aa8a]">
                            From application to approval (and beyond).
                        </p>
                    </div>
                </div>

                <div class="bg-[#e4bf62] px-5 py-5 md:px-8">
                    <div class="flex flex-col items-center justify-center gap-3 text-center md:flex-row md:gap-8">
                        <span class="text-[20px] font-medium uppercase tracking-[0.08em] text-[#4a3910]">
                            Give us a call
                        </span>

                        <a href="tel:07555641081"
                            class="inline-flex items-center gap-2 text-[16px] font-medium text-[#4a3910] transition hover:opacity-80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2.003 5.884l3.172-.793a1 1 0 011.11.417l1.518 2.53a1 1 0 01-.241 1.287l-1.547 1.236a11.042 11.042 0 005.292 5.292l1.236-1.547a1 1 0 011.287-.241l2.53 1.518a1 1 0 01.417 1.11l-.793 3.172a1 1 0 01-.97.757C7.477 20 0 12.523 0 3.97a1 1 0 01.757-.97h1.246z" />
                            </svg>
                            07555 641 081
                        </a>

                        <span class="text-[15px] text-[#4a3910]">
                            Open Mon-Fri, 9:00-17:00
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-[#f6f6f4]">
            <div class="mx-auto max-w-350 px-6 pb-16 pt-16 md:px-8 md:pb-20 md:pt-20 lg:px-10 lg:pb-24">
                <div class="mx-auto max-w-245 text-center">
                    <h2
                        class="text-[38px] font-light leading-tight tracking-[-0.02em] text-[#4a3910] md:text-[56px] lg:text-[64px]">
                        What our customers are saying…
                    </h2>
                </div>

                <div class="relative mt-10 md:mt-14">
                    {!! do_shortcode('[your-testimonials-plugin-shortcode]') !!}
                </div>
            </div>

            <div class="relative overflow-hidden bg-[#3c2c05]">
                <div
                    class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_20%_50%,rgba(196,150,37,0.22),transparent_28%),radial-gradient(circle_at_50%_50%,rgba(196,150,37,0.18),transparent_30%),radial-gradient(circle_at_80%_50%,rgba(196,150,37,0.22),transparent_28%)]">
                </div>

                <div class="pointer-events-none absolute inset-0 flex items-center justify-center opacity-[0.08]">
                    <div
                        class="select-none text-[180px] font-light tracking-[0.18em] text-[#e0b84f] md:text-[260px] lg:text-[340px]">
                        B M
                    </div>
                </div>

                <div class="relative mx-auto max-w-300 px-6 py-14 md:px-8 md:py-20 lg:px-10 lg:py-24">
                    <div class="grid grid-cols-2 gap-y-10 text-center md:grid-cols-4 md:gap-x-8">
                        <div>
                            <div class="text-[48px] font-light leading-none text-[#f0c75b] md:text-[62px]">
                                15
                            </div>
                            <p
                                class="mt-4 text-[18px] uppercase leading-[1.45] tracking-[0.08em] text-white md:text-[20px]">
                                Years of <br class="hidden sm:block"> experience
                            </p>
                        </div>

                        <div>
                            <div class="text-[48px] font-light leading-none text-[#f0c75b] md:text-[62px]">
                                100
                            </div>
                            <p
                                class="mt-4 text-[18px] uppercase leading-[1.45] tracking-[0.08em] text-white md:text-[20px]">
                                Lenders available
                            </p>
                        </div>

                        <div>
                            <div class="text-[48px] font-light leading-none text-[#f0c75b] md:text-[62px]">
                                8000
                            </div>
                            <p
                                class="mt-4 text-[18px] uppercase leading-[1.45] tracking-[0.08em] text-white md:text-[20px]">
                                Different <br class="hidden sm:block"> mortgages
                            </p>
                        </div>

                        <div>
                            <div class="text-[48px] font-light leading-none text-[#f0c75b] md:text-[62px]">
                                100%
                            </div>
                            <p
                                class="mt-4 text-[18px] uppercase leading-[1.45] tracking-[0.08em] text-white md:text-[20px]">
                                Happy <br class="hidden sm:block"> customers
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
