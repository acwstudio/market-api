<?php

namespace App\Core\Input\Fields\Format\Filter;

use App\Core\Input\Fields\Base\BaseArray;

class Ids extends BaseArray
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'ids';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'ids';
}
