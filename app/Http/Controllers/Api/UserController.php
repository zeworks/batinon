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
    public function index(Request $request){

        $user = User::where('id', $request->id)->get(['id','name','email','image']);

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
            
            if ($request->image) {
                $image_extension = substr($request->image, strpos($request->image, ".") + 1);
                $name_encoded = base64_encode($request->image).'.'.$image_extension;

                $data['image'] = $name_encoded;
            }

            $data['name'] = $request->name;
            $data['email'] = $request->email;
            
            User::where('id',$request->id)->update($data);
            
            return [ 'success' => true, 'message' => 'Profile updated with success!'];
        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => $e];
        }
    }

}
