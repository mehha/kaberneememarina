<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('stylesheet_directory'); ?>/resources/assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('stylesheet_directory'); ?>/resources/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('stylesheet_directory'); ?>/resources/assets/images/favicon-16x16.png">
    <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/resources/assets/images/favicon.ico">
    <link rel="manifest" href="<?php bloginfo('stylesheet_directory'); ?>/resources/assets/images/site.webmanifest">
    <link rel="mask-icon" href="<?php bloginfo('stylesheet_directory'); ?>/resources/assets/images/safari-pinned-tab.svg" color="#edcd1f">
    <meta name="msapplication-TileColor" content="#edcd1f">
    <meta name="theme-color" content="#ffffff">

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php do_action('get_header'); ?>

    <div id="app">
      <?php echo \Roots\view(\Roots\app('sage.view'), \Roots\app('sage.data'))->render(); ?>
    </div>

    <?php do_action('get_footer'); ?>
    <?php wp_footer(); ?>
  </body>
</html>
