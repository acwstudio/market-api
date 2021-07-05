<?php


namespace App\Core;


use App\Core\Error\ErrorManager;
use App\Core\Error\ErrorSet;

/**
 * Спецыальный тип поля который наследует IField и содержит в себе
 * массив одинаковых IField
 * Очень похож на FieldSet только тут у нас нет requiredFields и все Fields
 * одного типа.
 * В первую очередь этот класс делается под массив водителей
 * Class ArrayField
 * @package App\Core
 */
class FieldArray
{
    /**
     * Обязателен ли этот массив полей (FieldArray) в другом наборе полей
     * при представлении его полем (Field)
     * @var bool
     */
    protected $required;

    protected $initialized = false;

    protected $fieldSetName = "field_array";

    /**
     * Массив куда поместим все екземпляры массива
     * @var
     */
    protected $fields = [];

    /**
     * Вложенность поля, первый элемент массива
     * представляет первый уровень вложенности
     * @var array|string[]
     */
    protected $stack = [];

    /**
     * Важно и необходимо переопределить нужным классом, классом экземпляров
     * @var IField
     */
    protected $fieldClass = null;

    /**
     * @var ErrorSet
     */
    protected $errors = null;

    public function __construct($values = [], $required = false, $stack = [])
    {
        $this->errors = new ErrorSet();
        $this->required = $required;
        $this->fields = [];

        if (is_array($values)) {
            $this->initialized = true;
        } else {
            /**
             * Если не массив то дальше тут нечего делать
             */
            return;
        }

        if ($stack) {
            $this->stack = $stack;
            $this->stack[] = $this->fieldSetName;
        } else {
            $this->stack = [
                $this->fieldSetName
            ];
        }

        foreach ($values as $value) {
            array_push($this->fields, new $this->fieldClass($value, true, $this->stack));
        }
    }

    function validate()
    {
        $this->errors->clean();

        if (!$this->required && !$this->initialized) {
            /**
             * Если это поле необязательное и не задано то нет смысла дальше проверять
             */
            return;
        }

        if ($this->required && !$this->initialized) {
            $this->errors->addError(ErrorManager::buildValidateError(VALIDATION_IS_REQUIRED,
                [
                    ':field' => $this->fieldSetName
                ],
                null,
                [
                    $this->getFieldName()
                ]
            ));
            return;
        }

        foreach ($this->fields as $fieldIndex => $fieldValue) {
            $this->fields[$fieldIndex]->validate();
            $this->errors->appendErrors($this->fields[$fieldIndex]->getErrors());
        }
    }

    /**
     * @return string
     */
    public function getFieldName($withStack = true, $glue = '.'): string
    {
        $fieldName = '';
        if ($withStack) {
            $fieldName = $this->getStack($glue);
        } else {
            $fieldName .= $this->fieldSetName;
        }

        return $fieldName;
    }

    function getStack($glue = '.')
    {
        return implode($glue, $this->stack);
    }

    function prepare()
    {
        foreach ($this->fields as $fieldIndex => $fieldValue) {
            $this->fields[$fieldIndex]->prepare();
            $this->errors->appendErrors($this->fields[$fieldIndex]->getErrors());
        }
    }

    function getErrors(): array
    {
        return $this->errors->getErrors();
    }

    function setValue($value)
    {
        // TODO: Implement setValue() method.
    }

    function getValue()
    {
        // TODO: Implement getValue() method.
    }

    function getCount()
    {
        return $this->fields ? count($this->fields) : 0;
    }

    function getRequired(): bool
    {
        return $this->required;
    }

    function setRequired(bool $required)
    {
        $this->required = $required;
    }

    function getHash(): string
    {
        $hashSet = '';
        foreach ($this->fields as $fieldIndex => $fieldValue) {
            $hashSet .= $this->fields[$fieldIndex]->getHash();
        }

        return md5($hashSet);
    }

    function toArray()
    {
        $resultArray = [];
        foreach ($this->fields as $fieldIndex => $fieldValue) {
            array_push($resultArray, $this->fields[$fieldIndex]->toArray());
        }

        return $resultArray;
    }

    function unset()
    {
        $this->fields = [];
    }
}
