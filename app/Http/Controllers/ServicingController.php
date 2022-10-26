<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class ServicingController extends Controller
{

    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'faild',
                'statuscode'=>'422',
                'validation_error' => $validator->errors(),
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token =  $user->createToken('MyApp')->accessToken;
        return response()->json([
            'status' => 'sucess',
            'statuscode' => '200',
            'data' =>['token'=>$token],
            'error' => [],
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'faild',
                'statuscode'=>'422',
                'data' =>[],
                'validation_error' => $validator->errors(),
            ]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->accessToken;
            return response()->json([
                'status' => 'sucess',
                'statuscode' => '200',
                'data' =>['token'=>$token],
                'error' => [],
            ]);
        } else {
            return response()->json([
                'status' => 'faild',
                'statuscode' => '404',
                'data' => [],
                'error' => 'Unauthorised',
            ]);
        }
    }
    public function test()
    {
        $user = DB::table('Users')->get();
        return response()->json([
            'status' => 'sucess',
            'statuscode' => '200',
            'data' => $user,
            'error' => [],
        ]);
    }
}
