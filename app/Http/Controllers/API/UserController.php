<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Validator;
use App\User;
use App\Http\Resources\User\UserResource as UserResource;
use App\Http\Resources\User\CheckAuthResource as CheckAuthResource;

class UserController extends Controller
{
    public function chackAuth(Request $request)
    {
        $validator = Validator::make($request->all(), [
	        'email' => 'required|string',
	        'password' => 'required|string',
        ]);

    	if ($validator->fails()) {
            // return "false";
            $res = [
                'status' => 'failed',
                'message' => 'incorrect credentials'
            ];
            return $res;
        }else{
			$credentials = $request->only('email', 'password');
	        if (Auth::attempt($credentials)) {
	            // return "true";
                // return (new CheckAuthResource(User::where('email',$request->email)->get()))
                //                 ->additional(['status' => 'success',
                //                                 'message' => 'Login SuccessFully'
                //                             ]);
                $res = [
                    'status' => 'success',
                    'message' => 'Login SuccessFully',
                    'userDetails' => User::where('email',$request->email)->get(),
                ];
                return $res;
	        }else{
	            // return "false";
                $res = [
                    'status' => 'failed',
                    'message' => 'incorrect credentials'
                ];
                return $res;
	        }
        }
    }

    public function getUserInfo($id)
    {
        // $user = User::findOrFail($id);
        
        // if ($id < 1) {
        //     $status = [
        //         'status' => 'failed',
        //         'message' => 'Wrong User ID'
        //     ];
        // }else{
        //     $user = User::findOrFail($id)->toJson();
        //     if ($user == "") {
        //         return $user->data;
        //     }else{
        //         $status = [
        //             'status' => 'failed',
        //             'message' => 'Wrong User ID'
        //         ];  
        //     }
        //     // return User::findOrFail($id);
        // }
        // return json_encode(User::findOrFail($id));

    	// return UserResource::collection(User::where('id',$id)->get());
        $res = [
            'status' => 'success',
            'message' => 'User Info is returned SuccessFully',
            'userDetails' => User::where('id',$id)->get(),
        ];
        return $res;
    }

    public function getVendorInfo($floor_no)
    {
        // return UserResource::collection(User::where('type','vendor')->where('floor_no',$floor_no)->get());

        // return (new UserResource(User::where('type','vendor')->where('floor_no',$floor_no)->get()))
        //                         ->additional(['status' => 'success',
        //                                         'message' => 'Login SuccessFully'
        //                                     ]);
        $res = [
            'status' => 'success',
            'message' => 'Vendor Info is returned Successfully',
            'vendorDetails' => User::where('type','vendor')->where('floor_no',$floor_no)->get(),
        ];
        return $res;
    }

    public function getAllVendors()
    {
        $res = [
            'status' => 'success',
            'message' => 'Vendors List is returned Successfully',
            'vendorsDetails' => User::where('type','vendor')->get(),
        ];
        return $res;
    }

    public function updateUserInfo(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'string',
            'email' => 'email',
            'floor_no' => 'string'
        ]);

        if ($validator->fails()) {
            // return "false";
            $res = [
                'status' => 'failed',
                'message' => 'Error on Validating'
            ];
            return $res;
        }else{
            $user = User::findOrFail($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->floor_no = $request->floor_no;
            if ($user->update()) {
                $res = [
                    'status' => 'success',
                    'message' => 'User Info Updated Successfully',
                ];
                return $res;
            }else{
                $res = [
                    'status' => 'error',
                    'message' => 'Error! updation failed',
                ];
                return $res;
            }
        }
    }
}
