<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontPage extends Composer
{
    public function with()
    {
        return [
            'text_below_banner' => get_field('text_below_banner', 'option'),
            'text_left' => get_field('text_left', 'option'),
        ];
    }
}
