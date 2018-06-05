@extends('admin.admin')

@section('title', 'All Users')

@section('content')

<section class="content">
	<h3>All Users</h3>

	<hr>

	<table class="table table-bordered table-striped table-hover" id="data-table">
	    <thead>
	    <tr>
	        <th>ID</th>
	        <th>Name</th>
	        <th>Email</th>
	        <th>Role</th>
	        <th>Created At</th>
	        @can('edit_users', 'delete_users')
	            <th class="text-center">Actions</th>
	        @endcan
	    </tr>
	    </thead>
	    <tbody>
	    @foreach($result as $user)
	        <tr>
	            <td>{{ $user->id }}</td>
	            <td>{{ $user->name }}</td>
	            <td>{{ $user->email }}</td>
	            <td>{{ $user->getRoleNames()[0] }}</td>
	            <td>{{ $user->created_at }}</td>
	            @can('edit_users')
	            <td class="text-center">
	                <a href="{{ route('users.edit', $user->id) }}">edit</a>  <a href="{{ route('users.delete',$user->id) }}">delete</a>
	            </td>
	            @endcan
	        </tr>
	    @endforeach
	    </tbody>
	</table>
</section>

@endsection