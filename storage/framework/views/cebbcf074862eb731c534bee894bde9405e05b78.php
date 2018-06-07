<?php $__env->startSection('content'); ?>

<div class="col-8">

<section class="content">

  	<?php echo $__env->make('errors_and_messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<h3>Add Item in Your Menu</h3>

	<hr>

	<form action="<?php echo e(route('items.storeItemToMenu')); ?>" method="post" class="form">
		<div class="box-body">
			<div class="row">
				<?php echo e(csrf_field()); ?>

				<div class="col-md-10">
					<div class="form-group">
						<label for="item_id">Item Name </label>
						<!-- <input class="form-control" value="<?php echo e(old('item_id')); ?>" name="item_id" id="item_id" rows="5" placeholder="Payment ID"> -->
						<select class="custom-select" id="item_id" name="item_id">
						    <option selected>Choose...</option>
						    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						    	<option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
						    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </select>
					</div>
					<div class="form-group">
						<label for="price">Price </label>
						<input class="form-control" value="<?php echo e(old('price')); ?>" name="price" id="price" placeholder="price">
					</div> 
					<div class="form-group">
						<label for="stock">Stock </label>
						<input class="form-control" value="<?php echo e(old('stock')); ?>" name="stock" id="stock" placeholder="stock">
					</div> 
					<div class="form-group">
						<label for="minimal_stock">Minimal Stock </label>
						<input class="form-control" value="<?php echo e(old('minimal_stock')); ?>" name="minimal_stock" id="minimal_stock" placeholder="minimal_stock">
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

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
  $(function () {
    
      
  })();
  
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>