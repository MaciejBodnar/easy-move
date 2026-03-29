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
            'breadcrumb' => $this->getBreadcrumbData($postId),
            'office' => $this->getOfficeData($postId),
            'banner' => $this->getBannerData($postId),
            'phone' => $this->getAcfFieldSafe('contact_phone', $postId, '07555 641 081'),
            'email' => $this->getAcfFieldSafe('contact_email', $postId, 'tomasz@emove-fs.co.uk'),
            'socialLinks' => $this->getSocialLinksData($postId),
            'formHeading' => $this->getAcfFieldSafe('contact_form_heading', $postId, 'Leave a message'),
            'formShortcode' => $this->getAcfFieldSafe('contact_form_shortcode', $postId, '[contact-form-7 id="98d3aa4" title="Contact"]'),
            'formShortcodePL' => $this->getAcfFieldSafe('contact_form_shortcode_pl', $postId, '[contact-form-7 id="a6a5a57" title="Lead from - Polski"]'),
        ];
    }

    private function getBreadcrumbData($postId)
    {
        $items = [];

        if (function_exists('get_field')) {
            $breadcrumbRows = \get_field('contact_breadcrumb_items', $postId);

            if (is_array($breadcrumbRows)) {
                foreach ($breadcrumbRows as $breadcrumbRow) {
                    $label = trim((string) ($breadcrumbRow['label'] ?? ''));
                    $url = $this->formatUrl((string) ($breadcrumbRow['url'] ?? ''));

                    if ($label === '') {
                        continue;
                    }

                    $items[] = [
                        'label' => $label,
                        'url' => $url,
                    ];
                }
            }
        }

        if (empty($items)) {
            $items[] = [
                'label' => (string) get_the_title(get_option('page_on_front')) ?: 'Home',
                'url' => home_url('/'),
            ];
        }

        $currentLabel = (string) $this->getAcfFieldSafe('contact_page_heading', $postId, get_the_title($postId));
        $lastItem = !empty($items) ? $items[count($items) - 1] : null;

        if (!$lastItem || trim((string) ($lastItem['label'] ?? '')) !== $currentLabel) {
            $items[] = [
                'label' => $currentLabel,
                'url' => '',
            ];
        } else {
            $items[count($items) - 1]['url'] = '';
        }

        return [
            'items' => $items,
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

        if (empty($socialLinks)) {
            $socialLinks = [
                [
                    'url' => $this->formatUrl($this->getAcfFieldSafe('social_facebook', $postId, '#')),
                    'icon_class' => '<i class="fa-brands fa-facebook-f" aria-hidden="true"></i>',
                ],
                [
                    'url' => $this->formatUrl($this->getAcfFieldSafe('social_instagram', $postId, '#')),
                    'icon_class' => '<i class="fa-brands fa-instagram" aria-hidden="true"></i>',
                ],
                [
                    'url' => $this->formatUrl($this->getAcfFieldSafe('social_linkedin', $postId, '#')),
                    'icon_class' => '<i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>',
                ],
            ];
        }

        return array_values(array_filter($socialLinks, function ($socialLink) {
            return ! empty($socialLink['url']);
        }));
    }

    private function getBannerData($postId)
    {
        return [
            'video' => $this->getAcfFieldSafe('contact_banner_video', $postId, get_template_directory_uri() . '/resources/videos/british-suburban-neighbourhood-from-above-haslin-2026-01-22-05-23-35-utc_output.mp4'),
            'videoPoster' => $this->getAcfImageSafe('contact_banner_video_poster', $postId, 'full', get_template_directory_uri() . ""),
            'content' => $this->getAcfFieldSafe('contact_banner_content', $postId, 'We can\'t wait to hear from you!'),
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

    private function normalizeSocialIcon(string $iconValue): string
    {
        $iconValue = trim($iconValue);

        if ($iconValue === '') {
            return '';
        }

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
