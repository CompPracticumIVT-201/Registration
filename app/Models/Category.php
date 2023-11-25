<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
*   @OA\Schema(
*       @OA\Xml(name="Category"),
*       @OA\Property(property="id", type="integer", description="Category unique id", example="1"),
*       @OA\Property(property="title", type="string", description="Category description", example="Ut tempora voluptatem et est"),
*   )
*/

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
