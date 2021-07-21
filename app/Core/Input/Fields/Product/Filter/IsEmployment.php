<?php


namespace App\Core\Input\Fields\Product\Filter;

use App\Core\Input\Fields\Base\Boolean;

class IsEmployment extends Boolean
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'is_employment';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'is_employment';

}
