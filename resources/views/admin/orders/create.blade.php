@extends('admin.admin')

@section('content')

<div class="col-10">

<section class="content">
@include('errors_and_messages')
<h3>Add Orders</h3>
<hr>

	<form action="{{ route('orders.store') }}" method="post" class="form" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				{{ csrf_field() }}
				<div class="col-md-10">
					<div class="form-group">
						<label for="user_id">User ID <span class="text-danger">*</span></label>
						<input type="text" name="user_id" id="user_id" placeholder="User ID" class="form-control" value="{{ old('user_id') }}">
					</div>
					<div class="form-group">
						<label for="amount">Amount <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="text" name="amount" id="amount" placeholder="Amount" class="form-control" value="{{ old('amount') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="payment_id">Payment ID </label>
						<input class="form-control" value="{{ old('payment_id')}}" name="payment_id" id="payment_id" rows="5" placeholder="Payment ID">
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

@endsection

