<header class="banner sticky-top">
  <nav class="navbar navbar-expand-lg">
    <div class="container">

      <?php if(function_exists( 'the_msls' )): ?>
        <div class="language-switcher">
          <?php (the_msls()); ?>
        </div>
      <?php endif; ?>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-menu"
              aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><?php echo $__env->make('icon::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></span>
      </button>

      <?php if(has_nav_menu('primary_navigation')): ?>
        <?php echo wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav ml-auto', 'container_id' => 'primary-menu', 'container_class' => 'collapse navbar-collapse', 'echo' => false]); ?>

      <?php endif; ?>

    </div>
  </nav>
</header>
<?php /**PATH C:\MAMP\htdocs\kaberneememarina\wp-content\themes\kaberneememarina\resources\views/partials/header.blade.php ENDPATH**/ ?>