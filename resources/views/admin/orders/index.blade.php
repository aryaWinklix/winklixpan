@extends('admin.admin')

@section('content')

<div class="col-8">

<section class="content">

  @include('errors_and_messages')
	
<h3>Orders</h3>

<hr>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment ID</th>
      <th scope="col">Status</th>
        @if(Auth::user()->type === 'vendor')
          <th scope="col">In Process/Completed</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        @endif
    </tr>
  </thead>
  <tbody>
    	@foreach($orders as $order)
        @if($order->status != 'cart')
        <tr>
        	<td>{{ $order->id }}</td>
        	<td>{{ $order->user->name }}</td>
        	<td>{{ $order->amount }}</td>
          <td>{{ $order->payment_id }}</td>
          <td>{{ $order->status }}</td>
          @if(Auth::user()->type === 'vendor')
          <td>
            <div class="row">
            <form method="POST" action="{{ route('orders.update',$order->id) }}" style="margin: 5px;">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="user_id" value="{{ $order->user_id }}">
              <input type="hidden" name="payment_id" value="{{ $order->payment_id }}">
              <input type="hidden" name="amount" value="{{ $order->amount }}">
              <input type="hidden" name="status" value="processed">
              <button type="submit" class="btn btn-sm btn-info">Processed</button>
            </form>
            <form method="POST" action="{{ route('orders.update',$order->id) }}" style="margin: 5px;">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="user_id" value="{{ $order->user_id }}">
              <input type="hidden" name="payment_id" value="{{ $order->payment_id }}">
              <input type="hidden" name="amount" value="{{ $order->amount }}">
              <input type="hidden" name="status" value="completed">
              <button type="submit" class="btn btn-sm btn-success">Completed</button>
            </form>
            </div>
          </td>
          <td><a href="{{ route('orders.edit', $order->id) }}">edit</a></td>
          <td>
            <form method="POST" action="{{ route('orders.delete', $order->id) }}">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-sm btn-danger">delete</button>
            </form>
          </td>
          @endif
        </tr>
        @endif
      @endforeach
  </tbody>
</table>

</section>
</div>

@endsection

@section('script')

<script type="text/javascript">
  $(function () {
    
      
  })();
  
</script>

@endsection

