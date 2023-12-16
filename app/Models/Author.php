<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
*   @OA\Schema(
*       @OA\Xml(name="Author"),
*       @OA\Property(property="id", type="integer", description="Author unique id", example="1"),
*       @OA\Property(property="name", type="string", description="Author name", example="Roderick"),
*       @OA\Property(property="secondary_name", type="string", description="Author secondary name", example="Ruecker"),
*       @OA\Property(property="surname", type="string", description="Author surname", example="Abbott"),
*       @OA\Property(property="birthday", type="date-time", description="Author birthday", example="1963-05-15"),
*       @OA\Property(property="day_death", type="date-time", description="Author day death", example="2012-11-16"),
*   )
*/

class Author extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "authors";
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
