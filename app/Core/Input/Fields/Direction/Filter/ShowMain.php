<?php

namespace App\Core\Input\Fields\Direction\Filter;

use App\Core\Input\Fields\Base\Boolean;

class ShowMain extends Boolean
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'show_main';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'show_main';
}
