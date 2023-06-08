<div class="row cards-module">
  <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="col-sm-4">

    <img class="img-fluid" src="<?php echo e($item["image"]); ?>" alt="<?php echo e($item["link"]["title"]); ?>">

    <?php if($item["link"]): ?>
      <a href="<?php echo e($item["link"]["url"]); ?>"><?php echo e($item["link"]["title"]); ?></a>
    <?php endif; ?>

    <?php if($item["content"]): ?>
      <?php echo $item["content"]; ?>

    <?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\kaberneememarina-2020\wp-content\themes\kaberneememarina\resources\views/partials/columns.blade.php ENDPATH**/ ?>