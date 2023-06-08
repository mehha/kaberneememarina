<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Sidebar extends Composer
{
    protected static $views = [
        'partials.sidebar',
    ];

    public function with()
    {
        return [
            'sidebar_items' => get_field('sidebar_items', 'option'),
            'sidebar_image' => $this->image(),
            'sidebar_posts' => $this->posts(),
            'sidebar_link_1' => get_field('sidebar_link_1', 'option'),
            'sidebar_link_2' => get_field('sidebar_link_2', 'option'),
            'sidebar_posts_title' => get_field('sidebar_posts_title', 'option'),
            'sidebar_number_of_posts' => get_field('sidebar_number_of_posts', 'option'),
        ];
    }

    public function image() {
        $id = get_field('sidebar_image', 'option');
        return wp_get_attachment_image($id, 'thumbnail', '', ["class" => "img-fluid"]);
    }

    public function posts() {
        $query = new \Wp_Query( array(
            'post_type'     => 'post',
            'posts_per_page' => get_field('sidebar_number_of_posts', 'option'),
        ) );
        return $query;
    }
}
