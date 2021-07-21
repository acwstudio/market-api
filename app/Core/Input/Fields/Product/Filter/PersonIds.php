<?php

namespace App\Core\Input\Fields\Product\Filter;

use App\Core\Input\Fields\Base\BaseArray;

class PersonIds extends BaseArray
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'person_ids';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'person_ids';
}
