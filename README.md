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
curl --location --request GET 'http://mp-api.tagiev.site/api/v1/directions/list' \
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