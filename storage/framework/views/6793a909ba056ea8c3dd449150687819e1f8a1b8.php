<?php $__env->startSection('title', 'All Users'); ?>

<?php $__env->startSection('content'); ?>

<section class="content">
	<?php echo $__env->make('errors_and_messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<h3>All Users</h3>
	<hr>
	<table class="table table-bordered table-striped table-hover" id="data-table">
	    <thead>
	    <tr>
	        <th>ID</th>
	        <th>Name</th>
	        <th>Email</th>
	        <th>Role</th>
	        <th>Floor No</th>
	        <th>Created At</th>
	        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_users', 'delete_users')): ?>
	            <th class="text-center">Edit</th>
	            <th class="text-center">Detete</th>
	        <?php endif; ?>
	    </tr>
	    </thead>
	    <tbody>
	    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	        <tr>
	            <td><?php echo e($user->id); ?></td>
	            <td><?php echo e($user->name); ?></td>
	            <td><?php echo e($user->email); ?></td>
	            <td><?php echo e($user->type); ?></td>
	            <td><?php echo e($user->floor_no); ?></td>
	            <td><?php echo e($user->created_at); ?></td>
	            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_users')): ?>
	            <td class="text-center">
	                <a href="<?php echo e(route('users.edit', $user->id)); ?>">edit</a>  
	              </td>
	              <td>
	                <form action="<?php echo e(route('users.delete',$user->id)); ?>" method="POST">
	                	<?php echo e(csrf_field()); ?>

	                	<input type="hidden" name="_method" value="delete">
	                	<input class="btn btn-sm btn-danger" type="submit" name="delete" value="delete">
	                </form>
	            </td>
	            <?php endif; ?>
	        </tr>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	    </tbody>
	</table>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>