@extends('front.front')

@section('content')

<section class="content">
	<div class="container">
		<div class="row">
			@foreach($items as $item)
			<div class="col" style="padding-bottom: 20px;">
				<div class="card" style="width: 18rem;">
				  <img class="card-img-top" src="{{ $item->cover }}" height="200" width="200" alt="Card image cap">
				  <div class="card-body">
				    <h5 class="card-title"><a href="{{ route('items.show',$item->slug) }}">{{ $item->name }}</a></h5>
				    <p class="card-text">{{ str_limit($item->description,100) }}</p>
				    <a href="#" class="btn btn-primary">Add to Cart</a>
				  </div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

@endsection

