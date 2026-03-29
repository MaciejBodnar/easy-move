<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ServiceList extends Composer
{
    protected static $views = [
        'service-list-template',
    ];

    public function with()
    {
        return [
            'services' => $this->getServiceListData(),
        ];
    }

    private function getServiceListData()
    {
        $postId = get_the_ID();

        return [
            'breadcrumb' => $this->getBreadcrumbData($postId),
            'pageTitle' => get_the_title(),
            'items' => $this->getServiceItems($postId),
        ];
    }

    private function getBreadcrumbData($postId)
    {
        $items = [];

        if (function_exists('get_field')) {
            $breadcrumbRows = \get_field('service_list_breadcrumb_items', $postId);

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

    private function getServiceItems($postId)
    {
        $items = [];

        if (function_exists('get_field')) {
            $itemRows = \get_field('service_items', $postId);
            if ($itemRows) {
                $items = $itemRows;
            }
        }

        // Fallback items if none are set
        if (empty($items)) {
            $items = [
                [
                    'title' => 'First Time Buyer',
                    'text' => 'First-time buyers often face challenges such as saving for a down payment, understanding mortgage options and managing credit scores. Affordability concerns, navigating the home search process and budgeting for closing costs are also common issues. Additionally, understanding legal aspects, managing emotional stress and evaluating property conditions are critical considerations.',
                    'button' => [
                        'title' => 'Read More',
                        'url' => '#',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?q=80&w=1200&auto=format&fit=crop',
                ],
                [
                    'title' => 'Remortgage',
                    'text' => 'Remortgagors commonly encounter challenges such as understanding various refinancing options, navigating changes in interest rates, and managing associated fees and closing costs. Assessing the potential benefits versus costs, managing documentation and legal aspects, and ensuring the process aligns with financial goals must also be taken into account.',
                    'button' => [
                        'title' => 'Read More',
                        'url' => '#',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1200&auto=format&fit=crop',
                ],
                [
                    'title' => 'Home Movers Mortgage',
                    'text' => 'One of the main concerns people looking for residential mortgage may have is getting the best interest rates and affordable monthly payments, understanding loan terms, job stability, current market conditions and overall impact on their financial future.',
                    'button' => [
                        'title' => 'Read More',
                        'url' => '#',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=1200&auto=format&fit=crop',
                ],
                [
                    'title' => 'Buy to Let',
                    'text' => 'When considering a buy-to-let mortgage, you might be concerned about securing favourable interest rates and managing higher deposit requirements. Ensuring that your rental income will cover mortgage payments and other expenses is crucial.',
                    'button' => [
                        'title' => 'Read More',
                        'url' => '#',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=1200&auto=format&fit=crop',
                ],
            ];
        }

        return $items;
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
