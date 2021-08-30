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

Поля доступные для сотировки: id, name, sort

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/directions/list' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "published": true,
        "ids": [8,9,10],
        "name": "Госслужба",
        "product_ids": [492],
        "show_main": true
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
            "sort": 12,
            "preview_image": "uploads/directions/vjw0iGtifs5ERy2eQEasugONeLbQkPuD0OkWUNk3.png",
            "slug": "gossluzba",
            "created_at": "2021-05-27T15:12:21.000000Z",
            "updated_at": "2021-07-30T11:15:12.000000Z"
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

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/directions/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "slug": "biznes"
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

Поля доступные для сотировки: id, name, address

Пример запроса:
```bash
curl --location --request GET 'http://https://mp.synergy.ru/api/v1/organizations/list' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [10,11,12,13,14,15,16,17],
        "published": true,
        "name": "Томский институт бизнеса",
        "slug": "tomskij-institut-biznesa",
        "land": null,
        "parent_id": null,
        "product_ids": [806],
        "person_ids": [425]
    },
    "sort": "-name"
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

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/organizations/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
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
| ids | array int[] | - | [22,23,24,25,26,27] | Массив идентификаторов |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Заочная | Название |
| slug      | string  | -   | zaochnaya | slug |
| product_ids | array int[] | - | [456] | Массив продуктовых идентификаторов |

Поля доступные для сотировки: id, name

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/formats/list' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [22,23,24,25,26,27],
        "published": true,
        "name": "Заочная",
        "slug": "zaocnaya",
        "product_ids": [546]
    },
    "sort": "id"
}'
 ```
Пример ответа:
```json
{
    "data": [
        {
            "id": 23,
            "type": "formats",
            "published": 1,
            "name": "Заочная",
            "slug": "zaocnaya",
            "created_at": "2021-06-04T10:18:16.000000Z",
            "updated_at": "2021-06-04T10:20:26.000000Z"
        }
    ],
    "count": 1,
    "success": true
}
 ```

## Метод получения конкретной формы обучения по фильтру: formats/detail
Адрес: https://mp.synergy.ru/api/v1/formats/detail  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 22 | Идентификатор |
| slug | string | - | ocnaya | slug |

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/formats/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "id": 22
    }
}'
 ```
Пример ответа:
```json
{
    "data": {
        "id": 22,
        "type": "formats",
        "published": 1,
        "name": "Очная",
        "slug": "ocnaya",
        "created_at": "2021-06-04T10:18:16.000000Z",
        "updated_at": "2021-06-04T10:20:42.000000Z"
    },
    "success": true,
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
| ids | array int[] | - | [10,11,12,13,14,15,16,17,18] | Массив идентификаторов |
| published | bool | - | true | Опубликован |
| name      | string  | -   | Веб-разработка | Название |
| slug      | string  | -   | veb-razrabotka | slug |
| product_ids | array int[] | - | [661,666] | Массив продуктовых идентификаторов |

Поля доступные для сотировки: id, name

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/subjects/list' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [10,11,12,13,14,15,16,17,18],
        "published": true,
        "name": "Веб-разработка",
        "slug": "veb-razrabotka",
        "product_ids": [661,666]
    }
    "sort": "-name"
}'
 ```
Пример ответа:
```json
{
    "data": [
        {
            "id": 13,
            "type": "subjects",
            "published": 1,
            "name": "Веб-разработка",
            "slug": "veb-razrabotka",
            "created_at": "2021-06-04T10:53:25.000000Z",
            "updated_at": "2021-06-04T10:53:25.000000Z"
        }
    ],
    "count": 1,
    "success": true
}
 ```

## Метод получения конкретного предмета по фильтру: subjects/detail
Адрес: https://mp.synergy.ru/api/v1/subjects/detail  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 10 | Идентификатор |
| slug | string | - | animaciya | slug |

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/subjects/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "id": 10
    }
}'
 ```
Пример ответа:
```json
{
    "data": {
        "id": 10,
        "type": "subjects",
        "published": 1,
        "name": "Анимация",
        "slug": "animaciya",
        "created_at": "2021-05-27T15:13:03.000000Z",
        "updated_at": "2021-05-27T15:13:03.000000Z"
    },
    "success": true,
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

Поля доступные для сотировки: name, id, expiration_date

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/products/list' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
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
    },
    "sort": "-id"
}'
```
Пример ответа:
```json
{
    "data": [
        {
            "id": 486,
            "type": "products",
            "is_moderated": 0,
            "land": "KD_market",
            "published": 1,
            "expiration_date": "24.08.2021 16:11",
            "name": "Веб-дизайн",
            "slug": "veb-dizain",
            "preview_image": "uploads/products/ldnYcowVVXSnnfxZ7YASOpY2vqAdk5CO182rIaRY.png",
            "digital_image": "uploads/products/ctqDtKQPIjRVnpYZAPAO5m7p25dF9eAD1Q4AuWDG.png",
            "price": null,
            "start_date": null,
            "is_employment": 1,
            "is_installment": 1,
            "installment_months": 54,
            "is_document": 1,
            "document": 1,
            "triggers": "1|3|5|6",
            "begin_duration": "0",
            "begin_duration_format_value": "0",
            "duration": 38880,
            "duration_format_value": "4y-6m",
            "description": "Web-дизайнер - актуальная и востребованная профессия. Цель программы  – дать актуальные знания в сфере разработки digital-дизайна, обучить современным графическим редакторам и программам, а также анализировать поведения и пожелания целевой аудитории.",
            "color": "#FFEEC3",
            "organization_id": 9,
            "category_id": 2,
            "user_id": 5,
            "created_at": "2021-06-04T10:19:38.000000Z",
            "updated_at": "2021-08-02T07:33:29.000000Z"
        }
    ],
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

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/products/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
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
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [2,11,12,13,14,15,16,17],
        "published": true,
        "name": "Марина Борисовна Позина",
        "product_ids": [506, 523]
    },
    "sort": "name"
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
            "position": "",
            "show_main": 0,
            "description": "Заведующая кафедрой Психологии, к.п.н, сертифицированный профконсультант. Автор научных публикаций.",
            "preview_image": "uploads/persons/IZBoJtlFPiSI7ycGK3GCbEYWGPXWCSbX.jpg",
            "created_at": "2021-06-03T17:22:06.000000Z",
            "updated_at": "2021-08-02T12:51:57.000000Z"
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
--header 'Accept: application/vnd.api+json' \
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

## Метод получения фильтра: filter
Адрес: https://mp.synergy.ru/api/v1/filter  
Тип: GET  
Формат входных данных: JSON<br>

Входных параметров для запроса нет

Пример запроса:

```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/filter' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/vnd.api+json' \
--data-raw ''
```

Пример ответа:
```json
{
    "data": {
        "directions": [
            {
                "id": 1,
                "name": "Экономика и финансы"
            },
            {
                "id": 2,
                "name": "IT"
            }
        ],
        "levels": [
            {
                "id": 1,
                "name": "Школа"
            },
            {
                "id": 2,
                "name": "Колледж"
            },
            {
                "id": 3,
                "name": "Бакалавриат"
            }
        ],
        "formats": [
            {
                "id": 22,
                "name": "Очная"
            },
            {
                "id": 23,
                "name": "Заочная"
            }
        ],
        "subjects": [
            {
                "id": 1,
                "name": "Графический дизайн"
            },
            {
                "id": 2,
                "name": "Дизайн интерьера"
            }
        ]
    },
    "count": null,
    "success": true
}
```

## Метод получения меню: menu
Адрес: https://mp.synergy.ru/api/v1/menu  
Тип: GET  
Формат входных данных: JSON<br>

Входных параметров для запроса нет

Пример запроса:

```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/menu' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/vnd.api+json' \
--data-raw ''
```

Пример ответа:
```json
{
    "data": [
        {
            "id": 1,
            "type": "menus",
            "active": 1,
            "anchor": "Колледж",
            "pointer": 1,
            "link": null
        },
        {
            "id": 2,
            "type": "menus",
            "active": 1,
            "anchor": "Бакалавриат",
            "pointer": 2,
            "link": null
        },
        {
            "id": 3,
            "type": "menus",
            "active": 1,
            "anchor": "Магистратура",
            "pointer": 3,
            "link": null
        },
        {
            "id": 10,
            "type": "menus",
            "active": 1,
            "anchor": "Все форумы",
            "pointer": 10,
            "link": null
        }
    ],
    "count": 4,
    "success": true
}
```

## Метод получения секций продукта по фильтру: products/sections/list
Адрес: https://mp.synergy.ru/api/v1/products/sections/list  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| product_id | integer | + | 549 | Идентификатор |

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/products/sections/list' \
--header 'Content-Type: application/json' \
--header 'Accept: application/vnd.api+json' \
--data-raw '{
    "filter": {
        "product_id": 594
    }
}''
 ```

Пример ответа:
```json
{
    "success": true,
    "data": [
        {
            "product_id": 594,
            "type": "product-sections",
            "section_id": 12,
            "published": 1,
            "title": "Программа обучения",
            "is_hide_anchor": 0,
            "sort": 2,
            "json": {
                "title": {
                    "name": "Жирное значение",
                    "type": "text",
                    "value": "5 000"
                },
                "description": {
                    "name": "Описание",
                    "type": "text",
                    "value": "компаний сейчас ищут специалистов на headhunter"
                }
            }
            "created_at": null,
            "updated_at": null
        },
        {
            "product_id": 594,
            "type": "product-sections",
            "section_id": 13,
            "published": 1,
            "title": "Преподаватели программы",
            "is_hide_anchor": 1,
            "sort": 3,
            "json": [],
            "created_at": null,
            "updated_at": null
        },
    ]
}
```




## Метод получения конкретной секции продукта по фильтру: products/sections/detail
Адрес: https://mp.synergy.ru/api/v1/products/sections/detail  
Тип: GET  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| product_id | integer | - | 549 | Идентификатор |
| section_id | integer | - | 10 | Идентификатор |

Пример запроса:
```bash
curl --location --request GET 'https://mp.synergy.ru/api/v1/products/sections/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "section_id": 10,
        "product_id": 549
    }
}'
 ```

Пример ответа:
```json
{
    "data": {
        "product_id": 549,
        "type": "product-sections",
        "section_id": 10,
        "published": 1,
        "title": "Чему <span>вы научитесь</span>",
        "is_hide_anchor": 0,
        "sort": 500,
        "json": "{\n    \"items\": {\n        \"data\": [\n            {\n                \"title\": {\n                    \"name\": \"Название\",\n                    \"type\": \"text\",\n                    \"value\": \"Мастерству монтажа звука\"\n                }\n            },\n            {\n                \"title\": {\n                    \"name\": \"Название\",\n                    \"type\": \"text\",\n                    \"value\": \"Технологии концертного звукоусиления\"\n                }\n            },\n            {\n                \"title\": {\n                    \"name\": \"Название\",\n                    \"type\": \"text\",\n                    \"value\": \"Звукозаписи в студии\"\n                }\n            },\n            {\n                \"title\": {\n                    \"name\": \"Название\",\n                    \"type\": \"text\",\n                    \"value\": \"Технологии сведения многодорожечных фонограмм\"\n                }\n            },\n            {\n                \"title\": {\n                    \"name\": \"Название\",\n                    \"type\": \"text\",\n                    \"value\": \"Проведению слухового анализа\"\n                }\n            },\n            {\n                \"title\": {\n                    \"name\": \"Название\",\n                    \"type\": \"text\",\n                    \"value\": \"Развитию технического слуха\"\n                }\n            }\n        ],\n        \"name\": \"Элементы\",\n        \"type\": \"list\"\n    }\n}",
        "created_at": null,
        "updated_at": null
    },
    "success": true
}
```
