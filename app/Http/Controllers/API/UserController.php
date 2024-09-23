<?php

namespace App\Http\Controllers\APIs;

use Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Utilities\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $payload = [];

            if(User::wherePhone($request->phone)->exists())
            {
                return ApiResponse::sendError('Entered phone already exists', $payload, 403);     
            }

            if($request->email != "" && User::whereEmail($request->email)->exists())
            {
                return ApiResponse::sendError('Entered email already exists', $payload, 403);    
            }

            $input = $request->all();

            $validator = Validator::make($input, [
                'username' => 'required',
                'phone' => 'required',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|same:password|min:6|same:password',
            ]);

            if($validator->fails())
            {
                return ApiResponse::sendError('Validation Error', $validator->errors(), 403);       
            }

            $user = User::create(['username' => $request->username, 'phone' => $request->phone, 'email' => $request->email, 'password' => Hash::make($request->password)]);

            $payload['user'] = [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone,
            ]; 

            $payload['token'] =  $user->createToken('API Token')->plainTextToken;
            
            return ApiResponse::sendResponse('User register successfully.',  $payload, 200);
        }catch(\Exception $e)
        {
            $payload['error'] = $e->getMessage();

            return ApiResponse::sendError('An error occured while creating an account', $payload, 403); 
        }
    }

    public function login (Request $request) 
    {
        try
        {
            $payload = [];

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:5',
            ]);

            if($validator->fails())
            {
                return ApiResponse::sendError('Validation Error', $validator->errors(), 403);     
            }

            $credentials = $request->only('email', 'password');

            $user = User::where('email', $request->email)->first();

            if(!$user || !Hash::check($request->password, $user->password)) 
            {
                return ApiResponse::sendError('Invalid credentials', $payload, 403);  
            }
            
            $payload['user'] = [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone
            ];

            $payload['token'] =  $user->createToken('API Token')->plainTextToken;

            return ApiResponse::sendResponse('User Logged successfully.',  $payload, 200);

        }catch(\Exception $e)
        {
            $payload['error'] = $e->getMessage();

            return ApiResponse::sendError('An error occured while login', $payload, 403); 
        }
    }

    public function forgetPassword(Request $request)
    {
        try
        {
            $payload = [];

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
            ]);

            if($validator->fails())
            {
                return ApiResponse::sendError('Validation Error', $validator->errors(), 403);     
            }

            $user = User::where('email', $request->email)->first();
            if(!$user) 
            {
                return ApiResponse::sendError("We can't find a user with that email address.", "", 403);  
            }

            $password = RandomNumber::generatePIN();

            $user->update(['password' => Hash::make($password)]);

            $payload['title'] = "Password Reset";
            $payload['email'] = $request->email;
            $payload['content'] = "Greetings ".$user->username.", we noticed you requested for a password reset. Please use ".$password." as the new password. Remember to change the password as soon as you log in.";

            //SEND EMAIL VIA EMAIL OR SMS

            return ApiResponse::sendResponse("We've sent a new password to your email. Please check it out",  $payload, 200);

        }catch(\Exception $e)
        {
            $payload['error'] = $e->getMessage();

            return ApiResponse::sendError('An error occured while reseting password', $payload, 403); 
        }
    }   

    public function resetPassword(Request $request)
    {
        try
        {
            $payload = [];

            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string|max:255',
                'password' => 'required|string|min:6|max:255',
                'confirm_password' => 'required|same:password|min:6|same:password',
            ]);

            if($validator->fails())
            {
                return ApiResponse::sendError('Validation Error', $validator->errors(), 403);     
            }

            if(!Hash::check($request->current_password, Auth::user()->password))
            {
                return ApiResponse::sendError("Invalid current password", $validator->errors(), 403);
            }

            if($request->password != $request->confirm_password)
            {
                return ApiResponse::sendError("New and confirmed passwords don't match", $validator->errors(), 403);     
            }

            Auth::user()->update(['password' => Hash::make($request->password)]);

            return ApiResponse::sendResponse("Password reset successfully",  $payload, 200);

        }catch(\Exception $e)
        {
            $payload['error'] = $e->getMessage();

            return ApiResponse::sendError('An error occured while reseting password', $payload, 403); 
        }
    }   

    public function logout(Request $request)
    {
        try
        {
            $payload = [];

            $user = Auth::user();

            // Revoke the token that was used to authenticate the current request
            $accessToken = $user->token();
            
            // Revoke the token
            $accessToken->revoke();

            // Optional: Revoke all refresh tokens
            // Token::where('user_id', $user->id)->update(['revoked' => true]);

            return ApiResponse::sendResponse("Successfully logged out",  "", 200);

        }catch(\Exception $e)
        {
            $payload['error'] = $e->getMessage();

            return ApiResponse::sendError('An error occured while logging out', $payload, 403); 
        }
    }
}
