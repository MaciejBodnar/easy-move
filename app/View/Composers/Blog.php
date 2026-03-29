<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Blog extends Composer
{
    protected static $views = [
        'blog-template',
    ];

    public function with()
    {
        return [
            'blog' => $this->getBlogData(),
        ];
    }

    private function getBlogData()
    {
        $postId = get_the_ID();

        return [
            'breadcrumb' => $this->getBreadcrumbData($postId),
            'pageTitle' => $this->getAcfFieldSafe('blog_page_title', $postId, 'Blog'),
            'pageDescription' => $this->getAcfFieldSafe('blog_page_description', $postId, ''),
            'postsPerPage' => intval($this->getAcfFieldSafe('blog_posts_per_page', $postId, 9)),
            'thumbnail' => $this->getAcfFieldSafe('post_thumbnail_override', $postId, ''),
            'readMoreText' => $this->getAcfFieldSafe('blog_read_more_text', $postId, 'Read more'),
            'noPostsText' => $this->getAcfFieldSafe('blog_no_posts_text', $postId, 'No posts found.'),
        ];
    }

    private function getBreadcrumbData($postId)
    {
        $items = [];

        if (function_exists('get_field')) {
            $breadcrumbRows = \get_field('blog_breadcrumb_items', $postId);

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

        $currentLabel = $this->getAcfFieldSafe('blog_page_title', $postId, 'Blog');
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
}
