@php
    $currentLang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
    $langPrefix = $currentLang === 'pl' ? 'pl' : 'en';

    $optionField = static function ($fieldName, $fallback = null) {
        if (!function_exists('get_field')) {
            return $fallback;
        }

        $value = get_field($fieldName, 'option');

        return !empty($value) ? $value : $fallback;
    };

    $sharedPhone = $optionField('hf_shared_phone', '07555 641 081');
    $sharedEmail = $optionField('hf_shared_email', 'tomasz@emove-fs.co.uk');

    $phone = $optionField("hf_{$langPrefix}_header_phone", $sharedPhone);
    $phoneHref = preg_replace('/\s+/', '', $phone);
    $email = $optionField("hf_{$langPrefix}_header_email", $sharedEmail);

    $socialLinks = $optionField('hf_shared_socials', []);

    if (empty($socialLinks) || !is_array($socialLinks)) {
        $socialLinks = [
            ['label' => 'Facebook', 'url' => '#', 'icon_class' => '<i class="fa-brands fa-facebook-f"></i>'],
            ['label' => 'Instagram', 'url' => '#', 'icon_class' => '<i class="fa-brands fa-instagram"></i>'],
            ['label' => 'LinkedIn', 'url' => '#', 'icon_class' => '<i class="fa-brands fa-linkedin-in"></i>'],
        ];
    }

    $officeTitle = $optionField("hf_{$langPrefix}_footer_office_title", 'Head Office');
    $officeAddress = $optionField(
        "hf_{$langPrefix}_footer_office_address",
        'Rose Garth, Kingston Avenue,<br>Ripon, England, HG4 1TJ',
    );

    $footerColumns = $optionField("hf_{$langPrefix}_footer_columns", []);

    if (empty($footerColumns) || !is_array($footerColumns)) {
        $footerColumns = [
            [
                'title' => 'Mortgages',
                'links' => [
                    ['label' => 'First time buyer', 'url' => '#'],
                    ['label' => 'Remortgage', 'url' => '#'],
                    ['label' => 'Home movers mortgage', 'url' => '#'],
                    ['label' => 'Buy to let', 'url' => '#'],
                ],
            ],
            [
                'title' => 'Insurance',
                'links' => [
                    ['label' => 'Income protection insurance', 'url' => '#'],
                    ['label' => 'Critical illness insurance', 'url' => '#'],
                    ['label' => 'Home insurance', 'url' => '#'],
                    ['label' => 'Life insurance', 'url' => '#'],
                ],
            ],
            [
                'title' => 'Company',
                'links' => [
                    ['label' => 'About us', 'url' => home_url('/about-us')],
                    ['label' => 'Blog', 'url' => home_url('/blog')],
                    ['label' => 'Google Reviews', 'url' => '#'],
                ],
            ],
        ];
    }

    $legalParagraphs = $optionField("hf_{$langPrefix}_footer_legal", []);

    if (empty($legalParagraphs) || !is_array($legalParagraphs)) {
        $legalParagraphs = [
            [
                'text' =>
                    'Easy Move Mortgages Ltd is authorised and regulated by the Financial Conduct Authority. FCA Authorisation of Easy Move Mortgages Limited 1041296. Registered in England No. 13924041.',
            ],
            [
                'text' =>
                    'Registered office address for Easy Move Mortgages Ltd is Rose Garth, Kingston Avenue, Ripon, England, HG4 1TJ.',
            ],
            [
                'text' =>
                    'The information on this site is for general guidance only and is subject to UK regulation and legislation. It is therefore restricted to consumers based in the UK.',
            ],
        ];
    }

    $copyrightText = $optionField(
        "hf_{$langPrefix}_footer_copyright",
        '© 2026 Easy Move Mortgages Limited - D&C with SLT Media',
    );
    $privacyLabel = $optionField("hf_{$langPrefix}_footer_privacy_label", 'Privacy Policy');
    $privacyUrl = $optionField("hf_{$langPrefix}_footer_privacy_url", home_url('/privacy-policy'));
@endphp

<footer class="mt-auto">
    <div class="bg-[#564A2C] text-[#c7ad6a]">
        <div class="mx-auto max-w-295 px-6 py-14 md:px-8 md:py-16 lg:px-10 lg:py-20">
            <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-4 lg:gap-8">
                <div>
                    <h3 class="mb-8 text-[18px] font-normal text-[#efc75d]">
                        {{ $officeTitle }}
                    </h3>

                    <div class="space-y-5 text-[17px] leading-[1.7] text-[#c7b07a]">
                        <div class="flex items-start gap-3">
                            <span class="mt-1 shrink-0 text-[#c7ad6a]">
                                <i class="fa-solid fa-location-dot text-[18px]"></i>
                            </span>

                            <p>{!! wp_kses_post($officeAddress) !!}</p>
                        </div>

                        <div class="space-y-2">
                            <a href="tel:{{ $phoneHref }}"
                                class="flex items-center gap-3 transition hover:text-[#efc75d]">
                                <span class="shrink-0 text-[#c7ad6a]">
                                    <i class="fa-solid fa-phone text-[16px]"></i>
                                </span>
                                <span>{{ $phone }}</span>
                            </a>

                            <a href="mailto:{{ $email }}"
                                class="flex items-center gap-3 break-all transition hover:text-[#efc75d]">
                                <span class="shrink-0 text-[#c7ad6a]">
                                    <i class="fa-solid fa-envelope text-[16px]"></i>
                                </span>
                                <span>{{ $email }}</span>
                            </a>
                        </div>

                        <div class="flex items-center gap-5 pt-3 text-[#c7ad6a]">
                            @foreach ($socialLinks as $socialLink)
                                <a href="{{ esc_url($socialLink['url'] ?? '#') }}"
                                    aria-label="{{ esc_attr($socialLink['label'] ?? 'Social') }}"
                                    class="transition hover:text-[#efc75d]">
                                    {!! $socialLink['icon_class'] !!}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                @foreach ($footerColumns as $footerColumn)
                    @php
                        $columnLinks = $footerColumn['links'] ?? [];
                    @endphp
                    <div>
                        <h3 class="mb-8 text-[18px] font-normal text-[#efc75d]">
                            {{ $footerColumn['title'] ?? '' }}
                        </h3>

                        <nav class="space-y-0">
                            @foreach ($columnLinks as $index => $columnLink)
                                <a href="{{ esc_url($columnLink['url'] ?? '#') }}"
                                    class="footer-link-block {{ $index === count($columnLinks) - 1 ? 'border-b-0' : '' }}">
                                    {{ $columnLink['label'] ?? '' }}
                                </a>
                            @endforeach
                        </nav>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class=" text-[#b9a067]">
        <div class="mx-auto max-w-295 px-6 py-10 md:px-8 md:py-12 lg:px-10 lg:py-14">
            <div class="max-w-270 text-[16px] leading-[1.75] md:text-[17px]">
                @foreach ($legalParagraphs as $legalParagraph)
                    <p>{{ $legalParagraph['text'] ?? '' }}</p>
                @endforeach
            </div>

            <div class="mt-10 border-t border-[#ccb98d] pt-8">
                <div
                    class="flex flex-col gap-4 text-[16px] leading-[1.6] text-[#b9a067] md:flex-row md:items-center md:justify-between">
                    <p>{!! $copyrightText !!}</p>

                    <a href="{{ esc_url($privacyUrl) }}" class="transition hover:text-[#8f7438]">
                        {{ $privacyLabel }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
