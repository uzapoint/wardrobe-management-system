<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    //UPDATE USER-------------
    public function update(Request $request)
    {
        try
        { 
            $user = User::whereId($request->user_id)->first();
            if(!$user)
            {
                return response()->json(['status' => 'bad', 'reason' => 'Unknown user. Please try again later']);
            }

            if(User::where('id', '!=', $user->id)->wherePhone($request->phone)->exists())
            {
                return response()->json(['status' => 'bad', 'reason' => 'Entered phone already exists']);
            }

            if($request->email != "" && User::where('id', '!=', $user->id)->whereEmail($request->email)->exists())
            {
                return response()->json(['status' => 'bad', 'reason' => 'Entered email already exists']);
            }

            $user->update(['username' => $request->username, 'phone' => $request->phone, 'email' => $request->email]);

            return response()->json(['status' => 'ok', 'reason' => 'User updated successfully']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => 'bad', 'reason' => 'An error occured while updating a user. Please try again later']);
        }
    }

    //RESET USER PASSWORD-------------------
    public function resetPassword(Request $request)
    {
        try
        {
            if($request->new_password != $request->confirm_password)
            {
                return response()->json(['status' => 'bad', 'reason' => "New and confirmed passwords don't match"]);
            }

            if(!Hash::check($request->current_password, Auth::user()->password))
            {
                return response()->json(['status' => 'bad', 'reason' => "Invalid current password"]);
            }

            Auth::user()->update(['password' => Hash::make($request->new_password)]);

            return response()->json(['status' => 'ok', 'reason' => 'Password updated successfully']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => 'bad', 'reason' => 'An error occurred while updating a password. Please try again later']);
        }
    }

    //LOGOUT------------------
    public function logout(Request $request)
    {        
        Auth::logout();
        return redirect('home');
    }
}
