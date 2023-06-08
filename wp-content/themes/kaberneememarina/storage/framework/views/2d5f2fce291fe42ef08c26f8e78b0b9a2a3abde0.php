<div id="carousel-1" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php $__currentLoopData = $carousel_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="carousel-item <?php if($key == 0): ?>active <?php endif; ?>" style="background-image: url('<?php echo e($item["background"]); ?>')">
      <div class="carousel-caption">
        <h5><?php echo e($item["title"]); ?></h5>
        <p><?php echo e($item["subtitle"]); ?></p>
        <a class="carousel-bubble carousel-bubble-1 d-none d-xl-flex" href="<?php echo e($item["bubble_1"]["url"]); ?>"><?php echo e($item["bubble_1"]["title"]); ?></a>
        <a class="carousel-bubble carousel-bubble-2 d-none d-xl-flex" href="<?php echo e($item["bubble_2"]["url"]); ?>"><?php echo e($item["bubble_2"]["title"]); ?></a>
        <a class="carousel-bubble carousel-bubble-3 d-none d-xl-flex" href="<?php echo e($item["bubble_3"]["url"]); ?>"><?php echo e($item["bubble_3"]["title"]); ?></a>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <?php if(count($carousel_items) > 1): ?>
    <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\kaberneememarina-2020\wp-content\themes\kaberneememarina\resources\views/partials/modules/carousel.blade.php ENDPATH**/ ?>