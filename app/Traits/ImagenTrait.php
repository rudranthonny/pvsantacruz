<?php

namespace App\Traits;

trait ImagenTrait
{
    public function eliminar_imagen($imagen)
    {
        if ($imagen) {
            $filePath = storage_path("app/archivo/$imagen");
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    public function subir_imagen($imagen, $file_id, $file_path)
    {
        $extension = $imagen->extension();
        $file_name = $file_id . "-" . strtotime(date('Y-m-d h:i:s')) . "." . $extension;
        dd($imagen->storeAs("archivo/$file_path", $file_name));
        return $imagen->storeAs("archivo/$file_path", $file_name);
    }
}
