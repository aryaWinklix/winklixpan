@extends('admin.admin')

@section('content')

<div class="col-8">

<section class="content">

@include('errors_and_messages')
	<h3>Add To Cart</h3>
	<hr>
<!-- 	<form action="{{ route('uploadCsv') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="file" name="import_file" />
		<button class="btn btn-primary">Import File</button>
	</form> -->

	<form action="{{ route('addToCart') }}" method="post" class="form">
		<div class="box-body">
			<div class="row">
				{{ csrf_field() }}
				<div class="col-md-10">
					<div class="form-group">
						<label for="user_id">User_id <span class="text-danger">*</span></label>
						<input type="text" name="user_id" id="user_id" placeholder="User ID" class="form-control" value="{{ old('user_id') }}">
					</div>
					<div class="form-group">
						<label for="item_id">Item ID <span class="text-danger">*</span></label>
						<input type="text" name="item_id" id="item_id" placeholder="Item Id" class="form-control" value="{{ old('item_id') }}">
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

