## Методы API


## Метод получения направлений по фильтру: directions/list
Адрес: https://mp.synergy.ru/api/v1/directions/list  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Госслужба | Название |
| slug      | string  | -   | gossluzba | slug |
| show_main      | bool  | -   | true | Показывать на главной |
| ids | array int[] | - | [8,9,10] | Массив идентификаторов |
| product_ids | array int[] | - | [492, 686] | Массив продуктовых идентификаторов |



Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/directions/list' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "published": true,
        "ids": [8,9,10],
        "name": "Госслужба",
        "product_ids": [492]
    },
    "sort": "sort"
}'
 ```
Пример ответа:
```json
{
    "data": [
        {
            "id": 10,
            "type": "directions",
            "published": 1,
            "name": "Госслужба",
            "show_main": 1,
            "getPreviewImage": "uploads/directions/vjw0iGtifs5ERy2eQEasugONeLbQkPuD0OkWUNk3.png"
        }
    ],
    "count": 1,
    "success": true
}
 ```

## Метод получения конкретного направления по фильтру: directions/detail
Адрес: https://mp.synergy.ru/api/v1/directions/detail  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 8 | Идентификатор |
| slug | string | - | biznes | slug |


Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/directions/detail' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "id": 8,
        "slug": "biznes",
    }
}'
 ```
Пример ответа:
```json
{
    "data": {
        "id": 8,
        "type": "type",
        "published": 1,
        "name": "Бизнес",
        "show_main": 1,
        "sort": 4,
        "preview_image": "uploads/directions/4XOGw13ShmuBYNdkuD5czbEUTDNU7oYFRKtHdDmj.png",
        "slug": "biznes",
        "created_at": "2021-05-27T15:12:21.000000Z",
        "updated_at": "2021-07-30T11:07:20.000000Z"
    },
    "success": true,
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
| ids | array int[] | - | [10,11,12,13,14,15,16,17] | Массив идентификаторов |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Томский институт бизнеса" | Название |
| slug      | string  | -   | tomskij-institut-biznesa | slug |
| land      | string  | -   | null | Распределение лидов |
| parent_id      | int  | -   | null | Родительский идентификатор |
| product_ids | array int[] | - | [806] | Массив продуктовых идентификаторов |
| person_ids | array int[] | - | [425] | Массив идентификаторов личностей |


Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/organizations/list' \
--header 'Content-Type: application/json' \
--data-raw '{
    {
    "filter": {
        "ids": [10,11,12,13,14,15,16,17],
        "published": true,
        "name": "Томский институт бизнеса",
        "slug": "tomskij-institut-biznesa",
        "land": null,
        "parent_id": null,
        "product_ids": [806],
        "person_ids": [425]
    }
}
}'
 ```
Пример ответа:
```json
{
    "data": [
        {
            "id": 17,
            "type": "organizations",
            "published": 1,
            "name": "Томский институт бизнеса",
            "slug": "tomskij-institut-biznesa",
            "preview_image": "uploads/organizations/preview/SOS3UalFrXLhpcmAYpGm1c1emf2tjZa3Ft2wqD0I.jpg",
            "digital_image": "uploads/organizations/preview/KdBCwqzNvq3SYY8Oes8tvYSrISpv3z0ojjel0BbV.png"
        }
    ],
    "count": 1,
    "success": true
}
 ```

## Метод получения конкретной организации по фильтру: organizations/detail
Адрес: https://mp.synergy.ru/api/v1/organizations/detail  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 17 | Идентификатор |
| slug | string | - | tomskij-institut-biznesa | slug |


Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/organizations/detail' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "id": 17,
        "slug": "tomskij-institut-biznesa"
    }
}'
 ```
Пример ответа:
```json
{
    "data": {
        "id": 17,
        "type": "organizations",
        "published": 1,
        "name": "Томский институт бизнеса",
        "abbreviation_name": null,
        "slug": "tomskij-institut-biznesa",
        "land": null,
        "subtitle": "Негосударственное (частное) образовательное учреждение высшего образования",
        "description": "Томский институт Бизнеса - это частный ВУЗ, чья история насчитывает более 20 лет образовательной деятельности. Здесь студенты получают не только знания и необходимые профессиональные навыки, но и все условия для личностного и творческого роста. Тёплая дружеская атмосфера и индивидуальный подход к обучению - это то, что мы гарантируем каждому, кто становится нашим студентом.",
        "html_body": "<div class=\"university__table-container\">\r\n                <div class=\"university__table-wrapper\">\r\n                    <div class=\"university__table university__table--3\">\r\n                        <div class=\"university__table-left\">\r\n                            <div class=\"university__table-top\">\r\n                                <div class=\"university__table-item\">\r\n                                    <div class=\"university__table-title title--colored\">>20</div>\r\n                                    <div class=\"university__table-text\">лет образовательной деятельности</div>\r\n                                </div>\r\n                                <div class=\"university__table-item\">\r\n                                    <div class=\"university__table-title title--colored\">5</div>\r\n                                    <div class=\"university__table-text\">направлений обучения</div>\r\n                                </div>\r\n\r\n                            </div>\r\n                            <div class=\"university__table-bottom\">\r\n                                <div class=\"university__table-item\">\r\n                                    <div class=\"university__table-title title--colored\">15 404</div>\r\n                                    <div class=\"university__table-text\">экземпляра в печатном фонде библиотеки Института</div>\r\n                                </div>\r\n                                <div class=\"university__table-item\">\r\n                                    <div class=\"university__table-title title--colored\">2006</div>\r\n                                    <div class=\"university__table-text\">год разработки  уникальной Технологии подготовки предпринимателей</div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"university__table-right\">\r\n                            <div class=\"university__table-item\">\r\n                                <div class=\"university__table-title title--colored\">Государственный диплом</div>\r\n                                <div class=\"university__table-text\">о высшем образовании</div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>",
        "logo_code": "synergy",
        "color_code_titles": "#ca372d",
        "preview_image": "uploads/organizations/preview/SOS3UalFrXLhpcmAYpGm1c1emf2tjZa3Ft2wqD0I.jpg",
        "digital_image": "uploads/organizations/preview/KdBCwqzNvq3SYY8Oes8tvYSrISpv3z0ojjel0BbV.png",
        "address": "634050,  Томск, Томская обл., пл. Батенькова, 2",
        "type_text": "Негосударственное (частное) образовательное учреждение высшего образования",
        "map_link": "https://www.google.com/maps/place/Томский+институт+бизнеса/@56.484854,84.9489893,17z/data=!3m1!4b1!4m5!3m4!1s0x43269367774db46f:0x483bca3d71669b99!8m2!3d56.4846684!4d84.9510821?hl=ru",
        "parent_id": null,
        "created_at": "2021-06-28T06:30:05.000000Z",
        "updated_at": "2021-06-29T09:32:10.000000Z"
    },
    "success": true,
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
| ids | array int[] | - | [830,831,832,833,834,835,836,837,486] | Массив идентификаторов |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Веб-дизайн | Название |
| slug      | string  | -   | veb-dizain | slug |
| expiration_date | datetime | - | 24.08.2021 00:00 | Истечение срока |
| is_document | boolean | - | true | Наличие диплома по окончании |
| is_installment | boolean | - | true | Наличие рассрочки |
| is_employment | boolean | - | true | Трудоустройство после окончания |
| organization_ids | array int[] | - | [9,10] | Массив идентификаторов организаций |
| subject_ids | array int[] | - | [97,26,146] | Массив идентификаторов предметов |
| format_ids | array int[] | - | [23,26,22] | Массив идентификаторов форматов |
| level_ids | array int[] | - | [9,2,3] | Массив идентификаторов уровней |
| direction_ids | array int[] | - | [3,22,11] | Массив идентификаторов направлений |
| person_ids | array int[] | - | [59,197] | Массив идентификаторов персон |

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

## Метод получения персон по фильтру: persons/list
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

