<?php

namespace App\View\Composers\Partials;

use Roots\Acorn\View\Composer;

class Carousel extends Composer
{
    protected static $views = [
        'partials.carousel',
    ];

    public function with()
    {
        return [
            'carousel_items' => get_field('carousel_items', 'option'),
        ];
    }
}
