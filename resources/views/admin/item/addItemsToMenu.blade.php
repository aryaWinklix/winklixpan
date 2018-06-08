@extends('admin.admin')

@section('content')

<div class="col-8">

<section class="content">

  	@include('errors_and_messages')
	
	<h3>Add Item in Your Menu</h3>

	<hr>

	<form action="{{ route('items.storeItemToMenu') }}" method="post" class="form">
		<div class="box-body">
			<div class="row">
				{{ csrf_field() }}
				<div class="col-md-10">
					<div class="form-group">
						<label for="item_id">Item Name </label>
						<!-- <input class="form-control" value="{{ old('item_id')}}" name="item_id" id="item_id" rows="5" placeholder="Payment ID"> -->
						<select class="custom-select" id="item_id" name="item_id">
						    <option selected>Choose...</option>
						    @foreach($items as $item)
						    	<option value="{{ $item->id }}">{{ $item->name }}</option>
						    @endforeach
						  </select>
					</div>
					<div class="form-group">
						<label for="price">Price </label>
						<input class="form-control" value="{{ old('price')}}" name="price" id="price" placeholder="price">
					</div> 
					<div class="form-group">
						<label for="stock">Stock </label>
						<input class="form-control" value="{{ old('stock')}}" name="stock" id="stock" placeholder="stock">
					</div> 
					<div class="form-group">
						<label for="minimal_stock">Minimal Stock </label>
						<input class="form-control" value="{{ old('minimal_stock')}}" name="minimal_stock" id="minimal_stock" placeholder="minimal_stock">
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

@section('script')

<script type="text/javascript">
  $(function () {
    
      
  })();
  
</script>

@endsection