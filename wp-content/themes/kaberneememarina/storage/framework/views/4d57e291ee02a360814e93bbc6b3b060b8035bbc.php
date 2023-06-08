<form role="search" method="get" class="search-form" action="<?php echo e(home_url('/')); ?>">
  <label>
    <span class="screen-reader-text">
      <?php echo e(_x('Search for:', 'label', 'sage')); ?>

    </span>

    <input
      type="search"
      class="form-control search-field rounded-0 d-inline-block w-auto"
      placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'sage'); ?>"
      value="<?php echo e(get_search_query()); ?>"
      name="s"
    >
  </label>

  <input type="submit" class="btn btn-secondary mb-0" value="<?php echo e(esc_attr_x('Search', 'submit button', 'sage')); ?>">
</form>
<?php /**PATH /home/kabernee/public_html/wp-content/themes/kaberneememarina/resources/views/forms/search.blade.php ENDPATH**/ ?>