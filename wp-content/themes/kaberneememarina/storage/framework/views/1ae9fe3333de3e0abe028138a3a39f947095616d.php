<?php (dynamic_sidebar('sidebar-primary')); ?>

<div class="sidebar-items row">
  <div class="col-sm-3 left"><?php echo $sidebar_image; ?></div>
  <div class="col-sm-9 right">
    <?php $__currentLoopData = $sidebar_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="item">
        <?php if($item['icon']): ?>
          <?php echo $__env->make('icon::'.$item['icon'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if($item['link']): ?>
          <a href="<?php echo e($item['link']); ?>"><?php echo e($item['text']); ?></a>
        <?php else: ?>
          <span><?php echo e($item['text']); ?></span>
        <?php endif; ?>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>

<?php if($sidebar_link_1): ?>
<a class="btn btn-secondary" href="<?php echo e($sidebar_link_1['url']); ?>"><?php echo e($sidebar_link_1['title']); ?></a>
<?php endif; ?>

<?php if($sidebar_posts_title): ?>
<h2 class="mehh-title"><?php echo e($sidebar_posts_title); ?></h2>
<?php endif; ?>

<div class="sidebar-posts">
  <?php while($sidebar_posts->have_posts()): ?> <?php ($sidebar_posts->the_post()); ?>
  <?php echo $__env->first(['partials.content-' . get_post_type(), 'partials.content'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endwhile; ?>
</div>

<?php if($sidebar_link_2): ?>
<a class="btn btn-secondary" href="<?php echo e($sidebar_link_2['url']); ?>"><?php echo e($sidebar_link_2['title']); ?></a>
<?php endif; ?>
<?php /**PATH C:\MAMP\htdocs\kaberneememarina\wp-content\themes\kaberneememarina\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>