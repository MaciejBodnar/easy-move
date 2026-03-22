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
            'hero' => $this->getHeroData(),
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
                'image'        => $this->getAcfImageSafe('hero_mortgages_image', $postId, 'full', get_template_directory_uri() . '/resources/images/heroSlider.png'),
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
                'image'        => $this->getAcfImageSafe('hero_insurance_image', $postId, 'full', get_template_directory_uri() . '/resources/images/heroSlider1.png'),
            ],
            'logo_fin' => $this->getAcfImageSafe('hero_logo_fin', $postId, 'full', get_template_directory_uri() . '/resources/images/logo1.png'),
            'logo_pro' => $this->getAcfImageSafe('hero_logo_pro', $postId, 'full', get_template_directory_uri() . '/resources/images/logo.png'),
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
}
