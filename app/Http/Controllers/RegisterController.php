<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\Author;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function store(RegisterFormRequest $request) {

        $validator = Validator::make($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors'=>$validator->errors()], 422);
        }

        if($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
        }

        $user = User::create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user_info = UserInfo::create([
            'name' => $request->name,
            'secondary_name' => $request->secondary_name,
            'birthday' => $request->birthday,
            'phone_number' => $request->phone_number,
            'about' => $request->about,
            'photo' => $path ?? null,
            'user_id' => $user->id,
        ]);

        $user->authors()->attach($request->authors);
        $user->categories()->attach($request->categories);

        event(new Registered($user));
        Auth::login($user);

        return response()->json([
            'status' => 'success',
            ], 200);
    }
}
