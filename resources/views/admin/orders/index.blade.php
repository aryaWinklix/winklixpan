@extends('admin.admin')

@section('content')

<div class="col-10">

<section class="content">

  @include('errors_and_messages')
	
<h3>Your Orders</h3>

<hr>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">User ID</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment ID</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    	@foreach($orders as $order)
      <tr>
      	<td>{{ $order->id }}</td>
      	<td>{{ $order->user_id }}</td>
      	<td>{{ $order->amount }}</td>
      	<td>{{ $order->payment_id }}</td>
        <td><a href="{{ route('orders.edit', $order->id) }}">edit</a></td>
        <td>
          <form method="POST" action="{{ route('orders.delete', $order->id) }}">
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

