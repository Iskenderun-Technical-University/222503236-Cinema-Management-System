<?php

namespace App\Trait;

use App\Models\AdminsLog;

trait BaseModelTrait
{
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->createLog($model->getName($model) . ' Create', 'New record created');
        });

        static::updated(function ($model) {

            $model->createLog( $model->getName($model) . ' Update', 'Record updated');
        });

        static::deleted(function ($model) {
            $model->createLog($model->getName($model) . ' Delete', 'Record deleted');
        });


    }

    private function createLog($type, $details)
    {
        // Model günlük kaydını oluşturmak için gerekli işlemler
        AdminsLog::create([
            'user_id' => auth()->id(),
            'type' => $type,
            'details' => $details,
            'ip_address' => request()->ip(),
        ]);
    }

    private function getName($model)
    {
        $ar = explode('\\', get_class($model));
        return end($ar);
    }
}
