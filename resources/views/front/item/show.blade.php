@extends('front.front')

@section('content')


<section class="content">
	<div class="container">
		<div class="card">
		  <img class="card-img-top" src="{{ $item->cover }}" alt="Card image cap">
		  <div class="card-body">
		    <h5 class="card-title"><a href="{{ route('items.show',$item->id) }}">{{ $item->name }}</a></h5>
		    <p class="card-text">{{ $item->description }}</p>
		    <a href="#" class="btn btn-primary">Add to Cart</a>
		  </div>
		</div>
	</div>
</section>

@endsection

