<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends User
{
    public function checkLoginFree($login) {
        if (preg_match("/^[a-zA-Z]*$/", $login))
            return response()->json([
                'is_free' => !User::where("login", "=", $login)->exists(),
            ]);
    }
    public function checkEmailFree($email) {
        $email_regex = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/';
        if (preg_match($email_regex, $email))
            return response()->json([
                'is_free' => !User::where("email", "=", $email)->exists(),
            ]);
    }
}
