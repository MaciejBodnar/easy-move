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
            'pageTitle' => get_the_title(),
            'parentId' => wp_get_post_parent_id($postId),
            'parentTitle' => $this->getParentTitle($postId),
            'parentUrl' => $this->getParentUrl($postId),
            'intro' => $this->getIntroData($postId),
            'highlight' => $this->getAcfFieldSafe('highlight_text', $postId, 'LET US PAVE THE PATH TO YOUR DREAM HOME WITH CLARITY, CONFIDENCE AND PEACE OF MIND!'),
            'heroImage' => $this->getHeroImage($postId),
            'relatedServices' => $this->getRelatedServices($postId),
            'cta' => $this->getCtaData($postId),
        ];
    }

    private function getIntroData($postId)
    {
        $introLeftDefault = 'First-time home buying shouldn\'t be shrouded in mystery! We understand the complexities of navigating the mortgage process. Our team of dedicated professionals will break down your financing options into clear and concise terms, ensuring you make informed decisions towards achieving homeownership. Buying a home is a significant financial decision, and we\'re here to help you make an informed one.';

        $introRightDefault = 'We have extensive experience in helping first-time homebuyers and experienced homeowners achieve their financial goals. We take the time to understand your unique financial situation and goals, tailoring our recommendations to fit your needs. We work with a variety of lenders to offer you a wide range of mortgage products, ensuring you find the best fit for your circumstances. We handle all the paperwork and negotiations, making the mortgage process as smooth and stress-free as possible.';

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
            'mortgageUrl' => $this->getAcfFieldSafe('cta_mortgage_url', $postId, '#'),
            'insuranceUrl' => $this->getAcfFieldSafe('cta_insurance_url', $postId, '#'),
            'mortgageText' => $this->getAcfFieldSafe('cta_mortgage_text', $postId, 'Mortgage'),
            'insuranceText' => $this->getAcfFieldSafe('cta_insurance_text', $postId, 'Insurance'),
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
}
