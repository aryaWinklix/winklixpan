<?php $__env->startSection('content'); ?>


<section class="content">
	<div class="container">
		<div class="card">
		  <img class="card-img-top" src="<?php echo e($item->cover); ?>" alt="Card image cap">
		  <div class="card-body">
		    <h5 class="card-title"><a href="<?php echo e(route('items.show',$item->id)); ?>"><?php echo e($item->name); ?></a></h5>
		    <p class="card-text"><?php echo e($item->description); ?></p>
		    <a href="#" class="btn btn-primary">Add to Cart</a>
		  </div>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>