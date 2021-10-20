<?php

namespace App\Models\Traits;

use ReflectionClass;

trait FieldTrait
{
    public function getField($fieldKey)
    {
        return $this->getAttribute($fieldKey);
    }

    public static function getAllFields($withOutKeys = true)
    {
        $oClass = new ReflectionClass(__CLASS__);
        $constantsList = array_filter($oClass->getConstants(), function ($key) {
            return preg_match('#^FIELD_#', $key) === 1;
        }, ARRAY_FILTER_USE_KEY);

        if ($withOutKeys) {
            return array_values($constantsList);
        }

        return $constantsList;
    }
}
