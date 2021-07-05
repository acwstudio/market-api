<?php


namespace App\Core;

use App\Core\Error\ErrorManager;
use App\Core\Error\ErrorSet;

class FieldSet
{
    /**
     * Обязателен ли этот набор полей (FieldSet) в другом наборе полей
     * при представлении его полем (Field)
     * @var bool
     */
    protected $required;

    protected $initialized = false;

    protected $fieldSetName = "field_set";

    /**
     * Нужно определить в классе который его наследует
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
     * Нужно отметить обязательные поля
     * @var array
     */
    protected $requiredFields = [];

    /**
     * Нужно отметить значения по умолчанию если такие есть/нужны
     * @var array
     */
    protected $defaultValues = [];

    /**
     * @var ErrorSet
     */
    protected $errors = null;

    public function __construct($values = [], $required = false, $default = null, $stack = [])
    {
        $this->errors = new ErrorSet();
        $this->required = $required;

        if ($stack) {
            $this->stack = $stack;
            $this->stack[] = $this->fieldSetName;
        } else {
            $this->stack = [
                $this->fieldSetName
            ];
        }

        if (is_array($values)) {
            $this->initialized = true;
        }

        foreach ($this->fields as $fieldName => $fieldClass) {
            $this->{$fieldName} = new $this->fields[$fieldName](
                isset($values[$fieldName]) ? $values[$fieldName] : null,
                in_array($fieldName, $this->requiredFields),
                isset($this->defaultValues[$fieldName]) ? $this->defaultValues[$fieldName] : null,
                $this->stack
            );
        }
    }

    function validate()
    {
        $this->errors->clean();

        if (!$this->required && !$this->initialized) {
            /**
             * Если это поле необязательное и не задано то нет смылса дальше проверять
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


        foreach ($this->fields as $fieldName => $fieldClass) {
            $this->{$fieldName}->validate();
            $this->errors->appendErrors($this->{$fieldName}->getErrors());
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
        foreach ($this->fields as $fieldName => $fieldClass) {
            $this->{$fieldName}->prepare();
            $this->errors->appendErrors($this->{$fieldName}->getErrors());
        }
    }

    function getErrors(): array
    {
        return $this->errors->getErrors();
    }

    function isValid(): bool
    {
        return count($this->errors->getErrors()) == 0;
    }

    function getErrorsArray(): array
    {
        return $this->errors->toArray();
    }

    function setValue($value)
    {
        // TODO: Implement setValue() method.
    }

    function getValue()
    {
        // TODO: Implement getValue() method.
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
        foreach ($this->fields as $fieldName => $fieldClass) {
            $hashSet .= $this->{$fieldName}->getHash();
        }

        return md5($hashSet);
    }

    public function setFieldClass($fieldName, $className, $value, $required, $default)
    {
        $this->fields[$fieldName] = $className;
        $this->{$fieldName} = new $this->fields[$fieldName]($value, $required, $default, $this->stack);
    }
}
