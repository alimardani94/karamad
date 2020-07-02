<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class uploadController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function dropzone(Request $request)
    {
        $path = $request->file('file')->store('temp');

        return new JsonResponse([
            'path' => $path,
        ]);
    }

}
