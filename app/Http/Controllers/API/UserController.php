<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Validator;
use App\User;
use App\Http\Resources\User\UserResource as UserResource;

class UserController extends Controller
{
    public function chackAuth(Request $request)
    {
        $validator = Validator::make($request->all(), [
	        'email' => 'required|string',
	        'password' => 'required|string',
        ]);

    	if ($validator->fails()) {
            return "false";
        }else{
			$credentials = $request->only('email', 'password');
	        if (Auth::attempt($credentials)) {
	            return "true";
	        }else{
	            return "false";
	        }
        }
    }

    public function getUserInfo($id)
    {
        // return User::findOrFail($id)->toArray();
    	return UserResource::collection(User::where('id',$id)->get());
    }
}
