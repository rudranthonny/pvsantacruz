<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    public function imagen($path, $archivo)
    {
        if (auth()->check()) {
            $filePath = storage_path("app/archivo/$path/$archivo");
            if (file_exists($filePath)) {
                return response()->file($filePath);
            }
        }

        abort(404);
    }
}
