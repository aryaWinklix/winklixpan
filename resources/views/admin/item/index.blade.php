@extends('admin.admin')

@section('content')

<div class="col-10">

<section class="content">

  @include('errors_and_messages')
	
<h3>All Items</h3>

<hr>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Descrption</th>
      <th scope="col">Calories</th>
      @if(Auth::user()->type === 'vendor')
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Minimal Stock</th>
        <th scope="col">Update</th>
        <th scope="col">Remove</th>
      @endif
      @if(Auth::user()->type === 'admin')
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      @endif
    </tr>
  </thead>
  <tbody>
    	@foreach($items as $item)
      @if(Auth::user()->type == 'vendor')
        @if($item->pivot->minimal_stock < $item->pivot->stock)
          <tr style="background-color:rgb(188, 245, 168);">
        @else
          <tr style="background-color:#f0a59f;">
        @endif
        @endif
      	<td>{{ $item->id }}</td>
      	<td>{{ $item->name }}</td>
      	<td>{{ str_limit($item->description,100) }}</td>
      	<td>{{ $item->calories }}</td>
        @if(Auth::user()->type === 'vendor')
          <td>{{ $item->pivot->price }}</td>
          <td>{{ $item->pivot->stock }}</td>
          <td>{{ $item->pivot->minimal_stock }}</td>
          <!-- <td><a href="{{ route('items.edit', $item->id) }}">update</a></td> -->
          <td>
            <button type="button" class="btn btn-sm btn-primary show-model" data-toggle="modal" data-target="#exampleModal" data-id="{{ $item->id }}" data-price="{{ $item->pivot->price }}" data-stock="{{ $item->pivot->stock }}" data-minstock="{{ $item->pivot->minimal_stock }}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
          </td>
          <td>
            <form method="POST" action="{{ route('items.removeItemFromMenu') }}">
              {{ csrf_field() }}
              <input type="hidden" name="item_id" value="{{ $item->id }}">
              <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
            </form>
          </td>
        @endif
        @if(Auth::user()->type === 'admin')
          <td><a href="{{ route('items.edit', $item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
          <td>
            <form method="POST" action="{{ route('items.delete', $item->id) }}">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
            </form>
          </td>
        @endif
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
        <form action="{{ route('items.itemsAttrUpdate') }}" method="POST" id="itemAttrUpdate">
          {{ csrf_field() }}
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

@endsection

@section('script')

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

@endsection