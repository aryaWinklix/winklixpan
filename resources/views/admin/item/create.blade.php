@extends('admin.admin')

@section('content')

<div class="col-8">

<section class="content">

@include('errors_and_messages')
	<h3>Add Item</h3>
	<hr>

	<form action="{{ route('items.store') }}" method="post" class="form" enctype="multipart/form-data">
		<div class="box-body">
			<div class="row">
				{{ csrf_field() }}
				<div class="col-md-10">
					<div class="form-group">
						<label for="name">Title <span class="text-danger">*</span></label>
						<input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
					</div>
					<div class="form-group">
						<label for="description">Description </label>
						<textarea class="form-control ckeditor" name="description" id="description" rows="5" placeholder="Description">{{ old('description') }}</textarea>
					</div>
					<div class="form-group">
						<label for="cover">Image </label>
						<input type="file" name="cover" id="cover" class="form-control">
					</div>
				<!-- 	<div class="form-group">
						<label for="quantity">Quantity <span class="text-danger">*</span></label>
						<input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control" value="{{ old('quantity') }}">
					</div>
					<div class="form-group">
						<label for="price">Price <span class="text-danger">*</span></label>
						<div class="input-group">
							<input type="text" name="price" id="price" placeholder="Price" class="form-control" value="{{ old('price') }}">
						</div>
					</div> -->
					<div class="form-group">
						<label for="calories">Calories </label>
						<input class="form-control" value="{{ old('calories')}}" name="calories" id="calories"  placeholder="Calories">
					</div>
					<div class="form-group">
						<label for="category">Category </label>
						<input class="form-control" value="{{ old('category')}}" name="category" id="category"  placeholder="Category">
					</div>
					<div class="form-group">
						<button class="btn btn-md btn-success">ADD</button>
					</div>
				</div>
			</div>
		</div>
	</form>
<hr>

</section>
</div>

@endsection

