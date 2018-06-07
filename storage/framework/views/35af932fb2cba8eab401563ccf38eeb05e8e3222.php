<?php $__env->startSection('content'); ?>

<div class="col-8">

<section class="content">

<?php echo $__env->make('errors_and_messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<h3>Add Item</h3>
	<hr>
<!-- 	<form action="<?php echo e(route('uploadCsv')); ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<input type="file" name="import_file" />
		<button class="btn btn-primary">Import File</button>
	</form> -->

	<form action="<?php echo e(route('items.store')); ?>" method="post" class="form" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				<?php echo e(csrf_field()); ?>

				<div class="col-md-10">
					<div class="form-group">
						<label for="name">Title <span class="text-danger">*</span></label>
						<input type="text" name="name" id="name" placeholder="Name" class="form-control" value="<?php echo e(old('name')); ?>">
					</div>
					<div class="form-group">
						<label for="description">Description </label>
						<textarea class="form-control ckeditor" name="description" id="description" rows="5" placeholder="Description"><?php echo e(old('description')); ?></textarea>
					</div>
					<div class="form-group">
						<label for="cover">Image </label>
						<input type="file" name="cover" id="cover" class="form-control">
					</div>
				<!-- 	<div class="form-group">
						<label for="quantity">Quantity <span class="text-danger">*</span></label>
						<input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control" value="<?php echo e(old('quantity')); ?>">
					</div>
					<div class="form-group">
						<label for="price">Price <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="text" name="price" id="price" placeholder="Price" class="form-control" value="<?php echo e(old('price')); ?>">
						</div>
					</div> -->
					<div class="form-group">
						<label for="calories">Calories </label>
						<input class="form-control" value="<?php echo e(old('calories')); ?>" name="calories" id="calories"  placeholder="Calories">
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