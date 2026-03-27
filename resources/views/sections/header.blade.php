@php
    $currentLang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
    $langPrefix = $currentLang === 'pl' ? 'pl' : 'en';

    $menuLocations = get_nav_menu_locations();
    $primaryMenuId = (int) ($menuLocations['primary_navigation'] ?? 0);

    if ($primaryMenuId > 0 && function_exists('pll_get_term')) {
        $translatedMenuId = (int) pll_get_term($primaryMenuId, $currentLang);

        if ($translatedMenuId > 0) {
            $primaryMenuId = $translatedMenuId;
        }
    }

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

    $headerLogo = $optionField("hf_{$langPrefix}_header_logo", get_theme_file_uri('resources/images/logo-menu.png'));

    $socialLinks = $optionField('hf_shared_socials', []);

    if (empty($socialLinks) || !is_array($socialLinks)) {
        $socialLinks = [
            [
                'label' => 'Facebook',
                'url' => '#',
                'icon_class' => 'fa-brands fa-facebook-f',
            ],
            [
                'label' => 'Instagram',
                'url' => '#',
                'icon_class' => 'fa-brands fa-instagram',
            ],
            [
                'label' => 'LinkedIn',
                'url' => '#',
                'icon_class' => 'fa-brands fa-linkedin-in',
            ],
        ];
    }

    $languageOptions = [];
    $currentLanguage = null;

    if (function_exists('pll_the_languages')) {
        $languageOptions = pll_the_languages([
            'raw' => 1,
            'hide_if_empty' => 0,
            'hide_if_no_translation' => 0,
        ]);

        if (!is_array($languageOptions)) {
            $languageOptions = [];
        }

        foreach ($languageOptions as $languageOption) {
            if (!empty($languageOption['current_lang'])) {
                $currentLanguage = $languageOption;
                break;
            }
        }

        if (!$currentLanguage && !empty($languageOptions)) {
            $currentLanguage = reset($languageOptions);
        }
    }
@endphp

<header x-data="headerMenu()" @keydown.escape.window="closeAll()" class="relative z-50">
    <div class="bg-[#6b5a2c] text-[#d2bb7b]">
        <div class="mx-auto flex max-w-350 items-center justify-between px-4 py-3 md:px-6 lg:px-10">
            <div class="flex flex-wrap items-center gap-4 md:gap-8">
                <a href="tel:{{ $phoneHref }}"
                    class="inline-flex items-center gap-2 text-[15px] transition hover:text-white">
                    <i class="fa-solid fa-phone text-[14px]"></i>
                    <span>{{ $phone }}</span>
                </a>

                <a href="mailto:{{ $email }}"
                    class="inline-flex items-center gap-2 text-[15px] transition hover:text-white">
                    <i class="fa-solid fa-envelope text-[14px]"></i>
                    <span>{{ $email }}</span>
                </a>
            </div>

            <div class="hidden items-center gap-5 md:flex">
                @foreach ($socialLinks as $socialLink)
                    <a href="{{ esc_url($socialLink['url'] ?? '#') }}"
                        aria-label="{{ esc_attr($socialLink['label'] ?? 'Social') }}"
                        class="text-[#d2bb7b] transition hover:text-white">
                        <i class="{{ esc_attr($socialLink['icon_class'] ?? 'fa-solid fa-link') }} text-[15px]"></i>
                    </a>
                @endforeach

                @if (!empty($languageOptions) && !empty($currentLanguage))
                    @php
                        $currentLanguageSlug = strtolower($currentLanguage['slug'] ?? 'en');
                        $currentFlagCode = $currentLanguageSlug === 'en' ? 'uk' : explode('-', $currentLanguageSlug)[0];
                        $currentFlagUrl = "https://kapowaz.github.io/circle-flags/flags/{$currentFlagCode}.svg";
                    @endphp
                    <details class="relative">
                        <summary
                            class="flex list-none cursor-pointer items-center gap-2 text-[15px] text-[#e8e0c6] transition hover:text-white [&::-webkit-details-marker]:hidden">
                            <img src="{{ esc_url($currentFlagUrl) }}"
                                alt="{{ esc_attr(($currentLanguage['name'] ?? ($currentLanguage['slug'] ?? 'Current language')) . ' flag') }}"
                                class="h-5 w-auto object-contain" />

                            <span>{{ strtoupper($currentLanguage['slug'] ?? 'EN') }}</span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>

                        <div
                            class="absolute right-0 top-full z-40 mt-2 min-w-36 border border-[#d2bb7b]/30 bg-[#3d2f0d]/95 p-1 shadow-[0_10px_24px_rgba(0,0,0,0.35)]">
                            <ul class="space-y-1">
                                @foreach ($languageOptions as $languageOption)
                                    @php
                                        $isCurrentLanguage = !empty($languageOption['current_lang']);
                                        $languageSlug = strtolower($languageOption['slug'] ?? '');
                                        $flagCode = $languageSlug === 'en' ? 'uk' : explode('-', $languageSlug)[0];
                                        $flagUrl = "https://kapowaz.github.io/circle-flags/flags/{$flagCode}.svg";
                                    @endphp
                                    <li>
                                        <a href="{{ esc_url($languageOption['url'] ?? '#') }}"
                                            @if ($isCurrentLanguage) aria-current="true" @endif
                                            class="flex items-center gap-2 px-2 py-1.5 text-[14px] transition {{ $isCurrentLanguage ? 'bg-[#f9cf6c] text-[#3d2e12]' : 'text-[#e8e0c6] hover:bg-[#f9cf6c] hover:text-[#3d2e12]' }}">
                                            <img src="{{ esc_url($flagUrl) }}"
                                                alt="{{ esc_attr(($languageOption['name'] ?? ($languageOption['slug'] ?? 'Language')) . ' flag') }}"
                                                class="h-4 w-auto object-contain" />

                                            <span>{{ strtoupper($languageOption['slug'] ?? '') }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </details>
                @else
                    <div class="flex items-center gap-2 text-[15px] text-[#e8e0c6]">
                        <img src="https://kapowaz.github.io/circle-flags/flags/uk.svg" alt="English language flag"
                            class="h-5 w-auto object-contain" />
                        <span>ENG</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="header-gradient border-t border-[rgba(255,255,255,0.08)]">
        <div class="mx-auto flex justify-between max-w-350 items-center gap-20 px-4 py-6 md:px-6 lg:px-10">
            <a href="{{ home_url('/') }}" class="shrink-0">
                <img src="{{ esc_url($headerLogo) }}" alt="Easy Move Logo">
            </a>

            <div class="hidden lg:block">
                @if ($primaryMenuId > 0)
                    {!! wp_nav_menu([
                        'menu' => $primaryMenuId,
                        'theme_location' => 'primary_navigation',
                        'menu_class' => 'desktop-menu flex items-center gap-8 xl:gap-10',
                        'container' => false,
                        'fallback_cb' => false,
                        'echo' => false,
                    ]) !!}
                @endif
            </div>

            <button type="button" @click="toggleMobile()"
                class="inline-flex h-11 w-11 items-center text-white lg:hidden" aria-label="Toggle menu"
                :aria-expanded="mobileOpen ? 'true' : 'false'">
                <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>

                <svg x-show="mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition.opacity class="lg:hidden">
        <div class="border-t border-[rgba(255,255,255,0.08)] bg-[#4b3a12] px-4 py-5 md:px-6">
            @if ($primaryMenuId > 0)
                {!! wp_nav_menu([
                    'menu' => $primaryMenuId,
                    'theme_location' => 'primary_navigation',
                    'menu_class' => 'mobile-menu',
                    'container' => false,
                    'fallback_cb' => false,
                    'echo' => false,
                ]) !!}
            @endif

            <div class="mt-6 flex items-center gap-5 pt-5 text-[#d2bb7b]">
                @foreach ($socialLinks as $socialLink)
                    <a href="{{ esc_url($socialLink['url'] ?? '#') }}"
                        aria-label="{{ esc_attr($socialLink['label'] ?? 'Social') }}"
                        class="transition hover:text-white">
                        <i class="{{ esc_attr($socialLink['icon_class'] ?? 'fa-solid fa-link') }} text-[15px]"></i>
                    </a>
                @endforeach

                @if (!empty($languageOptions) && !empty($currentLanguage))
                    @php
                        $mobileLanguageSlug = strtolower($currentLanguage['slug'] ?? 'en');
                        $mobileFlagCode = $mobileLanguageSlug === 'en' ? 'uk' : explode('-', $mobileLanguageSlug)[0];
                        $mobileFlagUrl = "https://kapowaz.github.io/circle-flags/flags/{$mobileFlagCode}.svg";
                    @endphp
                    <details class="relative ml-auto">
                        <summary
                            class="flex list-none cursor-pointer items-center gap-2 text-[15px] text-[#e8e0c6] transition hover:text-white [&::-webkit-details-marker]:hidden">
                            <img src="{{ esc_url($mobileFlagUrl) }}"
                                alt="{{ esc_attr(($currentLanguage['name'] ?? ($currentLanguage['slug'] ?? 'Current language')) . ' flag') }}"
                                class="h-5 w-auto object-contain" />
                            <span>{{ strtoupper($currentLanguage['slug'] ?? 'EN') }}</span>
                        </summary>

                        <div
                            class="absolute right-0 top-full z-40 mt-2 min-w-32 border border-[#d2bb7b]/30 bg-[#3d2f0d]/95 p-1 shadow-[0_10px_24px_rgba(0,0,0,0.35)]">
                            <ul class="space-y-1">
                                @foreach ($languageOptions as $languageOption)
                                    @php
                                        $isCurrentLanguage = !empty($languageOption['current_lang']);
                                        $languageSlug = strtolower($languageOption['slug'] ?? '');
                                        $flagCode = $languageSlug === 'en' ? 'uk' : explode('-', $languageSlug)[0];
                                        $flagUrl = "https://kapowaz.github.io/circle-flags/flags/{$flagCode}.svg";
                                    @endphp
                                    <li>
                                        <a href="{{ esc_url($languageOption['url'] ?? '#') }}"
                                            @if ($isCurrentLanguage) aria-current="true" @endif
                                            class="flex items-center gap-2 px-2 py-1.5 text-[14px] transition {{ $isCurrentLanguage ? 'bg-[#f9cf6c] text-[#3d2e12]' : 'text-[#e8e0c6] hover:bg-[#f9cf6c] hover:text-[#3d2e12]' }}">
                                            <img src="{{ esc_url($flagUrl) }}"
                                                alt="{{ esc_attr(($languageOption['name'] ?? ($languageOption['slug'] ?? 'Language')) . ' flag') }}"
                                                class="h-4 w-auto object-contain" />
                                            <span>{{ strtoupper($languageOption['slug'] ?? '') }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </details>
                @endif
            </div>
        </div>
    </div>
</header>
