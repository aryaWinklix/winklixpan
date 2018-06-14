@extends('admin.admin')

@section('content')

<div class="col-10">

	<section class="content">

		@include('errors_and_messages')

		<h3>Closing Stock</h3>

		<hr>

		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Specification</th>
					<th scope="col">Opening Qty</th>
					<th scope="col">Purchase Qty</th>
					<th scope="col">Closing Qty</th>
					<th scope="col">MRP</th>
					<th scope="col">Amount</th>
				</tr>
			</thead>
			<tbody>
				@foreach($items as $item)
				<tr>
					<td scope="col">{{ $item->id }}</td>
					<td scope="col">{{ $item->name }}</td>
					<td scope="col">{{ str_limit($item->description,20) }}</td>
					<td scope="col">50</td>
					<td scope="col">40</td>
					<td scope="col">10</td>
					<td scope="col">{{ $item->pivot->price }}</td>
					<td scope="col">{{ $item->pivot->stock }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<hr>

		
	</section>
</div>

@endsection