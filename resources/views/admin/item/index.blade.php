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
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Rating</th>
      <th scope="col">Calories</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    	@foreach($items as $item)
      <tr>
      	<td>{{ $item->id }}</td>
      	<td>{{ $item->name }}</td>
      	<td>{{ str_limit($item->description,100) }}</td>
      	<td>{{ $item->price }}</td>
      	<td>{{ $item->quantity }}</td>
      	<td>{{ $item->rating }}</td>
      	<td>{{ $item->calories }}</td>
        <td><a href="{{ route('items.edit', $item->id) }}">edit</a></td>
        <td>
          <form method="POST" action="{{ route('items.delete', $item->id) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-sm btn-danger">delete</button>
          </form>
        </td>
      </tr>
      @endforeach
  </tbody>
</table>

</section>
</div>

@endsection