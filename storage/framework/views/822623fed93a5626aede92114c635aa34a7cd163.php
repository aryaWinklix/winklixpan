<?php $__env->startSection('content'); ?>

<div class="col-10">

<section class="content">

  <?php echo $__env->make('errors_and_messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<h3>All Items</h3>

<hr>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Descrption</th>
      <th scope="col">Calories</th>
      <?php if(Auth::user()->type === 'vendor'): ?>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Minimal Stock</th>
        <th scope="col">Update</th>
      <?php endif; ?>
      <?php if(Auth::user()->type === 'admin'): ?>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      <?php endif; ?>
    </tr>
  </thead>
  <tbody>
    	<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
      	<td><?php echo e($item->id); ?></td>
      	<td><?php echo e($item->name); ?></td>
      	<td><?php echo e(str_limit($item->description,100)); ?></td>
      	<td><?php echo e($item->calories); ?></td>
        <?php if(Auth::user()->type === 'vendor'): ?>
          <td><?php echo e($item->pivot->price); ?></td>
          <td><?php echo e($item->pivot->stock); ?></td>
          <td><?php echo e($item->pivot->minimal_stock); ?></td>
          <!-- <td><a href="<?php echo e(route('items.edit', $item->id)); ?>">update</a></td> -->
          <td>
            <button type="button" class="btn btn-sm btn-primary show-model" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo e($item->id); ?>" data-price="<?php echo e($item->pivot->price); ?>" data-stock="<?php echo e($item->pivot->stock); ?>" data-minstock="<?php echo e($item->pivot->minimal_stock); ?>">Update</button>
          </td>
        <?php endif; ?>
        <?php if(Auth::user()->type === 'admin'): ?>
          <td><a href="<?php echo e(route('items.edit', $item->id)); ?>">edit</a></td>
          <td>
            <form method="POST" action="<?php echo e(route('items.delete', $item->id)); ?>">
              <?php echo e(csrf_field()); ?>

              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-sm btn-danger">delete</button>
            </form>
          </td>
        <?php endif; ?>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>

</section>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo e(route('items.itemsAttrUpdate')); ?>" method="POST" id="itemAttrUpdate">
          <?php echo e(csrf_field()); ?>

          <input type="hidden" name="item_id" id="item_id">
          <div class="form-group">
            <label for="price" class="col-form-label">Price:</label>
            <input type="text" class="form-control" id="price" name="price">
          </div>
          <div class="form-group">
            <label for="Stock" class="col-form-label">Stock:</label>
            <input type="text" class="form-control" id="stock" name="stock">
          </div>
          <div class="form-group">
            <label for="minimal_stock" class="col-form-label">Minimal Stock:</label>
            <input type="text" class="form-control" id="minimal_stock" name="minimal_stock">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="itemAttrUpdate" class="btn btn-sm btn-success">Update</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
  $(function () {
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var item_id = button.data('id'); // Extract info from data-id attributes
        var price = button.data('price'); // Extract info from data-price attributes
        var stock = button.data('stock'); // Extract info from data-stock attributes
        var minimal_stock = button.data('minstock'); // Extract info from data-minstock attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input#price').val(price);
        modal.find('.modal-body input#stock').val(stock);
        modal.find('.modal-body input#minimal_stock').val(minimal_stock);
        modal.find('.modal-body input#item_id').val(item_id);
      });
      
  })();
  
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>