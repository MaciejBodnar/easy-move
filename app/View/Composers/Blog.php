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
            'pageTitle' => $this->getAcfFieldSafe('blog_page_title', $postId, 'Blog'),
            'pageDescription' => $this->getAcfFieldSafe('blog_page_description', $postId, ''),
            'postsPerPage' => intval($this->getAcfFieldSafe('blog_posts_per_page', $postId, 9)),
            'readMoreText' => $this->getAcfFieldSafe('blog_read_more_text', $postId, 'Read more'),
            'noPostsText' => $this->getAcfFieldSafe('blog_no_posts_text', $postId, 'No posts found.'),
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
}
