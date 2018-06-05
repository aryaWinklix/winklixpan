@extends('admin.admin')

@section('content')

<div class="col-8">

<section class="content">

@include('errors_and_messages')
	<h3>Add Item</h3>
	<hr>
<!-- 	<form action="{{ route('uploadCsv') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="file" name="import_file" />
		<button class="btn btn-primary">Import File</button>
	</form> -->

	<form action="{{ route('items.store') }}" method="post" class="form" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				{{ csrf_field() }}
				<div class="col-md-10">
					<div class="form-group">
						<label for="name">Name <span class="text-danger">*</span></label>
						<input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
					</div>
					<div class="form-group">
						<label for="description">Description </label>
						<textarea class="form-control ckeditor" name="description" id="description" rows="5" placeholder="Description">{{ old('description') }}</textarea>
					</div>
					<div class="form-group">
						<label for="cover">Cover </label>
						<input type="file" name="cover" id="cover" class="form-control">
					</div>
					<div class="form-group">
						<label for="quantity">Quantity <span class="text-danger">*</span></label>
						<input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control" value="{{ old('quantity') }}">
					</div>
					<div class="form-group">
						<label for="price">Price <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="text" name="price" id="price" placeholder="Price" class="form-control" value="{{ old('price') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="calories">Calories </label>
						<input class="form-control" value="{{ old('calories')}}" name="calories" id="calories"  placeholder="Calories">
					</div>
					<div class="form-group">
						<label for="rating">Rating </label>
						<input class="form-control" value="{{ old('rating')}}" name="rating" id="rating" rows="5" placeholder="Ratings">
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

