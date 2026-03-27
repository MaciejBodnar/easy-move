<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Policy extends Composer
{
    protected static $views = [
        'privacy-policy',
    ];

    public function with()
    {
        return [
            'policy' => $this->getPolicyData(),
        ];
    }

    private function getPolicyData()
    {
        $postId = get_the_ID();

        return [
            'content' => $this->getAcfFieldSafe('policy_page_content', $postId, get_the_content()),
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
