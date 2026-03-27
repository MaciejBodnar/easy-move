<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class About extends Composer
{
    protected static $views = [
        'about-template',
    ];

    public function with()
    {
        return [
            'about' => $this->getAboutData(),
        ];
    }

    private function getAboutData()
    {
        $postId = get_the_ID();

        return [
            'pageTitle' => $this->getAcfFieldSafe('about_page_title', $postId, 'About us'),
            'heroImage' => $this->getAcfImageSafe(
                'about_hero_image',
                $postId,
                'full',
                'https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=1600&auto=format&fit=crop'
            ),
            'whyUs' => [
                'heading' => $this->getAcfFieldSafe('about_why_us_heading', $postId, 'Why us?'),
                'text' => $this->getAcfFieldSafe('about_why_us_text', $postId, ''),
            ],
            'howWeHelp' => [
                'heading' => $this->getAcfFieldSafe('about_help_heading', $postId, 'How can we help?'),
                'text' => $this->getAcfFieldSafe('about_help_text', $postId, ''),
            ],
            'mission' => [
                'heading' => $this->getAcfFieldSafe('about_mission_heading', $postId, 'Our mission'),
                'highlight' => $this->getAcfFieldSafe('about_mission_highlight', $postId, ''),
                'text' => $this->getAcfFieldSafe('about_mission_text', $postId, ''),
            ],
            'whyChoose' => [
                'heading' => $this->getAcfFieldSafe('about_why_choose_heading', $postId, 'Why choose us?'),
                'features' => $this->getAboutFeaturesData($postId),
            ],
            'contact' => [
                'heading' => $this->getAcfFieldSafe('about_contact_heading', $postId, 'Give us a call'),
                'phone' => $this->getAcfFieldSafe('about_contact_phone', $postId, '07555 641 081'),
                'hours' => $this->getAcfFieldSafe('about_contact_hours', $postId, 'Open Mon-Fri, 9:00-17:00'),
            ],
            'statisticsBackgroundImage' => $this->getAcfImageSafe(
                'about_statistics_background_image',
                $postId,
                'full',
                get_template_directory_uri() . '/resources/images/bannerLogo.png'
            ),
            'statistics' => $this->getAboutStatisticsData($postId),
            'testimonials' => [
                'heading' => $this->getAcfFieldSafe('about_testimonials_heading', $postId, 'What our customers are saying…'),
                'shortcode' => $this->getAcfFieldSafe('about_testimonials_shortcode', $postId, '[your-testimonials-plugin-shortcode]'),
            ],
        ];
    }

    private function getAboutFeaturesData($postId)
    {
        $features = [];

        if (function_exists('get_field')) {
            $featureRows = \get_field('about_why_choose_features', $postId);
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

        return $features;
    }

    private function getAboutStatisticsData($postId)
    {
        $statistics = [];

        if (function_exists('get_field')) {
            $statisticsRows = \get_field('about_statistics', $postId);
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

        return $statistics;
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
                }

                if (is_string($image)) {
                    return wp_get_attachment_image_url($image, $size) ?: $image;
                }

                if (is_numeric($image)) {
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
}
