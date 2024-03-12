<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    public function imagen($archivo)
    {
        if (auth()->check()) {
            $filePath = storage_path('app/producto_img/'.$archivo);

            if (file_exists($filePath)) {
                return response()->file($filePath);
            }
        }

        abort(404);
    }
}
