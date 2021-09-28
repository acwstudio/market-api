<?php
namespace App\Core\Input\Fields\Organization\Filter;

use App\Core\Input\Fields\Base\BaseArray;

class DirectionIds extends BaseArray
{
    /**
     * Используется в сообщениях где нужно вывести название поля
     */
    const FIELD_NAME = 'direction_ids';

    /**
     * Используется там где нужно указать этот Field как поле в FieldSet
     */
    const FIELD_KEY = 'direction_ids';
}
