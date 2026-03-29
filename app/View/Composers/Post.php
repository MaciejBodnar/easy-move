<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Post extends Composer
{
    protected static $views = [
        'single-post',
    ];

    public function with()
    {
        return [
            'post' => $this->getPostData(),
        ];
    }

    private function getPostData()
    {
        $postId = get_the_ID();

        return [
            'breadcrumb' => $this->getBreadcrumbData($postId),
            'title' => get_the_title(),
            'date' => get_the_date('c'),
            'dateFormatted' => strtoupper(get_the_date('M j, Y')),
            'content' => $this->getPostContent($postId),
            'thumbnail' => $this->getPostThumbnail($postId),
            'blogUrl' => get_permalink(get_option('page_for_posts') ?: home_url('/blog')),
        ];
    }

    private function getPostThumbnail($postId)
    {
        if (function_exists('get_field')) {
            $thumbnailOverride = \get_field('post_thumbnail_override', $postId);

            if (is_numeric($thumbnailOverride)) {
                $thumbnailHtml = \wp_get_attachment_image((int) $thumbnailOverride, 'large', false, [
                    'class' => 'h-auto w-full object-cover',
                    'loading' => 'eager',
                ]);

                if (!empty($thumbnailHtml)) {
                    return $thumbnailHtml;
                }
            }

            if (is_array($thumbnailOverride)) {
                $thumbnailId = (int) ($thumbnailOverride['ID'] ?? $thumbnailOverride['id'] ?? 0);

                if ($thumbnailId > 0) {
                    $thumbnailHtml = \wp_get_attachment_image($thumbnailId, 'large', false, [
                        'class' => 'h-auto w-full object-cover',
                        'loading' => 'eager',
                    ]);

                    if (!empty($thumbnailHtml)) {
                        return $thumbnailHtml;
                    }
                }

                $thumbnailUrl = (string) ($thumbnailOverride['url'] ?? '');
                if ($thumbnailUrl !== '') {
                    return sprintf(
                        '<img src="%s" class="h-auto w-full object-cover" loading="eager" alt="%s" />',
                        \esc_url($thumbnailUrl),
                        \esc_attr((string) get_the_title($postId))
                    );
                }
            }

            if (is_string($thumbnailOverride) && trim($thumbnailOverride) !== '') {
                $thumbnailValue = trim($thumbnailOverride);

                if (is_numeric($thumbnailValue)) {
                    $thumbnailHtml = \wp_get_attachment_image((int) $thumbnailValue, 'large', false, [
                        'class' => 'h-auto w-full object-cover',
                        'loading' => 'eager',
                    ]);

                    if (!empty($thumbnailHtml)) {
                        return $thumbnailHtml;
                    }
                }

                return sprintf(
                    '<img src="%s" class="h-auto w-full object-cover" loading="eager" alt="%s" />',
                    \esc_url($thumbnailValue),
                    \esc_attr((string) get_the_title($postId))
                );
            }
        }

        return get_the_post_thumbnail($postId, 'large', [
            'class' => 'h-auto w-full object-cover',
            'loading' => 'eager',
        ]);
    }

    private function getBreadcrumbData($postId)
    {
        $items = [];

        if (function_exists('get_field')) {
            $breadcrumbRows = \get_field('post_breadcrumb_items', $postId);

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

            $blogPageId = get_option('page_for_posts');
            $items[] = [
                'label' => $blogPageId ? (string) get_the_title($blogPageId) : 'Blog',
                'url' => (string) get_permalink($blogPageId ?: home_url('/blog')),
            ];
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

    private function getPostContent($postId)
    {
        if (function_exists('get_field')) {
            $wysiwygContent = \get_field('post_content_wysiwyg', $postId);
            if (!empty($wysiwygContent)) {
                return $wysiwygContent;
            }
        }

        return get_the_content();
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
}
