<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
*   @OA\Schema(
*       @OA\Xml(name="UserInfo"),
*       @OA\Property(property="id", type="integer", description="UserInfo unique id", example="1"),
*       @OA\Property(property="name", type="string", description="User name", example="Hanna"),
*       @OA\Property(property="secondary_name", type="string", description="User secondary name", example="Ruecker"),
*       @OA\Property(property="birthday", type="date-time", description="Author birthday", example="1963-05-15 14:32:00"),
*       @OA\Property(property="phone_number", type="integer", description="User phone number", example="18784620214"),
*       @OA\Property(property="about", type="string", description="User about", example="Dolorum et aut optio esse. Laboriosam qui dolor sunt eos asperiores unde. Ullam voluptatem doloribus aut soluta eligendi. Eius molestiae qui tempora quis provident"),
*       @OA\Property(property="photo", type="string", description="User photo link in server", example="images/6JncLoEVFsiGJd1wZ2bw6a0rzOVmP8BOiSnUakCe.jpg"),
*       @OA\Property(property="user_id", type="integer", description="User unique id", example="1"),
*   )
*/

class UserInfo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "userInfos";
    protected $guarded = [];
}
