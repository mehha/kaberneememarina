<article <?php (post_class()); ?>>
  <div class="post-meta">
    <h4 class="entry-title">
      <a href="<?php echo e(get_permalink()); ?>">
        <?php echo $title; ?>

      </a>
    </h4>

    <?php echo $__env->make('partials/entry-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>

  <div class="entry-summary">
    <?php (the_excerpt()); ?>
  </div>
</article>
<?php /**PATH /home/kabernee/public_html/wp-content/themes/kaberneememarina/resources/views/partials/content.blade.php ENDPATH**/ ?>