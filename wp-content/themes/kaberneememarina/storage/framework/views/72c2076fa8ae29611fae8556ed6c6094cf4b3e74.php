<div id="carousel-1" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <p>ASDASDASDASASD</p>
    <?php
    var_dump($accordion_module);
    ?>
    <?php $__currentLoopData = $accordion_module; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="carousel-item">
        <div class="carousel-caption">
          <h5><?php echo e($item["title"]); ?></h5>
          <p><?php echo e($item["content"]); ?></p>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\kaberneememarina-2020\wp-content\themes\kaberneememarina\resources\views/modules/accordion.blade.php ENDPATH**/ ?>