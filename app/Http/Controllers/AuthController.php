<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only('logout');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|between6,25|confirmed'
        ]);

        $user = new User($request->all());

        $user->password = bcrypt($request->password);
        $user->save();

        return response()

            ->json([
                'registered' => true,
            ]);
    }

    public function login(Request $request)
    {
        //return response()->json([$request]);
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $user->remember_token = str_random(60);
            $user->save();

            return response()

                ->json([
                    'authenticated' => true,
                    'remember_token' => $user->remember_token,
                    'user_id' => $user->id,
                    'name'=> $user->name

            ]);

        }

        return response()
            ->json ([
                'email' => 'Provider email does not matched'
            ], 422);
    }
}
