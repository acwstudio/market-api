<?php

namespace App\Core\Input\Fields\Organization\Filter;

use App\Core\Input\Fields\Base\Integer;

class ParentId extends Integer
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'parent_id';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'parent_id';
}
