<?php


namespace App\Core\Input\Fields\Product\Filter;


use App\Core\Input\Fields\Base\BaseString;

class ExpirationDateTime extends BaseString
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'expiration_date';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'expiration_date';
}
