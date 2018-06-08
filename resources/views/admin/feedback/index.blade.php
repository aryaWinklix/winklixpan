@extends('admin.admin')

@section('title', 'Feedback')

@section('content')

<section class="content">
	@include('errors_and_messages')
	<h3>All Feedbacks</h3>
	<hr>
	<table class="table table-bordered table-striped table-hover" id="data-table">
	    <thead>
	    <tr>
	        <th>Item</th>
	        <th>Percentage</th>
	        <th>Responses</th>
	    </tr>
	    </thead>
	    <tbody>
	    @foreach($feedbacks as $key=>$value)
          @if($key=='totalFeedbacks')
         
          @else
	        <tr>
	            <td>{{ $key }}</td>
	            <td>{{ ($value/$feedbacks['totalFeedbacks'])*100 }}%</td>
	            <td>{{ $value }}</td>
	        </tr>
	    
	      @endif
	    @endforeach
	    </tbody>
	</table>
</section>

@endsection