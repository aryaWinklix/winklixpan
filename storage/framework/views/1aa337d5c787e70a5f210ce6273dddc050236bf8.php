<?php $__env->startSection('content'); ?>

<section class="content">
	<div class="container">
		<div class="row">
			<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col" style="padding-bottom: 20px;">
				<div class="card" style="width: 18rem;">
				  <img class="card-img-top" src="<?php echo e($item->cover); ?>" height="200" width="200" alt="Card image cap">
				  <div class="card-body">
				    <h5 class="card-title"><a href="<?php echo e(route('items.show',$item->slug)); ?>"><?php echo e($item->name); ?></a></h5>
				    <p class="card-text"><?php echo e(str_limit($item->description,100)); ?></p>
				    <a href="#" class="btn btn-primary">Add to Cart</a>
				  </div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>