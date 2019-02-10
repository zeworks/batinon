<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * 
     * Returns the details of the user
     */
    public function index($id){
        $user = User::where('id',$id)->get(['id','name','email','image']);
        if (!count($user)) {
            return [ 'success' => false, 'message' => 'No valid user'];
        } else {
            return [ 'success' => true, 'data' => $user];
        }
    }

    /**
     * 
     * Validate user actual password
     */
    public function validatePassword(Request $request){
        if ($request->password && $request->id) {
            
            $user = User::where('id', '=', $request->id)->first();

            $validCredentials = Hash::check($request->password, $user->password);

            if (!$validCredentials) {
                return [ 'success' => false, 'message' => 'Invalid Password'];
            } else {
                return [ 'success' => true];
            }
        } else {
            return [ 'success' => false];
        }
    }

    /**
     * 
     * Update user actual password
     */
    public function updatePassword(Request $request){
        if ($request->password && $request->id) {
            
            $user = User::where('id', '=', $request->id)->first();

            $validCredentials = Hash::check($request->password, $user->password);

            if ($validCredentials) {
                return [ 'success' => false, 'message' => 'Your new password, cannot be the same as your old password!'];
            } else {
                $data = ['password' => Hash::make($request->password)];

                User::where('id',$request->id)->update($data);

                return [ 'success' => true, 'message' => 'Password updated with success!'];
            }
        } else {
            return [ 'success' => false];
        }
    }

    /**
     * 
     * Update User
     */
    public function update(Request $request){
        try {
           
            $data = [
                "name" => $request->name,
                "email" => $request->email,
                "image" => $request->image,
            ];
            
            User::where('id',$request->id)->update($data);
            
            return [ 'success' => true, 'message' => 'Profile updated with success!'];
        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => 'Erro, Something went wrong!'];
        }
    }

}
