<?php

use Symfony\Component\HttpFoundation\Response;

/** Error level */
define("ERROR_LEVEL_INTERNAL", 'internal');
define("ERROR_LEVEL_VALIDATE", 'validate');
define("ERROR_LEVEL_PREPARE", 'prepare');
define("ERROR_LEVEL_CALCULATION", 'calculation');

/** Internal */
define("INTERNAL_AUTHENTICATION_API_KEY_NOT_SET", 10002);
define("INTERNAL_AUTHENTICATION_WRONG_API_KEY", 10003);
define("INTERNAL_USER_NOT_FOUND", 10004);
define("INTERNAL_INSURERS_NOT_FOUND", 10005);
define("INTERNAL_ERROR", 10006);
define("INTERNAL_INSURER_NOT_FOUND", 10007);
define("INTERNAL_CALCULATION_NOT_FOUND", 10008);
define("INTERNAL_DATA_NOT_FOUND", 10009);
define("INTERNAL_FORBIDDEN", 10010);
define("INTERNAL_CONTRAGENT_NOT_FOUND", 10011);
define("INTERNAL_METHOD_NOT_FOUND", 10012);
define("INTERNAL_CALCULATION_PAYMENT_NOT_FOUND", 10013);
define("INTERNAL_REQUESTS_EMPTY_CALC_ID_NOT_FOUND", 10014);
define("INTERNAL_REFERRAL_NOT_FOUND", 10015);
define("INTERNAL_CALC_ID_IS_USED", 10100);
define("INTERNAL_SMS_CODE_NOT_FOUND", 10116);
define("INTERNAL_CALCULATION_IN_KASKO_NOT_FOUND", 10117);

/** Validation */
define("VALIDATION_REQUEST_JSON_EXPECTED", 20001);
define("VALIDATION_IS_REQUIRED", 20002);
define("VALIDATION_IS_NOT_STRING", 20003);
define("VALIDATION_IS_NOT_INTEGER", 20004);
define("VALIDATION_IS_NOT_NUMERIC", 200041);
define("VALIDATION_IS_NOT_DATE", 20005);
define("VALIDATION_IS_NOT_BOOLEAN", 20006);
define("VALIDATION_MUST_BE_TRUE", 20010);
define("VALIDATION_NOT_VALID", 20011);
define("VALIDATION_IS_NOT_ARRAY", 20012);
define("VALIDATION_MUST_EXIST", 20013);
define("VALIDATION_WRONG_FORMAT", 20014);
define("VALIDATION_WRONG_FUTURE_DATE_INTERVAL", 20015);
define("VALIDATION_WRONG_PAST_DATE_INTERVAL", 20016);
define("VALIDATION_WRONG_PAST_DATE", 20017);
define("VALIDATION_INVALID_DATE", 20018);
define("VALIDATION_WRONG_FUTURE_DATE", 20019);
define("VALIDATION_WRONG_BIGGER_DATE", 20020);
define("VALIDATION_WRONG_EMAIL", 20021);
define("VALIDATION_WRONG_DRIVER_AGE", 20022);
define("VALIDATION_MAX_PAGE_SIZE_EXCEEDED", 20023);
define("VALIDATION_MIN_PAGE_SIZE_EXCEEDED", 20024);
define("VALIDATION_RECALC_MUST_EXIST", 20025);
define("VALIDATION_USER_WITH_EMAIL_ALREADY_EXIST", 20030);
define("VALIDATION_DISALLOWED_SETTING_NAME", 20031);
define("VALIDATION_NUMBER_MUST_BE_BETWEEN", 20032);
define("VALIDATION_EMAIL_ALREADY_USED", 20033);
define("VALIDATION_CONTRAGENT_ID_NOT_FOUND", 20034);
define("VALIDATION_NOT_CONFIRMED", 20035);
define("VALIDATION_PROGRAM_MUST_EXIST", 20036);
define("VALIDATION_WRONG_CALC_TYPE", 20037);


return [
    ERROR_LEVEL_VALIDATE => [
        VALIDATION_REQUEST_JSON_EXPECTED => [
            "http_code" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "message" => "Запрошенный метод API ожидает на вход Json"
        ],
        VALIDATION_IS_REQUIRED => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field обязательное'
        ],
        VALIDATION_IS_NOT_STRING => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field должно иметь тип STRING'
        ],
        VALIDATION_IS_NOT_INTEGER => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field должно иметь тип INTEGER'
        ],
        VALIDATION_IS_NOT_NUMERIC => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field должно быть числом'
        ],
        VALIDATION_IS_NOT_DATE => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field должно быть датой'
        ],
        VALIDATION_IS_NOT_BOOLEAN => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field должно иметь тип BOOLEAN'
        ],
        VALIDATION_MUST_BE_TRUE => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field принимаем только со значение true'
        ],
        VALIDATION_NOT_VALID => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field невалидное'
        ],
        VALIDATION_IS_NOT_ARRAY => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field должно иметь тип ARRAY'
        ],
        VALIDATION_RECALC_MUST_EXIST => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Результат с :field - ":code" не найден.'
        ],
        VALIDATION_WRONG_FORMAT => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field имеет неверный формат',
        ],
        VALIDATION_INVALID_DATE => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field имеет неправильное значение даты'
        ],
        VALIDATION_WRONG_FUTURE_DATE_INTERVAL => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field имеет значение из прошлого или из далекого будущего',
        ],
        VALIDATION_WRONG_PAST_DATE_INTERVAL => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field имеет значение из будущего или из далекого прошлого'
        ],
        VALIDATION_WRONG_PAST_DATE => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field имеет значение из будущего'
        ],
        VALIDATION_WRONG_FUTURE_DATE => [
            "http_code" => Response::HTTP_BAD_REQUEST,
            "message" => 'Поле :field имеет значение из прошлого'
        ],
    ]
];
