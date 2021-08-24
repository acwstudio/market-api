## Методы API


## Метод получения направлений по фильтру: directions/list
Адрес: https://mp.synergy.ru/api/v1/directions/list  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Строительство | Название |
| slug      | string  | -   | stroitelstvo | slug |
| show_main      | bool  | -   | true | Показывать на главной |
| ids | array int[] | - | [2,5] | Массив идентификаторов |
| product_ids | array int[] | - | [659, 686] | Массив продуктовых идентификаторов |



Пример запроса:
```
curl --location --request GET 'https://mp.synergy.ru/api/v1/directions/list' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "published": true,
        "name": "Гостеприимство",
        "slug": "gostepriimstvo",
        "show_main": true
    },
    "sort": {
        "field": "sort",
        "order": "desc"
    }
}'
 ```
Пример ответа:
```
{
    "success": true,
    "data": {
        "list": [
            {
                "published": "gostepriimstvo",
                "id": 22,
                "name": "Гостеприимство",
                "slug": "gostepriimstvo",
                "preview_image": "/storage/uploads/directions/fMUGlm2LUUb8NDedBuIItyNvsRRCMFCNf5DgImWc.jpg",
                "show_main": 1
            }
        ],
        "count": 1
    },
    "log_request_id": ""
}
 ```

## Метод получения организаций по фильтру: organizations/list
Адрес: https://mp.synergy.ru/api/v1/organizations/list  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| ids | array int[] | - | [11,12] | Массив идентификаторов |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Университет | Название |
| slug      | string  | -   | universitet | slug |
| land      | string  | -   | - | Распределение лидов |
| parent_id      | int  | -   | 11 | Родительский идентификатор |
| product_ids | array int[] | - | [480, 481, 766] | Массив продуктовых идентификаторов |
| person_ids | array int[] | - | [4, 5, 305] | Массив идентификаторов личностей |


Пример запроса:
```
curl --location --request GET 'https://mp.synergy.ru/api/v1/organizations/list' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [11,12],
        "published": true,
    }
}'
 ```
Пример ответа:
```
{
    "success": true,
    "data": {
        "list": [
            {
                "published": 1,
                "id": 12,
                "name": "Арктический государственный институт культуры и искусств",
                "slug": "arkticheskij-gosudarstvennyj-institut-kultury-i-iskusstv",
                "preview_image": "/storage/",
                "digital_image": "/storage/"
            },
            {
                "published": 1,
                "id": 11,
                "name": "Московский открытый институт",
                "slug": "moskovskij-otkrytyj-institut",
                "preview_image": "/storage/uploads/organizations/preview/GLsx7WewkQosqRlhWoQP6NfLVX4pqC9r45VdrnuF.svg",
                "digital_image": "/storage/uploads/organizations/preview/pgAyidtsjHHw1Ox95VKuFQZXGsGNTRd7uFxyH0GD.png"
            }
        ],
        "count": 2
    },
    "log_request_id": ""
}
 ```

## Метод получения конкретной организации по фильтру: organizations/detail
Адрес: https://mp.synergy.ru/api/v1/organizations/detail  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 11 | Идентификатор |
| slug | string | - | moskovskij-otkrytyj-institut | slug |


Пример запроса:
```
curl --location --request GET 'https://mp.synergy.ru/api/v1/organizations/detail' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "id": 11,
        "slug": "moskovskij-otkrytyj-institut",
    }
}'
 ```
Пример ответа:
```
{
    "success": true,
    "data": {
        "id": 11,
        "parent_id": null,
        "published": 1,
        "name": "Московский открытый институт",
        "slug": "moskovskij-otkrytyj-institut",
        "subtitle": "Образовательная автономная некоммерческая организация высшего образования \"Московский открытый институт\" (ОАНО \"МОИ\")",
        "land": null,
        "description": "С 1988 года  МОИ осуществляет профессиональную подготовку студентов по более 200 программам колледжа, высшего, второго высшего и дополнительного образования. На базе университета существует первая в России школа бизнеса, которая обладает 7 престижными международными аккредитациями AMBA",
        "html_body": "<div class=\"university__table-container\">\r\n                <div class=\"university__table-wrapper\">\r\n                    <div class=\"university__table university__table--4\">\r\n                        <div class=\"university__table-left\">\r\n                            <div class=\"university__table-top\">\r\n                                <div class=\"university__table-item\">\r\n                                    <div class=\"university__table-title university__table-title--small\">Бессрочная лицензия</div>\r\n                                    <div class=\"university__table-text\">на право ведения образовательной деятельности</div>\r\n                                </div>\r\n                                <div class=\"university__table-item\">\r\n                                    <div class=\"university__table-title university__table-title--small\">Доступность</div>\r\n                                    <div class=\"university__table-text\">образовательных услуг и программ</div>\r\n                                </div>\r\n                            </div>\r\n                            <div class=\"university__table-bottom\">\r\n                                <div class=\"university__table-item\">\r\n                                    <div class=\"university__table-title university__table-title--small\">Возможность</div>\r\n                                    <div class=\"university__table-text\">совмещать работу и учебу</div>\r\n                                </div>\r\n                                <div class=\"university__table-item\">\r\n                                    <div class=\"university__table-title university__table-title--small\">Поддержка</div>\r\n                                    <div class=\"university__table-text\">персонального куратора</div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"university__table-right\">\r\n                            <div class=\"university__table-item\">\r\n                                <div class=\"university__table-title university__table-title--small\">Государственный диплом</div>\r\n                                <div class=\"university__table-text\">о высшем образовании и общеевропейское приложение на английском языке</div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>",
        "classes": "university--4 university-moi",
        "color_code_titles": null,
        "address": "125190, г. Москва, Ленинградский проспект, дом 80",
        "type_text": "Образовательная автономная некоммерческая организация высшего образования",
        "map_link": "https://www.google.com/maps/place/%D0%9B%D0%B5%D0%BD%D0%B8%D0%BD%D0%B3%D1%80%D0%B0%D0%B4%D1%81%D0%BA%D0%B8%D0%B9+%D0%BF%D1%80-%D1%82.,+80,+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+125315/@55.8027682,37.5227886,17z/data=!3m1!4b1!4m5!3m4!1s0x46b549c9b692c3f1:0x7a94c903fe8b0996!8m2!3d55.8027682!4d37.5249773",
        "preview_image": "/storage/uploads/organizations/preview/GLsx7WewkQosqRlhWoQP6NfLVX4pqC9r45VdrnuF.svg",
        "digital_image": "/storage/uploads/organizations/preview/pgAyidtsjHHw1Ox95VKuFQZXGsGNTRd7uFxyH0GD.png",
        "created_at": "2021-06-01T14:02:16.000000Z",
        "updated_at": "2021-06-30T11:56:49.000000Z"
    },
    "log_request_id": ""
}
 ```

## Метод получения форматов по фильтру: formats/list
Адрес: https://mp.synergy.ru/api/v1/formats/list  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| ids | array int[] | - | [27,26] | Массив идентификаторов |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Очно-заочная | Название |
| slug      | string  | -   | ochno-zaochnaya | slug |
| product_ids | array int[] | - | [480, 481, 766] | Массив продуктовых идентификаторов |


Пример запроса:
```
curl --location --request GET 'https://mp.synergy.ru/api/v1/formats/list' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [27,26],
        "published": true
    }
}'
 ```
Пример ответа:
```
{
    "success": true,
    "data": {
        "list": [
            {
                "id": 27,
                "name": "Очно-заочная",
                "slug": "ochno-zaochnaya"
            },
            {
                "id": 26,
                "name": "Онлайн",
                "slug": "onlain"
            }
        ],
        "count": 2
    },
    "log_request_id": ""
}
 ```

## Метод получения предметов по фильтру: subjects/list
Адрес: https://mp.synergy.ru/api/v1/subjects/list  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| ids | array int[] | - | [146,145] | Массив идентификаторов |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Торговое дело | Название |
| slug      | string  | -   | torgovoe-delo | slug |
| product_ids | array int[] | - | [480, 481, 766] | Массив продуктовых идентификаторов |


Пример запроса:
```
curl --location --request GET 'https://mp.synergy.ru/api/v1/subjects/list' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [146,145],
        "published": true
    }
}'
 ```
Пример ответа:
```json
{
    "success": true,
    "data": {
        "list": [
            {
                "id": 146,
                "name": "Торговое дело",
                "slug": "torgovoe-delo"
            },
            {
                "id": 145,
                "name": "YouTube",
                "slug": "youtube"
            }
        ],
        "count": 2
    },
    "log_request_id": ""
}
 ```

## Метод получения продуктов по фильтру: products/list
Адрес: https://mp.synergy.ru/api/v1/products/list  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| ids | array int[] | - | [481,480] | Массив идентификаторов |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Предпринимательство | Название |
| slug      | string  | -   | predprinimatelstvo | slug |
| expiration_date | datetime | - | 05.09.2021 00:00 | Истечение срока |
| is_document | boolean | - | true | Наличие диплома по окончании |
| is_installment | boolean | - | true | Наличие рассрочки |
| is_employment | boolean | - | false | Трудоустройство после окончания |
| organization_ids | array int[] | - | [9,10] | Массив идентификаторов организаций |
| subject_ids | array int[] | - | [19,20] | Массив идентификаторов предметов |
| format_ids | array int[] | - | [24,26] | Массив идентификаторов форматов |
| level_ids | array int[] | - | [3,5] | Массив идентификаторов уровней |
| direction_ids | array int[] | - | [19,26] | Массив идентификаторов направлений |
| person_ids | array int[] | - | [15,19] | Массив идентификаторов персон |

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/products/list' \
--header 'Content-Type: application/json' \
--data-raw '{
    "ids": [830,831,832,833,834,835,836,837,486],
        "published": true,
        "name": "Веб-дизайн",
        "slug": "veb-dizain",
        "expiration_date": "24.08.2021 00:00",
        "is_document": true,
        "is_installment": true,
        "is_employment": true,
        "organization_ids": [9,10],
        "subject_ids": [97,26,146],
        "format_ids": [23,26,22],
        "level_ids": [9,2,3],
        "direction_ids": [3,22,11],
        "person_ids": [59,197]
}
```
Пример ответа:
```json
{
    "data": [
        {
            "id": 486,
            "type": "products",
            "published": 1,
            "name": "Веб-дизайн",
            "preview_image": "uploads/products/ldnYcowVVXSnnfxZ7YASOpY2vqAdk5CO182rIaRY.png",
            "organization_id": 9,
            "slug": "veb-dizain"
        }
    ],
    "links": {
        "first": "http://localhost:8003/api/v1/products/list?page=1",
        "last": "http://localhost:8003/api/v1/products/list?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8003/api/v1/products/list?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8003/api/v1/products/list",
        "per_page": 10,
        "to": 1,
        "total": 1
    },
    "count": 1,
    "success": true
}
```

## Метод получения конкретного продукта по фильтру: products/detail
Адрес: https://mp.synergy.ru/api/v1/products/detail  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 500 | Идентификатор |
| slug | string | - | ekonomika-i-buxgalterskii-ucet | slug |


Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/products/detail' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "id": 500,
        "slug": "ekonomika-i-buxgalterskii-ucet"
    }
}'
 ```
Пример ответа:
```json
{
    "data": {
        "id": 500,
        "type": "products",
        "is_moderated": 0,
        "land": "KD_market",
        "published": 1,
        "expiration_date": null,
        "name": "Экономика и бухгалтерский учет",
        "slug": "ekonomika-i-buxgalterskii-ucet",
        "preview_image": "uploads/products/msForBLhr2tXmwVDQiORsnRss8uVcaWJBvbjEuDd.png",
        "digital_image": "uploads/products/PvaMx0ekUZIGPD5rFeiDlj4VJbfopjg1GFQvUkss.png",
        "price": null,
        "start_date": null,
        "is_employment": 1,
        "is_installment": 1,
        "installment_month": 46,
        "is_document": 1,
        "document": 1,
        "triggers": "1|3|5|6",
        "begin_duration": null,
        "begin_duration_format_value": null,
        "duration": 24480,
        "duration_format_value": 1,
        "description": "Программа сделает из вас специалиста, способного оптимизировать финансовую деятельность организации с помощью методов бухгалтерского учета. Вы научитесь грамотно работать с информацией об имущественном положении компании и осуществлять все виды деятельности бухгалтера: учетно-контрольную, экономическую и финансово-аналитическую.",
        "color": "#FFFBD2",
        "organization_id": 9,
        "category_id": 2,
        "user_id": 5,
        "created_at": "2021-06-04T10:19:45.000000Z",
        "updated_at": "2021-06-16T12:45:15.000000Z"
    },
    "success": true,
    "log_request_id": ""
}
 ```

## Метод получения направлений по фильтру: persons/list
Адрес: https://mp.synergy.ru/api/v1/persons/list  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Марина Борисовна Позина | ФИО |
| show_main      | bool  | -   | true | Показывать на главной |
| ids | array int[] | - | [2,11,12,13,14,15,16,17] | Массив идентификаторов |
| product_ids | array int[] | - | [506, 523] | Массив продуктовых идентификаторов |



Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/persons/list' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [2,11,12,13,14,15,16,17],
        "published": true,
        "name": "Марина Борисовна Позина",
        "product_ids": [506, 523]
    }
    "sort": "position"
}'
 ```
Пример ответа:
```json
{
    "data": [
        {
            "id": 2,
            "type": "persons",
            "published": 1,
            "name": "Марина Борисовна Позина",
            "show_main": 0,
            "getPreviewImage": "uploads/persons/IZBoJtlFPiSI7ycGK3GCbEYWGPXWCSbX.jpg"
        }
    ],
    "count": 1,
    "success": true
}
 ```

## Метод получения конкретной персоны по фильтру: persons/detail
Адрес: https://mp.synergy.ru/api/v1/persons/detail  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 12 | Идентификатор |


Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/persons/detail' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "id": 12
    }
}'
 ```
Пример ответа:
```json
{
    "data": {
        "id": 12,
        "type": "persons",
        "published": 1,
        "name": "Лариса Ивановна Грацианова",
        "position": "",
        "show_main": 0,
        "description": "<p>Старший преподаватель кафедры Управления человеческими ресурсами, практический психолог, бизнес-тренер, специалист в области обучения и развития персонала. Стаж руководящей деятельности – более 15 лет.</p>",
        "preview_image": "uploads/persons/7Lg0vaxpyWhsiVwpBiOdLYlkSQn3pkps.jpg",
        "created_at": "2021-06-03T17:22:08.000000Z",
        "updated_at": "2021-08-02T13:13:58.000000Z"
    },
    "success": true,
    "log_request_id": ""
}
 ```

