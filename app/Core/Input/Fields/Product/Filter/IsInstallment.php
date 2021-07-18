<?php


namespace App\Core\Input\Fields\Product\Filter;

use App\Core\Input\Fields\Base\Boolean;

class IsInstallment extends Boolean
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'installment';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'installment';

}
