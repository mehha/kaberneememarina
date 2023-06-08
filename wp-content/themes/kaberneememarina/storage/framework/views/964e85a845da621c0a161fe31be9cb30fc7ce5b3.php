<article <?php (post_class()); ?>>
  <header>
    <h2 class="entry-title">
      <a href="<?php echo e(get_permalink()); ?>">
        <?php echo $title; ?>

      </a>
    </h2>

    <?php echo $__env->renderWhen(get_post_type() === 'post', 'partials/entry-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
  </header>

  <div class="entry-summary">
    <?php (the_excerpt()); ?>
  </div>
</article>
<?php /**PATH C:\xampp\htdocs\kaberneememarina-2020\wp-content\themes\kaberneememarina\resources\views/partials/content-search.blade.php ENDPATH**/ ?>