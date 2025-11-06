<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_address' => 'required|email',
            'password' => 'required'
        ], [
            'email_address.required' => 'Please enter your email address',
            'password.required' => 'Please enter your password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => "warning",
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Laravel controller
        $user = User::where('email_address', $request->input("email_address"))->first();

        if (! $user || ! Hash::check($request->input("password"), $user->password)) {
            return response()->json([
                "status" => 'warning',
                'message' => 'Invalid credentials'
            ], 401); // Unauthorized
        }

        $token = $user->createToken('mobile-token')->plainTextToken;


        return response()->json([
            'status' => "success",
            'message' => 'Login successful',
            'token' => $token
        ], 200);
    }

    public function user(Request $request)
    {

        return $request->user();
    }
}
