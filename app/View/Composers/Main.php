<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Main extends Composer
{
    protected static $views = [
        'front-page',
    ];

    public function with()
    {
        return [
            'main' => $this->getMainData(),
        ];
    }

    private function getMainData()
    {
        return [
            'contact' => $this->getContactData(),
            'hero' => $this->getHeroData(),
            'confused' => $this->getConfusedSectionData(),
            'whyChooseUs' => $this->getWhyChooseUsData(),
            'protect' => $this->getProtectTogetherData(),
            'statistics' => $this->getStatisticsData(),
            'reviews' => $this->getReviewsData(),
            'blog' => $this->getBlogData(),
        ];
    }

    private function getHeroData()
    {
        $postId = get_the_ID();

        return [
            'mortgages' => [
                'menuLabel'    => $this->getAcfFieldSafe('hero_mortgages_menu_label', $postId, 'Mortgages'),
                'menuHref'     => $this->formatUrl($this->getAcfFieldSafe('hero_mortgages_menu_href', $postId, '#')),
                'logoTop'      => $this->getAcfFieldSafe('hero_mortgages_logo_top', $postId, 'EASYMOVE'),
                'logoBottom'   => $this->getAcfFieldSafe('hero_mortgages_logo_bottom', $postId, 'FINANCIAL'),
                'eyebrow'      => $this->getAcfFieldSafe('hero_mortgages_eyebrow', $postId, 'MORTGAGES'),
                'title'        => $this->getAcfFieldSafe('hero_mortgages_title', $postId, 'Simple, Secure,<br>Stress-Free'),
                'text'         => $this->getAcfFieldSafe('hero_mortgages_text', $postId, 'Buying your dream home?<br>We make it clear, personal, and easy.'),
                'buttonText'   => $this->getAcfFieldSafe('hero_mortgages_button_text', $postId, 'Discover'),
                'buttonUrl'    => $this->formatUrl($this->getAcfFieldSafe('hero_mortgages_button_url', $postId, '#')),
                'video'        => $this->getAcfImageSafe('hero_mortgages_video', $postId, 'full', get_template_directory_uri() . '/resources/videos/0_Wooden_Wall_Wood_Paneling_1920x1080_output.mp4'),
            ],

            'insurance' => [
                'menuLabel'    => $this->getAcfFieldSafe('hero_insurance_menu_label', $postId, 'Insurance'),
                'menuHref'     => $this->formatUrl($this->getAcfFieldSafe('hero_insurance_menu_href', $postId, '#')),
                'logoTop'      => $this->getAcfFieldSafe('hero_insurance_logo_top', $postId, 'EASYMOVE'),
                'logoBottom'   => $this->getAcfFieldSafe('hero_insurance_logo_bottom', $postId, 'PROTECTION'),
                'eyebrow'      => $this->getAcfFieldSafe('hero_insurance_eyebrow', $postId, 'INSURANCE'),
                'title'        => $this->getAcfFieldSafe('hero_insurance_title', $postId, 'Safe and<br>Protected'),
                'text'         => $this->getAcfFieldSafe('hero_insurance_text', $postId, 'Protecting your home or family?<br>We make it clear, personal, and easy.'),
                'buttonText'   => $this->getAcfFieldSafe('hero_insurance_button_text', $postId, 'Discover'),
                'buttonUrl'    => $this->formatUrl($this->getAcfFieldSafe('hero_insurance_button_url', $postId, '#')),
                'video'        => $this->getAcfImageSafe('hero_insurance_video', $postId, 'full', get_template_directory_uri() . '/resources/videos/GettyImages-1399210432_output.mov'),
            ],
            'logo_fin' => $this->getAcfImageSafe('hero_logo_fin', $postId, 'full', get_template_directory_uri() . '/resources/images/logo1.png'),
            'logo_pro' => $this->getAcfImageSafe('hero_logo_pro', $postId, 'full', get_template_directory_uri() . '/resources/images/logo.png'),
        ];
    }

    private function getContactData()
    {
        $postId = get_the_ID();

        $socialLinks = [];

        if (function_exists('get_field')) {
            $socialLinkRows = \get_field('contact_social_links', $postId);

            if (is_array($socialLinkRows)) {
                foreach ($socialLinkRows as $socialLinkRow) {
                    $url = $this->formatUrl((string) ($socialLinkRow['url'] ?? ''));
                    $iconMarkup = $this->normalizeSocialIcon((string) ($socialLinkRow['icon_class'] ?? ''));

                    if ($url === '' || $iconMarkup === '') {
                        continue;
                    }

                    $socialLinks[] = [
                        'url' => $url,
                        'icon_class' => $iconMarkup,
                    ];
                }
            }
        }

        // Fallback to legacy standalone fields when repeater is empty.
        if (empty($socialLinks)) {
            $socialLinks = [
                [
                    'url' => $this->formatUrl($this->getAcfFieldSafe('social_facebook', $postId, '#')),
                    'icon_class' => '<i class="fa-brands fa-facebook-f"></i>',
                ],
                [
                    'url' => $this->formatUrl($this->getAcfFieldSafe('social_instagram', $postId, '#')),
                    'icon_class' => '<i class="fa-brands fa-instagram"></i>',
                ],
                [
                    'url' => $this->formatUrl($this->getAcfFieldSafe('social_linkedin', $postId, '#')),
                    'icon_class' => '<i class="fa-brands fa-linkedin-in"></i>',
                ],
            ];
        }

        return [
            'phone' => $this->getAcfFieldSafe('contact_phone', $postId, '07555 641 081'),
            'email' => $this->getAcfFieldSafe('contact_email', $postId, 'tomasz@emove-fs.co.uk'),
            'heading' => $this->getAcfFieldSafe('contact_heading', $postId, 'Get in touch'),
            'hours' => $this->getAcfFieldSafe('contact_hours', $postId, 'Open Mon-Fri, 9:00-17:00'),
            'socialLinks' => array_values(array_filter($socialLinks, function ($socialLink) {
                return ! empty($socialLink['url']);
            })),
        ];
    }

    private function getConfusedSectionData()
    {
        $postId = get_the_ID();
        $bullets = [];

        if (function_exists('get_field')) {
            $bulletRows = \get_field('confused_bullets', $postId);
            if ($bulletRows) {
                $bullets = $bulletRows;
            }
        }

        // Fallback bullets if none are set
        if (empty($bullets)) {
            $bullets = [
                ['text' => 'Not sure which mortgage deal is right for you?'],
                ['text' => 'Wondering how to protect your family or income if the unexpected happens?'],
                ['text' => 'Tired of financial jargon and sales pressure?'],
            ];
        }

        return [
            'heading' => $this->getAcfFieldSafe('confused_heading', $postId, 'Confused by mortgages?<br />Unsure about insurance?'),
            'bullets' => $bullets,
            'text' => $this->getAcfFieldSafe('confused_text', $postId, 'At Easy Move Mortgages, we cut through the confusion. Whether it\'s securing your first home, remortgaging, or protecting your loved ones, our mission is to give you <span class="font-semibold">clarity, confidence, and complete peace of mind.</span>'),
        ];
    }

    private function getWhyChooseUsData()
    {
        $postId = get_the_ID();
        $features = [];

        if (function_exists('get_field')) {
            $featureRows = \get_field('why_choose_features', $postId);
            if ($featureRows) {
                $features = $featureRows;
            }
        }

        // Fallback features if none are set
        if (empty($features)) {
            $features = [
                [
                    'title' => 'We listen',
                    'description' => 'Your goals, your story, your future.',
                ],
                [
                    'title' => 'We simplify',
                    'description' => 'Clear advice, no jargon, tailored options.',
                ],
                [
                    'title' => 'We guide',
                    'description' => 'From application to approval (and beyond).',
                ],
            ];
        }

        return [
            'heading' => $this->getAcfFieldSafe('why_choose_heading', $postId, 'Why choose us?'),
            'image' => $this->getAcfImageSafe('why_choose_image', $postId, 'full', get_template_directory_uri() . '/resources/images/heroSlider.png'),
            'features' => $features,
        ];
    }

    private function getProtectTogetherData()
    {
        $postId = get_the_ID();

        return [
            'heading' => $this->getAcfFieldSafe('protect_heading', $postId, 'Your home. Your family. Your future.<br />Let\'s protect it together.'),
            'description' => $this->getAcfFieldSafe('protect_description', $postId, ''),
            'video' => $this->getAcfMediaSafe('protect_video', $postId, get_template_directory_uri() . '/resources/videos/british-suburban-neighbourhood-from-above-haslin-2026-01-22-05-23-35-utc_output.mp4'),
            'videoPoster' => $this->getAcfImageSafe('protect_video_poster', $postId, 'full', get_template_directory_uri() . '/resources/images/poster.png'),
            'buttons' => [
                'mortgage' => $this->formatUrl($this->getAcfFieldSafe('protect_mortgage_url', $postId, '#')),
                'insurance' => $this->formatUrl($this->getAcfFieldSafe('protect_insurance_url', $postId, '#')),
                'mortgageText' => $this->getAcfFieldSafe('protect_mortgage_text', $postId, 'Mortgage'),
                'insuranceText' => $this->getAcfFieldSafe('protect_insurance_text', $postId, 'Insurance'),
            ],
        ];
    }

    private function getStatisticsData()
    {
        $postId = get_the_ID();
        $statistics = [];

        if (function_exists('get_field')) {
            $statisticsRows = \get_field('statistics', $postId);
            if ($statisticsRows) {
                $statistics = $statisticsRows;
            }
        }

        // Fallback statistics if none are set
        if (empty($statistics)) {
            $statistics = [
                ['number' => '15', 'label' => 'Years of<br class="hidden sm:block"> experience'],
                ['number' => '100', 'label' => 'Lenders available'],
                ['number' => '8000', 'label' => 'Different<br class="hidden sm:block"> mortgages'],
                ['number' => '100%', 'label' => 'Happy<br class="hidden sm:block"> customers'],
            ];
        }

        return [
            'items' => $statistics,
            'backgroundImage' => $this->getAcfImageSafe('statistics_background_image', $postId, 'full', get_template_directory_uri() . '/resources/images/bannerLogo.png'),
        ];
    }

    private function getReviewsData()
    {
        $postId = get_the_ID();

        return [
            'heading' => $this->getAcfFieldSafe('reviews_heading', $postId, 'What our customers are saying…'),
            'shortcode' => $this->getAcfFieldSafe('reviews_shortcode', $postId, '[trustindex no-registration=google]'),
        ];
    }

    private function getBlogData()
    {
        $postId = get_the_ID();

        return [
            'heading' => $this->getAcfFieldSafe('blog_heading', $postId, 'Blog & Articles'),
            'postsCount' => (int) $this->getAcfFieldSafe('blog_posts_count', $postId, 3),
            'readMoreText' => $this->getAcfFieldSafe('front_blog_read_more_text', $postId, 'Read more'),
            'archiveButtonText' => $this->getAcfFieldSafe('front_blog_archive_button_text', $postId, 'See all articles'),
        ];
    }

    private function formatUrl($url)
    {
        if (empty($url)) {
            return $url;
        }

        if (strpos($url, '/') === 0) {
            return \home_url($url);
        }

        if (
            !preg_match("~^(?:f|ht)tps?://~i", $url) &&
            strpos($url, 'mailto:') !== 0 &&
            strpos($url, 'tel:') !== 0 &&
            strpos($url, '#') !== 0
        ) {
            return 'https://' . $url;
        }

        return $url;
    }

    private function getAcfFieldSafe($field_name, $post_id = false, $fallback = null)
    {
        if (function_exists('get_field')) {
            $value = \get_field($field_name, $post_id);
            return !empty($value) ? $value : $fallback;
        }

        return $fallback;
    }

    private function getAcfImageSafe($field_name, $post_id = false, $size = 'full', $fallback_url = '')
    {
        if (function_exists('get_field')) {
            $image = \get_field($field_name, $post_id);

            if ($image) {
                if (is_array($image) && isset($image['url'])) {
                    return $image['url'];
                } elseif (is_string($image)) {
                    return wp_get_attachment_image_url($image, $size) ?: $image;
                } elseif (is_numeric($image)) {
                    $url = \wp_get_attachment_image_url($image, $size);

                    if (!$url) {
                        $url = \wp_get_attachment_url($image);
                    }

                    return $url ?: $fallback_url;
                }
            }
        }

        return $fallback_url;
    }

    private function getAcfMediaSafe($field_name, $post_id = false, $fallback_url = '')
    {
        if (function_exists('get_field')) {
            $media = \get_field($field_name, $post_id);

            if ($media) {
                if (is_array($media) && isset($media['url'])) {
                    return $media['url'];
                }

                if (is_numeric($media)) {
                    return \wp_get_attachment_url((int) $media) ?: $fallback_url;
                }

                if (is_string($media)) {
                    return $media;
                }
            }
        }

        return $fallback_url;
    }

    private function normalizeSocialIcon(string $iconValue): string
    {
        $iconValue = trim($iconValue);

        if ($iconValue === '') {
            return '';
        }

        // Some entries are saved as quoted HTML, for example: "<i class=...></i>".
        $iconValue = trim($iconValue, " \t\n\r\0\x0B\"'");

        if (stripos($iconValue, '<i') !== false) {
            return (string) \wp_kses($iconValue, [
                'i' => [
                    'class' => true,
                    'aria-hidden' => true,
                ],
            ]);
        }

        return sprintf('<i class="%s" aria-hidden="true"></i>', \esc_attr($iconValue));
    }
}
