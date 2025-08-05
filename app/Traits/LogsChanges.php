<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Models\ModificacionLog;

trait LogsChanges
{
    // Se ejecuta automáticamente al agregar el trait.
    protected static function bootLogsChanges()
    {
        static::created(function ($model) {
            foreach ($model->getAttributes() as $field => $newValue) {
                // Registrar la creación del campo con valor inicial
                $model->logs()->create([
                    'campo_modificado' => $field,
                    'valor_anterior'   => null,
                    'valor_nuevo'      => $newValue,
                    'ip'               => Request::ip(),
                    'user_id'          => Auth::id(),
                ]);
            }
        });
        
        static::updating(function ($model) {
            // Campos que han cambiado en esta actualización
            $dirty = $model->getDirty();

            foreach ($dirty as $field => $newValue) {
                $oldValue = $model->getOriginal($field);

                // Guarda solo si el valor realmente cambió
                if ($oldValue != $newValue) {
                    $model->logs()->create([
                        'campo_modificado' => $field,
                        'valor_anterior'   => $oldValue,
                        'valor_nuevo'      => $newValue,
                        'ip'               => Request::ip(),
                        'user_id'          => Auth::id(),
                    ]);
                }
            }
        });
    }

    /**
     * Relación polimórfica para obtener los logs del modelo que use el trait.
     */
    public function logs()
    {
        return $this->morphMany(ModificacionLog::class, 'loggable');
    }
}
