<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class RegisterController extends Controller
{
    public function store(RegisterFormRequest $request) {

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

    protected function failedValidation(FormRequest $request, ValidationException $exception)
    {
        throw new ValidationException($exception->validator, new JsonResponse($exception->errors(), 422));
    }
}
