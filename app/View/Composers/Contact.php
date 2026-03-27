<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Contact extends Composer
{
    protected static $views = [
        'contact-template',
    ];

    public function with()
    {
        return [
            'contact' => $this->getContactData(),
        ];
    }

    private function getContactData()
    {
        $postId = get_the_ID();

        return [
            'heading' => $this->getAcfFieldSafe('contact_page_heading', $postId, 'Contact'),
            'office' => $this->getOfficeData($postId),
            'banner' => $this->getBannerData($postId),
            'phone' => $this->getAcfFieldSafe('contact_phone', $postId, '07555 641 081'),
            'email' => $this->getAcfFieldSafe('contact_email', $postId, 'tomasz@emove-fs.co.uk'),
            'socialLinks' => $this->getSocialLinksData($postId),
            'formHeading' => $this->getAcfFieldSafe('contact_form_heading', $postId, 'Leave a message'),
            'formShortcode' => $this->getAcfFieldSafe('contact_form_shortcode', $postId, '[contact-form-7 id="98d3aa4" title="Contact"]'),
        ];
    }

    private function getOfficeData($postId)
    {
        return [
            'heading' => $this->getAcfFieldSafe('office_heading', $postId, 'Head Office'),
            'address' => $this->getAcfFieldSafe('office_address', $postId, 'Rose Garth, Kingston Avenue,<br>Ripon, England, HG4 1TJ'),
        ];
    }

    private function getSocialLinksData($postId)
    {
        return [
            'facebook' => $this->getAcfFieldSafe('social_facebook', $postId, '#'),
            'instagram' => $this->getAcfFieldSafe('social_instagram', $postId, '#'),
            'linkedin' => $this->getAcfFieldSafe('social_linkedin', $postId, '#'),
        ];
    }
    private function getBannerData($postId)
    {
        return [
            'image' => $this->getAcfImageSafe('contact_banner_image', $postId, 'full', get_template_directory_uri() . "/resources/images/bottomBanner.png"),
            'content' => $this->getAcfFieldSafe('contact_banner_content', $postId, 'We can\'t wait to hear from you!'),
        ];
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
