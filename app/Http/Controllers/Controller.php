<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Registration APi",
 *    version="1.0.0",
 *    @OA\Contact(
 *      name= "API Support",
 *      email= "datsiiak@yandex.ru",
 *      ),
 * )
 * @OA\Tag(
 *    name="Registration",
 *    description="API Endpoints of project"
 * )

 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
