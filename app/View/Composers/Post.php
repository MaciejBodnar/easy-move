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
            'title' => get_the_title(),
            'date' => get_the_date('c'),
            'dateFormatted' => strtoupper(get_the_date('M j, Y')),
            'content' => $this->getPostContent($postId),
            'thumbnail' => get_the_post_thumbnail(get_the_ID(), 'large', [
                'class' => 'h-auto w-full object-cover',
                'loading' => 'eager',
            ]),
            'blogUrl' => get_permalink(get_option('page_for_posts') ?: home_url('/blog')),
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
}
