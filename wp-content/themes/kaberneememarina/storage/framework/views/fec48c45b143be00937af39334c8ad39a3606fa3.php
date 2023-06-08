<?php if($cards): ?>
  <div class="cards row">
    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-sm-6">
        <div class="card mb-3">
          <img class="card-img-top" src="<?php echo e($item["image"]); ?>" alt="Card image cap">
          <div class="card-body">
            <h3 class="card-title"><?php echo e($item["title"]); ?></h3>
            <p class="card-text"><?php echo $item["content"]; ?></p>
            <a class="btn btn-secondary" href="<?php echo e($item["link"]["url"]); ?>" class="btn btn-primary"><?php echo e($item["link"]["title"]); ?></a>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\kaberneememarina-2020\wp-content\themes\kaberneememarina\resources\views/partials/cards.blade.php ENDPATH**/ ?>