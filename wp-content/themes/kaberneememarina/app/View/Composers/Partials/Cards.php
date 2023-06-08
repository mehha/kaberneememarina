<?php

namespace App\View\Composers\Partials;

use Roots\Acorn\View\Composer;

class Cards extends Composer
{
    protected static $views = [
        'partials.cards',
    ];

    public function with()
    {
        return [
            'cards' => get_field('cards'),
        ];
    }
}
