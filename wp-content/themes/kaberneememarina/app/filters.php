<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

add_filter( 'excerpt_length', function () {
    return 20;
});

add_filter('body_class', function($classes) {
    // Add class if sidebar is active
    if (1==1) {
        $classes[] = 'has-sidebar-primary';
    }
    return $classes;
});

add_filter('body_class', function($classes) {
    // Add class if sidebar is active
    if (get_field('wide_layout')) {
        $classes[] = 'wide';
    }
    return $classes;
});
