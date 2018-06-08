@extends('admin.admin')

@section('content')

<div class="col-10">

<section class="content">
@include('errors_and_messages')
<h3>Edit Orders</h3>
<hr>

	<form action="{{ route('orders.update',$order->id) }}" method="post" class="form" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="user_id" value="{{ $order->user_id }}">
				<input type="hidden" name="payment_id" value="{{ $order->payment_id }}">
				<div class="col-md-10">
					<div class="form-group">
						<label for="user_name">User Name <span class="text-danger">*</span></label>
						<input type="text" name="" id="user_name" placeholder="{{ $order->user->name }}" class="form-control" value="{{ $order->user->name }}" disabled="true">
					</div>
					<div class="form-group">
						<label for="amount">Amount <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="text" name="amount" id="amount" placeholder="Amount" class="form-control" value="{{ $order->amount }}">
						</div>
					</div>
					<div class="form-group">
						<label for="payment_id">Payment ID </label>
						<input class="form-control" value="{{ $order->payment_id }}" name="payment_id" id="payment_id" placeholder="{{ $order->payment_id }}" disabled="true">
					</div>
					<div class="form-group">
						<label for="status">Status </label>
						<!-- <input class="form-control" value="{{ $order->status }}" name="status" id="status" rows="5" placeholder="status"> -->
						<select class="custom-select" id="status" name="status">
						    <option value="1">cart</option>
						    <option value="2">processed</option>
						    <option value="3">completed</option>
						  </select>
					</div>
					<div class="form-group">
						<button class="btn btn-md btn-success">Edit</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
		<table class="table">
			<thead class="thead-light">
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Name</th>
			      <th scope="col">Quantity</th>
			      <th scope="col">Status</th>
        		  <th scope="col">Update</th>
			    </tr>
			</thead>
			<tbody>
				@foreach($order->items as $item)
					<tr>
						<td>{{ $item->id }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->pivot->quantity }}</td>
						<td>{{ $item->pivot->status }}</td>
						<td>
				            <button type="button" class="btn btn-sm btn-primary show-model" data-toggle="modal" data-target="#exampleModal" data-id="{{ $item->id }}" data-quantity="{{ $item->pivot->quantity }}" data-status="{{ $item->pivot->status }}">Update</button>
				        </td>
					</tr>
				@endforeach
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
        <form action="{{ route('items.itemStatusUpdate') }}" method="POST" id="itemStatusUpdate">
          {{ csrf_field() }}

          <input type="hidden" name="item_id" id="item_id">
          <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}">
          <div class="form-group">
            <label for="quantity" class="col-form-label">Quantity:</label>
            <input type="text" class="form-control" id="quantity" name="quantity">
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Status:</label>
            <!-- <input type="text" class="form-control" id="status" name="status"> -->
            <select class="custom-select" id="status" name="status">
			    	<option id="cart" value="cart">cart</option>
			    	<option id="pending" value="pending">pending</option>
			    	<option id="deleted" value="deleted">deleted</option>
			    	<option id="delivered" value="delivered">delivered</option>
			    	<option id="received" value="received">received</option>
			    	<option id="inprocess" value="inprocess">inprocess</option>
			    	<option id="packed" value="packed">packed</option>
			    	<option id="shipped" value="shipped">shipped</option>
			    	<option id="rejected" value="rejected">rejected</option>
			    	<option id="dispatched" value="dispatched">dispatched</option>
			    	<option id="cancelled" value="cancelled">cancelled</option>
			  </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="itemStatusUpdate" class="btn btn-sm btn-success">Update</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
  $(function () {
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var item_id = button.data('id'); // Extract info from data-id attributes
        var quantity = button.data('quantity'); // Extract info from data-quantity attributes
        var status = button.data('status'); // Extract info from data-status attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input#quantity').val(quantity);
        modal.find('.modal-body input#item_id').val(item_id);
        modal.find('.modal-body option#'+status).attr('selected','true');
      });
      
  })();
  
</script>

@endsection

