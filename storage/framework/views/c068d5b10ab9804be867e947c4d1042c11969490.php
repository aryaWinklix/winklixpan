<?php $__env->startSection('content'); ?>

<div class="col-10">

<section class="content">
<?php echo $__env->make('errors_and_messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<h3>Add Orders</h3>
<button class="btn btn-sm btn-default" id="additem">Add Item</button>
<button class="btn btn-sm btn-info" form="createOrderForm">Create</button>


	<form action="<?php echo e(route('orders.store')); ?>" id="createOrderForm" method="post" class="form" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				<?php echo e(csrf_field()); ?>

				<div class="col-md-10">
					<div class="form-group">
						<label for="user_id">User Name <span class="text-danger">*</span></label>
						<select class="custom-select" id="user_id">
						    <option selected>Choose...</option>
						    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						    	<option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
						    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </select>
					</div>
					<hr>
					<div class="itembox">
						<div class="form-group">
							<label for="item_id">Item Name </label>
							<select class="custom-select" name="item_id" id="item_id">
							    <option selected>Choose...</option>
							    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							    	<option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
							    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							  </select>
						</div>
						<div class="form-group">
							<label for="quantity">Quantity </label>
							<input class="form-control" value="<?php echo e(old('quantity')); ?>" name="quantity" id="quantity" rows="5" placeholder="quantity">
						</div>
					</div>
					<div class="appendhere">
						
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
  $(document).ready(function() {
  	$('button#additem').on('click',function (e) {
  		e.preventDefault();
  		console.log('here');
  		$('div.itembox').clone().appendTo('div.appendhere');
  	});

  });
</script>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>