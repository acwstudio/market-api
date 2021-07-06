<?php

namespace App\Core\Input\Fields\DataProvider;

use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\DataProvider\Sort\Order;
use App\Core\Input\Fields\DataProvider\Sort\SortField;
use App\Core\Input\Fields\Base\Id;

class Sort extends FieldSet implements IField
{
    const FIELD_KEY = 'sort';

    protected $fieldSetName = 'sort';

    /**
     * @var SortField
     */
    protected $field = null;

    /**
     * @var Order
     */
    protected $order = null;

    /**
     * Очень внимательно вписываем тут названия полей
     * @var string[] Fields этого набора
     */
    protected $fields = [
        SortField::FIELD_KEY => SortField::class,
        Order::FIELD_KEY => Order::class,
    ];

    protected $requiredFields = [

    ];

    protected $defaultValues = [
        SortField::FIELD_KEY => Id::FIELD_KEY,
        Order::FIELD_KEY => 'desc',
    ];

    /**
     * @return SortField
     */
    public function getField(): SortField
    {
        return $this->field;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

}
