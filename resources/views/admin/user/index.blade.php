@extends('admin.admin')

@section('title', 'All Users')

@section('content')

<section class="content">
	@include('errors_and_messages')
	<h3>All Users</h3>
	<hr>
	<table class="table table-bordered table-striped table-hover" id="data-table">
	    <thead>
	    <tr>
	        <th>ID</th>
	        <th>Name</th>
	        <th>Email</th>
	        <th>Role</th>
	        <th>Floor No</th>
	        <th>Created At</th>
	        @can('edit_users', 'delete_users')
	            <th class="text-center">Edit</th>
	            <th class="text-center">Detete</th>
	        @endcan
	    </tr>
	    </thead>
	    <tbody>
	    @foreach($users as $user)
	        <tr>
	            <td>{{ $user->id }}</td>
	            <td>{{ $user->name }}</td>
	            <td>{{ $user->email }}</td>
	            <td>{{ $user->type }}</td>
	            <td>{{ $user->floor_no }}</td>
	            <td>{{ $user->created_at }}</td>
	            @can('edit_users')
	            <td class="text-center">
	                <a href="{{ route('users.edit', $user->id) }}">edit</a>  
	              </td>
	              <td>
	                <form action="{{ route('users.delete',$user->id) }}" method="POST">
	                	{{ csrf_field() }}
	                	<input type="hidden" name="_method" value="delete">
	                	<input class="btn btn-sm btn-danger" type="submit" name="delete" value="delete">
	                </form>
	            </td>
	            @endcan
	        </tr>
	    @endforeach
	    </tbody>
	</table>
</section>

@endsection