<?php

namespace App\Core;

interface IField
{
    /**
     * Установка значения
     * @param $value
     * @return mixed
     */
    function setValue($value);

    /**
     * Отдает значение
     * @return mixed
     */
    function getValue();

    /**
     * Валидация входных данных от пользователя
     * @return mixed
     */
    function validate();

    /**
     * Преобразование входных данных в те что нужны нам
     * @return mixed
     */
    function prepare();

    function getErrors(): array;

    function setRequired(bool $required);

    function getRequired(): bool;

    function getHash(): string;
}
