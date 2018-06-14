<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

use App\User;
use App\Role;
use App\Permission;
use App\Authorizable;

class UserController extends Controller
{
    public function index()
	{
	    // $user = User::findOrFail(Auth::user()->id);
		// return $user->getRoleNames();
	    $users = User::all();
	    return view('admin.user.index', compact('users'));
	}

	public function create()
	{
	    $roles = Role::pluck('name', 'id');
	    return view('admin.user.create', compact('roles'));
	}

	public function store(Request $request)
	{
		// return $request->floor_no;
	    $this->validate($request, [
	        'name' => 'bail|required|min:2',
	        'email' => 'required|email|unique:users',
	        'password' => 'required|string|min:6|confirmed',
	        'type' => 'required',
	        'floor_no' => 'required',
	    ]);

	    // // hash password
	    $request->merge(['password' => bcrypt($request->get('password'))]);

	    $user = new User;
	    $user->name = $request->name;
	    $user->email = $request->email;
	    $user->floor_no = $request->floor_no;
	    $user->type = $request->type;
	    $user->password = $request->password;
	    $user->remember_token = str_random(60);

	    // // Create the user
	    if ( $user->save() ) {
	        // $this->syncPermissions($request, $user);
	        session()->flash('message',title_case($user->type).' has been created.');
	    } else {
	        session()->flash('error','Unable to create user.');
	    }

	    return redirect()->route('users.index');
		
		
	    // $this->validate($request, [
	    //     'name' => 'bail|required|min:2',
	    //     'email' => 'required|email|unique:users',
	    //     'password' => 'required|min:6',
	    //     'roles' => 'required|min:1',
	    // ]);

	    // // hash password
	    // $request->merge(['password' => bcrypt($request->get('password'))]);

	    // // Create the user
	    // if ( $user = User::create($request->except('roles', 'permissions')) ) {
	    //     $this->syncPermissions($request, $user);
	    //     flash('User has been created.');
	    // } else {
	    //     flash()->error('Unable to create user.');
	    // }

	    // return redirect()->route('users.index');
	}

	public function edit($id)
	{
	    $user = User::find($id);
	    $roles = Role::pluck('name', 'id');
	    $permissions = Permission::all('name', 'id');

	    return view('admin.user.edit', compact('user', 'roles', 'permissions'));
	}

	public function update(Request $request, $id)
	{
		// return $request;
		  $this->validate($request, [
	        'name' => 'bail|required|min:2',
	        'email' => 'required|email|unique:users,email,' . $id,
	        'floor_no' =>'required',
	        'type' => 'required|min:1',
	        'password' => 'required|string|min:6|confirmed',
	    ]);

	    // Get the user
	    $user = User::findOrFail($id);
	    $user->name = $request->name;
	    $user->email = $request->email;
	    $user->floor_no = $request->floor_no;
	    $user->type = $request->type;


	    // Update user
	    // $user->fill($request->except('roles', 'permissions', 'password'));

	    // check for password change
	    if($request->get('password')) {
	        $user->password = bcrypt($request->get('password'));
	    }

	    if ($user->update()) {	
	    	session()->flash('message','User has been updated.');
	    }else{

	    	session()->flash('error','Error on Updating User Info');
	    }

	    // Handle the user roles
	    // $this->syncPermissions($request, $user);

	    // $user->save();
	    // flash()->success('User has been updated.');
	    return redirect()->route('users.index');

	    // $this->validate($request, [
	    //     'name' => 'bail|required|min:2',
	    //     'email' => 'required|email|unique:users,email,' . $id,
	    //     'roles' => 'required|min:1'
	    // ]);

	    // // Get the user
	    // $user = User::findOrFail($id);

	    // // Update user
	    // $user->fill($request->except('roles', 'permissions', 'password'));

	    // // check for password change
	    // if($request->get('password')) {
	    //     $user->password = bcrypt($request->get('password'));
	    // }

	    // // Handle the user roles
	    // $this->syncPermissions($request, $user);

	    // $user->save();
	    // flash()->success('User has been updated.');
	    // return redirect()->route('users.index');
	}

	public function destroy($id)
	{
	    if ( Auth::user()->id == $id ) {
	        session()->flash('error','Deletion of currently logged in user is not allowed :(');
	        return redirect()->back();
	    }

	    if( User::findOrFail($id)->delete() ) {
	    	session()->flash('message','Deleted Successfully');
	        // flash()->success('User has been deleted');
	    } else {
	    	session()->flash('error','Failed');
	        // flash()->success('User not deleted');
	    }

	    return redirect()->back();
	}

	private function syncPermissions(Request $request, $user)
	{
	    // Get the submitted roles
	    $roles = $request->get('roles', []);
	    $permissions = $request->get('permissions', []);

	    // Get the roles
	    $roles = Role::find($roles);

	    // check for current role changes
	    if( ! $user->hasAllRoles( $roles ) ) {
	        // reset all direct permissions for user
	        $user->permissions()->sync([]);
	    } else {
	        // handle permissions
	        $user->syncPermissions($permissions);
	    }

	    $user->syncRoles($roles);
	    return $user;
	}

	public function getUsersByType($type)
	{
		return view('admin.user.index')->with('users',User::where('type',$type)->get());
	}
}
