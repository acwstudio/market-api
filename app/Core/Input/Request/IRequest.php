<?php


namespace App\Core\Input\Request;


interface IRequest
{
    function validate(): bool;
    function prepare(): bool;
    function save();
}
