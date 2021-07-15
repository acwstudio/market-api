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
| I | array int[] | - | [11,12] | Массив идентификаторов |
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
        "I": [11,12],
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
