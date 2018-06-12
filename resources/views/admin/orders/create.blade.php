@extends('admin.admin')

@section('content')

<div class="col-10">

<section class="content">
@include('errors_and_messages')
<h3>Add Orders</h3>
<button class="btn btn-sm btn-default" id="additem">Add Item</button>
<button class="btn btn-sm btn-info" form="createOrderForm">Create</button>


	<form action="{{ route('orders.store') }}" id="createOrderForm" method="post" class="form" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				{{ csrf_field() }}
				<div class="col-md-10">
					<div class="form-group">
						<label for="user_id">User Name <span class="text-danger">*</span></label>
						<select class="custom-select" id="user_id" name="user_id">
						    <option selected>Choose...</option>
						    @foreach($users as $user)
						    	<option value="{{ $user->id }}">{{ $user->name }}</option>
						    @endforeach
						  </select>
					</div>
					<hr>
				<div class="itemParent">
					<div class="itembox">
						<div class="form-group">
							<label for="item_id">Item Name </label>
							<select class="custom-select" name="item_id[]" id="item_id">
							    <option selected>Choose...</option>
							    @foreach($items as $item)
							    	<option value="{{ $item->id }}">{{ $item->name }}</option>
							    @endforeach
							  </select>
						</div>
						<div class="form-group">
							<label for="quantity">Quantity </label>
							<input class="form-control" value="{{ old('quantity')}}" name="quantity[]" id="quantity" rows="5" placeholder="quantity">
						</div>
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

@endsection

@section('script')

<script type="text/javascript">
  $(document).ready(function() {
  	$('button#additem').on('click',function (e) {
  		e.preventDefault();
  		console.log('here');
  		$('div.itemParent > div.itembox').clone(true).appendTo('div.appendhere');
  	});

  });
</script>

@endsection