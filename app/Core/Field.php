<?php


namespace App\Core;


use App\Core\Error\ErrorSet;

class Field
{
    /**
     * Признак что поле обязательное, используется на этапе валидации.
     * Нужно задавать его при инициализации
     * @var bool
     */
    protected $required = true;

    /**
     * Главное значени поля, вероятно подправленное на уровне prepare
     * @var mixed
     */
    protected $field = null;

    /**
     * Используется для хранения названия поля
     * @var string
     */
    protected $fieldName = 'field';

    protected $stack = [];

    /**
     * Первоначальное значение
     * @var mixed
     */
    protected $originalValue = null;

    /**
     * @var null Значение по умолчанию
     */
    protected $default = null;
    /**
     * @var ErrorSet
     */
    protected $errors;

    /**
     * Field constructor.
     * @param null $field
     * @param bool $required
     */
    public function __construct($field = null, $required = true, $default = null, $stack = [])
    {
        $this->errors = new ErrorSet();
        $this->field = $field;
        $this->originalValue = $field;
        $this->default = $default;
        $this->stack = $stack;
        $this->required = $required;
    }

    function getErrors(): array
    {
        return $this->errors->getErrors();
    }

    function getRequired(): bool
    {
        return $this->required;
    }

    function setRequired(bool $required)
    {
        $this->required = $required;
    }

    /**
     * @return null
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param null $default
     */
    public function setDefault($default): void
    {
        $this->default = $default;
    }

    function getHash(): string
    {
        return md5((string)$this->originalValue);
    }

    function prepare()
    {
        if (is_null($this->field) && !is_null($this->default)) {
            $this->field = $this->default;
        }
    }

    /**
     * @return string
     */
    public function getFieldName($withStack = true, $glue = '.'): string
    {
        $fieldName = '';
        if ($withStack) {
            $fieldName = $this->getStack($glue) . $glue;
        }
        $fieldName .= $this->fieldName;
        return $fieldName;
    }

    function getStack($glue = '.')
    {
        return implode($glue, $this->stack);
    }
}
