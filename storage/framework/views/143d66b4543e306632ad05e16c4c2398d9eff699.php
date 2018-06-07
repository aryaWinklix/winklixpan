<?php if($errors->all()): ?>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="box no-border">
	<div class="box-tools">
		<p class="alert alert-warning alert-dismissible">
			<?php echo e($message); ?>

			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</p>
	</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php elseif(session()->has('message')): ?>
<div class="box no-border">
	<div class="box-tools">
		<p class="alert alert-success alert-dismissible">
			<?php echo e(session()->get('message')); ?>

			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</p>
	</div>
</div>
<?php elseif(session()->has('error')): ?>
<div class="box no-border">
	<div class="box-tools">
		<p class="alert alert-danger alert-dismissible">
			<?php echo e(session()->get('error')); ?>

			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</p>
	</div>
</div>
<?php endif; ?>