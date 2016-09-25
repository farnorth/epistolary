<?php

namespace Pilaster\Epistolary;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as UuidGenerator;

trait Uuids
{
    /**
     * Set the UUID of the model if none is provided.
     *
     * @return void
     */
    public static function bootUuids()
    {
        static::creating(function (Model $model) {
            $key = $model->getKeyName();
            if (empty($model->{$key})) {
                $model->{$key} = UuidGenerator::uuid4()->toString();
            }
        });
    }
}
