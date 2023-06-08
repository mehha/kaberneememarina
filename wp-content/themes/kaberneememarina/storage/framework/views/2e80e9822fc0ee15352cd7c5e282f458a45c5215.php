<article <?php (post_class()); ?>>
  <div class="post-meta">
    <h1 class="entry-title">
      <?php echo $title; ?>

    </h1>

    <?php echo $__env->make('partials/entry-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>

  <div class="entry-content">
    <?php (the_content()); ?>
  </div>

  <footer>
    <?php echo wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>

  </footer>


</article>
<?php /**PATH C:\xampp\htdocs\kaberneememarina-2020\wp-content\themes\kaberneememarina\resources\views/partials/content-single.blade.php ENDPATH**/ ?>