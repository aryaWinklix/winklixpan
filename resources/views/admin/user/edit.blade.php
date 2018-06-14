@extends('admin.admin')

@section('title', 'Edit Users')

@section('content')

<div class="col-8">

<section class="content">
	@include('errors_and_messages')
	<h3>Edit Users</h3>
	<hr>
	<form action="{{ route('users.update',$user->id) }}" method="post" class="form">
		<div class="box-body">
			<div class="row">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">
				<div class="col-md-10">
					<div class="form-group">
						<label for="name">Name <span class="text-danger">*</span></label>
						<input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $user->name }}">
					</div>
					<div class="form-group">
						<label for="email">Email <span class="text-danger">*</span></label>
						<input type="text" name="email" id="email" placeholder="Email" class="form-control" value="{{ $user->email }}">
					</div>
					<div class="form-group">
						<label for="floor_no">Floor No <span class="text-danger">*</span></label>
						<!-- <select class="custom-select" id="floor_no" name="floor_no">
						    <option selected>Floor No</option>
						    <option value="1">First</option>
						    <option value="2">Second</option>
						    <option value="3">Third</option>
						  </select> -->
						<select class="custom-select" id="floor_no" name="floor_no">
						    <option value="1" {{ '1' == $user->floor_no ? 'selected="selected"' : '' }}>First</option>
						    <option value="2" {{ '2' == $user->floor_no ? 'selected="selected"' : '' }}>Second</option>
						    <option value="3" {{ '3' == $user->floor_no ? 'selected="selected"' : '' }}>Third</option>
						  </select>
					<!-- 	<input type="text" name="floor_no" id="floor_no" placeholder="Floor No" class="form-control" value="{{ old('floor_no') }}"> -->
					</div>
					<div class="form-group">
						<label for="type">Role <span class="text-danger">*</span></label>
					<!-- 	<select class="custom-select" id="type" name="type">
						    <option selected>Role</option>
						    <option value="vendor">Vendor</option>
						    <option value="employee">Employee</option>
						    <option value="client">Client</option>
						  </select> -->
						<select class="custom-select" id="type" name="type">
						    <option value="admin" {{ 'admin' == $user->type ? 'selected="selected"' : '' }}>Admin</option>
						    <option value="vendor" {{ 'vendor' == $user->type ? 'selected="selected"' : '' }}>Vendor</option>
						    <option value="employee" {{ 'employee' == $user->type ? 'selected="selected"' : '' }}>Employee</option>
						    <option value="client" {{ 'client' == $user->type ? 'selected="selected"' : '' }}>Client</option>
						  </select>
						<!-- <input type="text" name="type" id="type" placeholder="Role" class="form-control" value="{{ old('type') }}"> -->
					</div>
					<div class="form-group">
						<label for="password">Password <span class="text-danger">*</span></label>
						<input type="password" name="password" id="password" placeholder="Password" class="form-control" value="secret">
					</div>
					<div class="form-group">
						<label for="password-confirm">Confirm Password <span class="text-danger">*</span></label>
						<input type="password" name="password_confirmation" id="password-confirm" placeholder="Confirm Password" class="form-control" required>
					</div>
					<div class="form-group">
						<button class="btn btn-md btn-success">EDIT</button>
					</div>
				</div>
			</div>
		</div>
	</form>

</section>

@endsection