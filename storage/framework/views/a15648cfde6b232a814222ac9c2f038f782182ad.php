<?php $__env->startSection('content'); ?>

<div class="col-8">

<section class="content">

<?php echo $__env->make('errors_and_messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<h3>Edit Item</h3>
	<hr>
	<form action="<?php echo e(route('items.update',$item->id)); ?>" method="post" class="form" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				<?php echo e(csrf_field()); ?>

				<input type="hidden" name="_method" value="PUT">
				<div class="col-md-10">
					<div class="form-group">
						<label for="name">Name <span class="text-danger">*</span></label>
						<input type="text" name="name" id="name" placeholder="Name" class="form-control" value="<?php echo e($item->name); ?>">
					</div>
					<div class="form-group">
						<label for="description">Description </label>
						<textarea class="form-control ckeditor" name="description" id="description" rows="5" placeholder="Description"><?php echo e($item->description); ?></textarea>
					</div>
					<div class="form-group">
						<label for="cover">Cover </label>
						<input type="file" name="cover" id="cover" class="form-control">
					</div>
					<div class="form-group">
						<label for="quantity">Quantity <span class="text-danger">*</span></label>
						<input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control" value="<?php echo e($item->quantity); ?>">
					</div>
					<div class="form-group">
						<label for="price">Price <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="text" name="price" id="price" placeholder="Price" class="form-control" value="<?php echo e($item->price); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="calories">Calories </label>
						<input class="form-control" value="<?php echo e($item->calories); ?>" name="calories" id="calories"  placeholder="Calories">
					</div>
					<div class="form-group">
						<label for="rating">Ratings </label>
						<input class="form-control" value="<?php echo e($item->rating); ?>" name="rating" id="rating" rows="5" placeholder="Rating">
					</div>
					<div class="form-group">
						<button class="btn btn-md btn-success">Edit</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>