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
```
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
```
curl --location --request GET 'https://mp.synergy.ru/api/v1/subjects/list' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [480,481],
        "published": true,
        "name": "Предпринимательство",
        "slug": "predprinimatelstvo",
        "expiration_date": "18.07.2021 00:00",
        "document": true,
        "installment": true,
        "employment": true,
        "organization_ids": [9],
        "subject_ids": [30],
        "format_ids": [22,26],
        "level_ids": [2],
        "direction_ids": [6,8]
    }
}
```
Пример ответа:
```json
{
    "success": true,
    "data": {
        "list": [
            {
                "id": 481,
                "published": 1,
                "name": "Предпринимательство",
                "preview_image": "uploads/products/AcggBXTK06oO4LGm4ibI6pQRfH9OgItHeD7dSNHp.png",
                "organization_id": 9,
                "slug": "predprinimatelstvo"
            }
        ],
        "count": 1
    },
    "log_request_id": ""
}
```
