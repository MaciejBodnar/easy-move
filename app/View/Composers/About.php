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
                'phone' => $this->getAcfFieldSafe('about_contact_phone', $postId, '07555 641 081'),
                'hours' => $this->getAcfFieldSafe('about_contact_hours', $postId, 'Open Mon-Fri, 9:00-17:00'),
            ],
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
}
