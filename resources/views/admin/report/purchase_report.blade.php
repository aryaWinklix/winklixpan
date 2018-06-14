@extends('admin.admin')

@section('content')

<div class="col-10">

	<section class="content">

		@include('errors_and_messages')

		<div class="row">
			<h3>Purchase Report</h3>
			<div class="dropdown">
			  <a class="btn btn-default  dropdown-toggle" type="button" id="dropdownMenuTime" data-toggle="dropdown">
			    Select Time
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuTime">
			    <li role="presentation"><a role="menuitem" tabindex="-1" class="dropdown-item" href="{{ route('items.getPurchaseReport',1) }}">This Month</a></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" class="dropdown-item" href="{{ route('items.getPurchaseReport',3) }}">Quarterly</a></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" class="dropdown-item" href="{{ route('items.getPurchaseReport',6) }}">Half Yearly</a></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" class="dropdown-item" href="{{ route('items.getPurchaseReport',12) }}">Yearly</a></li>
			  </ul>
			</div>
		</div>

		<hr>

		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Item Name</th>
					<th scope="col">Specification</th>
					<th scope="col">Quantity</th>
					<th scope="col">Buying Price</th>
					<th scope="col">Total Sales</th>
					<th scope="col">Date of Purchase</th>
				</tr>
			</thead>

			<tbody>
				@foreach($reports as $report)
				<tr>
					<td scope="col">{{ $report->id }}</td>
					<td scope="col">{{ $report->item_name }}</td>
					<td scope="col">{{ str_limit($report->description,20) }}</td>
					<td scope="col">{{ $report->quantity }}</td>
					<td scope="col">{{ $report->price }}</td>
					<td scope="col">{{ $report->total_sales }}</td>
					<td scope="col">{{ $report->delivered_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</section>
</div>

@endsection