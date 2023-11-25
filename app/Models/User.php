<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authentictable;

/**
*   @OA\Schema(
*       @OA\Xml(name="User"),
*       @OA\Property(property="id", type="integer", description="User unique id", example="1"),
*       @OA\Property(property="login", type="string", description="User unique login", example="Quisquam"),
*       @OA\Property(property="email", type="string", format="email", description="User unique email address", example="user@gmail.com"),
*       @OA\Property(property="email_verified_at", type="string", format="date-time", description="Datetime marker of verification status", example="2019-02-25 12:59:20"),
*       @OA\Property(property="password", type="string", description="User password hashed", example="$2y$10$/6nto87YdxOHTONClwIlwOPeqWSLvehquDKajllyU9Qq8CJS67crW"),
*   )
*/

class User extends Authentictable implements MustVerifyEmail
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $table = "users";
    protected $guarded = [];

    public function authors() {
        return $this->belongsToMany(Author::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function userInfos() {
        return $this->hasOne(UserInfo::class);
    }
}
