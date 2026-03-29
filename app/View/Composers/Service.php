<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Service extends Composer
{
    protected static $views = [
        'service-template',
    ];

    public function with()
    {
        return [
            'service' => $this->getServiceData(),
        ];
    }

    private function getServiceData()
    {
        $postId = get_the_ID();

        return [
            'pageTitle' => $this->getAcfFieldSafe('page_title', $postId, get_the_title($postId)),
            'parentId' => wp_get_post_parent_id($postId),
            'parentTitle' => $this->getParentTitle($postId),
            'parentUrl' => $this->getParentUrl($postId),
            'breadcrumb' => $this->getBreadcrumbData($postId),
            'intro' => $this->getIntroData($postId),
            'highlight' => $this->getAcfFieldSafe('highlight_text', $postId, ''),
            'heroImage' => $this->getHeroImage($postId),
            'relatedServicesHeading' => $this->getAcfFieldSafe('related_services_heading', $postId, 'Related services'),
            'relatedServices' => $this->getRelatedServices($postId),
            'cta' => $this->getCtaData($postId),
            'hero_mortgages_videoPoster' => $this->getAcfImageSafe('hero_mortgages_video_poster', $postId, 'full', 'https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=2000&auto=format&fit=crop'),
            'hero_mortgages_video' => $this->getAcfImageSafe('hero_mortgages_video', $postId, 'full', get_template_directory_uri() . '/resources/videos/british-suburban-neighbourhood-from-above-haslin-2026-01-22-05-23-35-utc_output.mp4'),
        ];
    }

    private function getBreadcrumbData($postId)
    {
        $items = [];

        if (function_exists('get_field')) {
            $breadcrumbRows = \get_field('service_breadcrumb_items', $postId);

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

            $parentId = wp_get_post_parent_id($postId);
            if (!empty($parentId)) {
                $items[] = [
                    'label' => (string) get_the_title($parentId),
                    'url' => (string) get_permalink($parentId),
                ];
            }
        }

        $currentLabel = (string) get_the_title($postId);
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

    private function getIntroData($postId)
    {
        $introLeftDefault = '';

        $introRightDefault = '';

        return [
            'left' => $this->getAcfFieldSafe('intro_left', $postId, $introLeftDefault),
            'right' => $this->getAcfFieldSafe('intro_right', $postId, $introRightDefault),
        ];
    }

    private function getHeroImage($postId)
    {
        if (function_exists('get_field')) {
            $heroImage = \get_field('hero_image', $postId);
            if ($heroImage) {
                return is_array($heroImage) ? $heroImage['url'] ?? '' : $heroImage;
            }

            // Fallback to featured image
            if (has_post_thumbnail($postId)) {
                return get_the_post_thumbnail_url($postId, 'full');
            }
        }

        // Fallback to featured image if available
        if (has_post_thumbnail($postId)) {
            return get_the_post_thumbnail_url($postId, 'full');
        }

        return '';
    }

    private function getRelatedServices($postId)
    {
        $services = [];

        if (function_exists('get_field')) {
            $serviceRows = \get_field('related_services', $postId);
            if ($serviceRows) {
                $services = $serviceRows;
            }
        }

        // Fallback services if none are set
        if (empty($services)) {
            $services = [
                [
                    'title' => 'Remortgage',
                    'url' => '#',
                    'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1200&auto=format&fit=crop',
                    'button_text' => 'Read More',
                ],
                [
                    'title' => 'Home Movers Mortgage',
                    'url' => '#',
                    'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=1200&auto=format&fit=crop',
                    'button_text' => 'Read More',
                ],
                [
                    'title' => 'Buy to Let',
                    'url' => '#',
                    'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=1200&auto=format&fit=crop',
                    'button_text' => 'Read More',
                ],
            ];
        }

        return $services;
    }

    private function getCtaData($postId)
    {
        return [
            'heading' => $this->getAcfFieldSafe('cta_heading', $postId, 'Your home. Your family. Your future.<br />Let\'s protect it together.'),
            'url' => $this->getAcfFieldSafe('cta_url', $postId, '/contact/'),
            'text' => $this->getAcfFieldSafe('cta_text', $postId, 'Contact'),
        ];
    }

    private function getParentTitle($postId)
    {
        $parentId = wp_get_post_parent_id($postId);
        return $parentId ? get_the_title($parentId) : null;
    }

    private function getParentUrl($postId)
    {
        $parentId = wp_get_post_parent_id($postId);
        return $parentId ? get_permalink($parentId) : null;
    }

    private function getAcfFieldSafe($field_name, $post_id = false, $fallback = null)
    {
        if (function_exists('get_field')) {
            $value = \get_field($field_name, $post_id);
            return !empty($value) ? $value : $fallback;
        }
        return $fallback;
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
