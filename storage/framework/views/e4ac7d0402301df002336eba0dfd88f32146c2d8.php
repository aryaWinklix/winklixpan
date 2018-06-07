<?php $__env->startSection('content'); ?>

<div class="col-8">

<section class="content">

  <?php echo $__env->make('errors_and_messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<h3>Orders</h3>

<hr>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment ID</th>
      <th scope="col">Status</th>
        <?php if(Auth::user()->type === 'vendor'): ?>
          <th scope="col">In Process/Completed</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        <?php endif; ?>
    </tr>
  </thead>
  <tbody>
    	<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($order->status != 'cart'): ?>
        <tr>
        	<td><?php echo e($order->id); ?></td>
        	<td><?php echo e($order->user->name); ?></td>
        	<td><?php echo e($order->amount); ?></td>
          <td><?php echo e($order->payment_id); ?></td>
          <td><?php echo e($order->status); ?></td>
          <?php if(Auth::user()->type === 'vendor'): ?>
          <td>
            <div class="row">
            <form method="POST" action="<?php echo e(route('orders.update',$order->id)); ?>" style="margin: 5px;">
              <?php echo e(csrf_field()); ?>

              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="user_id" value="<?php echo e($order->user_id); ?>">
              <input type="hidden" name="payment_id" value="<?php echo e($order->payment_id); ?>">
              <input type="hidden" name="amount" value="<?php echo e($order->amount); ?>">
              <input type="hidden" name="status" value="processed">
              <button type="submit" class="btn btn-sm btn-info">Processed</button>
            </form>
            <form method="POST" action="<?php echo e(route('orders.update',$order->id)); ?>" style="margin: 5px;">
              <?php echo e(csrf_field()); ?>

              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="user_id" value="<?php echo e($order->user_id); ?>">
              <input type="hidden" name="payment_id" value="<?php echo e($order->payment_id); ?>">
              <input type="hidden" name="amount" value="<?php echo e($order->amount); ?>">
              <input type="hidden" name="status" value="completed">
              <button type="submit" class="btn btn-sm btn-success">Completed</button>
            </form>
            </div>
          </td>
          <td><a href="<?php echo e(route('orders.edit', $order->id)); ?>">edit</a></td>
          <td>
            <form method="POST" action="<?php echo e(route('orders.delete', $order->id)); ?>">
              <?php echo e(csrf_field()); ?>

              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-sm btn-danger">delete</button>
            </form>
          </td>
          <?php endif; ?>
        </tr>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>

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