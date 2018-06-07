<?php $__env->startSection('content'); ?>

<div class="col-8">

<section class="content">

<?php echo $__env->make('errors_and_messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<h3>Add To Cart</h3>
	<hr>
<!-- 	<form action="<?php echo e(route('uploadCsv')); ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<input type="file" name="import_file" />
		<button class="btn btn-primary">Import File</button>
	</form> -->

	<form action="<?php echo e(route('addToCart')); ?>" method="post" class="form">
		<div class="box-body">
			<div class="row">
				<?php echo e(csrf_field()); ?>

				<div class="col-md-10">
					<div class="form-group">
						<label for="user_id">User_id <span class="text-danger">*</span></label>
						<input type="text" name="user_id" id="user_id" placeholder="User ID" class="form-control" value="<?php echo e(old('user_id')); ?>">
					</div>
					<div class="form-group">
						<label for="item_id">Item ID <span class="text-danger">*</span></label>
						<input type="text" name="item_id" id="item_id" placeholder="Item Id" class="form-control" value="<?php echo e(old('item_id')); ?>">
					</div>
					<div class="form-group">
						<button class="btn btn-md btn-success">ADD</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>