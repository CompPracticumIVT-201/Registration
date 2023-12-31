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

/**
* @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     tags={"Registration"},
     *     @OA\Parameter(
     *         name="login",
     *         in="query",
     *         description="Login",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         description="Password confirm",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="secondary_name",
     *         in="query",
     *         description="Secondary name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="birthday",
     *         in="query",
     *         description="Birthday",
     *         required=false,
     *         @OA\Schema(type="date")
     *     ),
     *     @OA\Parameter(
     *         name="phone_number",
     *         in="query",
     *         description="Phone number",
     *         required=false,
     *         @OA\Schema(type="phone")
     *     ),
     *     @OA\Parameter(
     *         name="about",
     *         in="query",
     *         description="About",
     *         required=false,
     *         @OA\Schema(type="text")
     *     ),
     *     @OA\Parameter(
     *         name="photo",
     *         in="query",
     *         description="Photo",
     *         required=false,
     *         @OA\Schema(type="file")
     *     ),
     *     @OA\Parameter(
     *         name="authors[]",
     *         in="query",
     *         description="Authors ids",
     *         required=false,
     *         @OA\Schema(type="array", @OA\Items(type="int")),
     *     ),
     *     @OA\Parameter(
     *         name="categories[]",
     *         in="query",
     *         description="Category ids",
     *         required=false,
     *         @OA\Schema(type="array", @OA\Items(type="int")),
     *     ),
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */

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
            'status' => true,
            'message' => 'Registration success',
            ], 201);
    }

    protected function failedValidation(FormRequest $request, ValidationException $exception) {
        throw new ValidationException($exception->validator, new JsonResponse($exception->errors(), 422));
    }
}
