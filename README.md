## Методы API

#### Страницы  
+ [Метод получения конкретной страницы: page](#method_page);
+ [Метод получения конкретной секции страницы по фильтру: entities/sections/detail](#method_pages_sections_detail);
+ [Метод получения глобальной информации о сайте: app/site](#method_app_site); 

#### Навигация
+ [Метод получения меню: menu](#method_menu);
+ [Метод получения главного меню по фильтру: menu/main](#method_menu_main);

#### Организации
+ [Метод получения организаций по фильтру: organizations/list](#method_organizations_list);
+ [Метод получения конкретной организации по фильтру: organizations/detail](#method_organizations_detail);
+ [Метод получения секций организации по фильтру: entities/sections/list](#method_organizations_sections_list);
+ [Метод получения конкретной секции организации по фильтру: entities/sections/detail](#method_organizations_sections_detail);

#### Продукты
+ [Метод получения фильтра продуктов на главной странице: filters/products/main](#method_filter_products_main);
+ [Метод получения фильтра продуктов: filters/products/catalog](#method_filter);
+ [Метод получения пресетов фильтра продуктов: filters/products/presets](#method_filter_presets);
+ [Метод получения продуктов по фильтру: products/list](#method_products_list);
+ [Метод получения конкретного продукта по фильтру: products/detail](#method_products_detail);
+ [Метод получения секций продукта по фильтру: entities/sections/list](#method_products_sections_list);
+ [Метод получения конкретной секции продукта по фильтру: entities/sections/detail](#method_products_sections_detail);

#### Персоны
+ [Метод получения персон по фильтру: persons/list](#method_persons_list);
+ [Метод получения конкретной персоны по фильтру: persons/detail](#method_persons_detail);

#### Контент
+ [Метод получения баннеров по фильтру: banners/list](#method_banners_list);
+ [Метод получения конкретного баннера по фильтру: banners/detail](#method_banners_detail);
+ [Метод получения квизов по фильтру: quizzes/list](#method_quizzes_list);
+ [Метод получения конкретного квиза по фильтру: quizzes/detail](#method_quizzes_detail);

#### Другое
+ [Метод получения направлений по фильтру: directions/list](#method_directions_list);
+ [Метод получения конкретного направления по фильтру: directions/detail](#method_directions_detail);
+ [Метод получения форматов по фильтру: formats/list](#method_formats_list);
+ [Метод получения конкретного формата обучения по фильтру: formats/detail](#method_formats_detail);
+ [Метод получения предметов по фильтру: subjects/list](#method_subjects_list);
+ [Метод получения конкретного предмета по фильтру: subjects/detail](#method_subjects_detail);


## <a name="method_page"></a> Метод получения конкретной страницы: page
Адрес: https://mp.synergy.ru/api/v1/page  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | integer | - | 3 | Идентификатор |
| slug | string | - | product | slug |

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/page' \
--header 'Content-Type: application/json' \
--header 'Accept: application/vnd.api+json' \
--data-raw '{
    "filter": {
        "slug": "product"
    },
    "params": {
        "id": 100,
        "slug": "sdfsdf"
    }
}'
 ```

Пример ответа:
```json
{
    "success": true,
    "data": {
        "id": 3,
        "name": "Карточка товара",
        "slug": "product",
        "static": false,
        "page_type": "product",
        "components": [
            {
                "id": 1,
                "title": "Карточка товара",
                "key": "product_detail",
                "view_type": "product",
                "methods": [
                    {
                        "data": {
                            "filter": {
                                "id": 100
                            }
                        },
                        "url": "/api/v1/products/detail"
                    },
                    {
                        "data": {
                            "filter": {
                                "product_id": 100
                            }
                        },
                        "url": "/api/v1/products/sections/list"
                    }
                ]
            },
            {
                "id": 2,
                "title": "Самые востребованные профессии\n",
                "key": "most_popular_product_list",
                "view_type": "product_list",
                "methods": [
                    {
                        "data": {},
                        "url": "/api/v1/products/list"
                    }
                ]
            }
        ],
        "meta": {
            "h1": "H1 - Главный заголовок",
            "title": "Title - заголовок вкладки браузера",
            "keywords": "keywords",
            "description": "Description Description"
        }
    }
}
```

## <a name="method_directions_list"></a> Метод получения направлений по фильтру: directions/list
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
curl --location --request POST 'https://mp.synergy.ru/api/v1/directions/list' \
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

## <a name="method_directions_detail"></a> Метод получения конкретного направления по фильтру: directions/detail
Адрес: https://mp.synergy.ru/api/v1/directions/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 8 | Идентификатор |
| slug | string | - | biznes | slug |

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/directions/detail' \
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

## <a name="method_organizations_list"></a> Метод получения организаций по фильтру: organizations/list
Адрес: https://mp.synergy.ru/api/v1/organizations/list  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип         | Обязательное | Пример                    | Комментарий
| ------------- | ----------- | ------------ | ------------------------- | ---------------------------------- |
| ids           | array int[] | -            | [10,11,12,13,14,15,16,17] | Массив идентификаторов             |
| published     | bool        | -            | true                      | Опубликован                        |
| name          | string      | -            | Томский институт бизнеса  | Название                           |
| slug          | string      | -            | tomskij-institut-biznesa  | slug                               |
| land          | string      | -            | null                      | Распределение лидов                |
| parent_id     | int         | -            | null                      | Родительский идентификатор         |
| city_ids      | array int[] | -            | [8]                       | Массив идентификаторов городов     |
| direction_ids | array int[] | -            | [1,2,3]                   | Массив идентификаторов направлений |
| level_ids     | array int[] | -            | [2,3,4]                   | Массив идентификаторов уровней     |
| format_ids    | array int[] | -            | [3,4,5]                   | Массив идентификаторов форматов    |
| product_ids   | array int[] | -            | [806]                     | Массив продуктовых идентификаторов |
| person_ids    | array int[] | -            | [425]                     | Массив идентификаторов личностей   |

Поля, доступные для сортировки: id, name, address

Пример запроса:
```bash
curl --location --request POST 'http://https://mp.synergy.ru/api/v1/organizations/list' \
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
        "city_ids": [8],
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
            "city_id": 8,
            "created_at": "2021-06-28T06:30:05.000000Z",
            "updated_at": "2021-06-29T09:32:10.000000Z"
        }
    ],
    "count": 1,
    "success": true
}
 ```

## <a name="method_organizations_detail"></a> Метод получения конкретной организации по фильтру: organizations/detail
Адрес: https://mp.synergy.ru/api/v1/organizations/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 17 | Идентификатор |
| slug | string | - | tomskij-institut-biznesa | slug |

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/organizations/detail' \
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
        "city_id": 8,
        "created_at": "2021-06-28T06:30:05.000000Z",
        "updated_at": "2021-06-29T09:32:10.000000Z"
    },
    "success": true,
    "log_request_id": ""
}
 ```

## <a name="method_formats_list"></a> Метод получения форматов по фильтру: formats/list
Адрес: https://mp.synergy.ru/api/v1/formats/list  
Тип: POST  
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
curl --location --request POST 'https://mp.synergy.ru/api/v1/formats/list' \
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

## <a name="method_formats_detail"></a> Метод получения конкретного формата обучения по фильтру: formats/detail
Адрес: https://mp.synergy.ru/api/v1/formats/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 22 | Идентификатор |
| slug | string | - | ocnaya | slug |

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/formats/detail' \
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

## <a name="method_subjects_list"></a> Метод получения предметов по фильтру: subjects/list
Адрес: https://mp.synergy.ru/api/v1/subjects/list  
Тип: POST  
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
curl --location --request POST 'https://mp.synergy.ru/api/v1/subjects/list' \
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

## <a name="method_subjects_detail"></a> Метод получения конкретного предмета по фильтру: subjects/detail
Адрес: https://mp.synergy.ru/api/v1/subjects/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 10 | Идентификатор |
| slug | string | - | animaciya | slug |

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/subjects/detail' \
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

## <a name="method_products_list"></a>  Метод получения продуктов по фильтру: products/list
Адрес: https://mp.synergy.ru/api/v1/products/list  
Тип: POST  
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
curl --location --request POST 'https://mp.synergy.ru/api/v1/products/list' \
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

## <a name="method_products_detail"></a> Метод получения конкретного продукта по фильтру: products/detail
Адрес: https://mp.synergy.ru/api/v1/products/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 500 | Идентификатор |
| slug | string | - | ekonomika-i-buxgalterskii-ucet | slug |

* Указывать можно какое-нибудь одно

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/products/detail' \
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

## <a name="method_persons_list"></a> Метод получения персон по фильтру: persons/list
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
curl --location --request POST 'https://mp.synergy.ru/api/v1/persons/list' \
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

## <a name="method_persons_detail"></a> Метод получения конкретной персоны по фильтру: persons/detail
Адрес: https://mp.synergy.ru/api/v1/persons/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| id | id | - | 12 | Идентификатор |


Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/persons/detail' \
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

## <a name="method_filter_presets"></a> Метод получения фильтра: filters/products/presets
Адрес: https://mp.synergy.ru/api/v1/filters/products/presets  
Тип: POST  
Формат входных данных: JSON<br>

Входных параметров для запроса нет

Пример запроса:

```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/filters/products/presets' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/vnd.api+json' \
--data-raw ''
```

Пример ответа:
```json
{
    "success": true,
    "data": [
        {
            "name": "UI\\UX дизайнер",
            "filter": {
                "published": true,
                "direction_ids": [
                    1
                ],
                "level_ids": [
                    1,
                    2
                ]
            }
        },
        {
            "name": "Менеджер по продажам",
            "filter": {
                "published": true,
                "direction_ids": [
                    5,
                    6
                ]
            }
        }
    ]
}
```


## <a name="method_filter"></a> Метод получения фильтра: filters/products/catalog
Адрес: https://mp.synergy.ru/api/v1/filters/products/catalog  
Тип: POST  
Формат входных данных: JSON<br>

Входных параметров для запроса нет

Пример запроса:

```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/filters/products/catalog' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/vnd.api+json' \
--data-raw ''
```

Пример ответа:
```json
{
    "success": true,
    "data": [
        {
            "title": "Направления",
            "filter_by": "directions",
            "type": "list",
            "search": false,
            "values": [
                {
                    "id": 1,
                    "name": "Экономика и финансы"
                },
                {
                    "id": 2,
                    "name": "IT"
                }
            ]
        },
        {
            "title": "Уровни",
            "filter_by": "levels",
            "type": "list",
            "search": false,
            "values": [
                {
                    "id": 1,
                    "name": "Школа"
                },
                {
                    "id": 2,
                    "name": "Колледж"
                }
            ]
        },
        {
            "title": "Форматы",
            "filter_by": "formats",
            "type": "list",
            "search": false,
            "values": [
                {
                    "id": 22,
                    "name": "Очная"
                },
                {
                    "id": 23,
                    "name": "Заочная"
                }
            ]
        },
        {
            "title": "Учебные заведения",
            "filter_by": "organization_id",
            "type": "list",
            "search": true,
            "values": [
                {
                    "id": 9,
                    "name": "333Университет «Синергия»"
                },
                {
                    "id": 10,
                    "name": "Московская академия предпринимательства"
                }
            ]
        },
        {
            "title": "С трудоустройством",
            "filter_by": "is_employment",
            "type": "checkbox",
            "search": true,
            "values": [
                true,
                false
            ]
        },
        {
            "title": "В рассрочку",
            "filter_by": "is_installment",
            "type": "checkbox",
            "search": true,
            "values": [
                true,
                false
            ]
        },
        {
            "title": "Города",
            "filter_by": "city_ids",
            "type": "list",
            "search": true,
            "values": [
                {
                    "id": 1,
                    "name": "г Сочи"
                },
                {
                    "id": 2,
                    "name": "Москва"
                },
                {
                    "id": 3,
                    "name": "Ростов-на-Дону"
                }
            ]
        }
    ]
}
```

## <a name="method_filter_products_main"></a> Метод получения фильтра продуктов на главной странице: filters/products/main
Адрес: https://mp.synergy.ru/api/v1/filters/products/main
Тип: POST  
Формат входных данных: JSON<br>

Входных параметров для запроса нет

Пример запроса:

```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/filters/products/main' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/vnd.api+json' \
--data-raw ''
```

Пример ответа:
```json
{
    "data": 
    [
        {
            "name": "Направления",
            "slug": "directions",
            "items": [
                {
                    "id": 1,
                    "name": "Экономика и финансы",
                    "count": 55,
                    "page": {
                        "filter": {
                            "slug": "catalog"
                        },
                        "params": {
                            "directions": [
                                1
                            ]
                        }
                    }
                },
                {
                    "id": 2,
                    "name": "IT",
                    "count": 68,
                    "page": {
                        "filter": {
                            "slug": "catalog"
                        },
                        "params": {
                            "directions": [
                                2
                            ]
                        }
                    }
                }
            ]
        },
        {
            "name": "Уровни обучения",
            "slug": "levels",
            "items": [
                {
                    "id": 1,
                    "name": "Школа",
                    "count": 1,
                    "page": {
                        "filter": {
                            "slug": "catalog"
                        },
                        "params": {
                            "levels": [
                                1
                            ]
                        }
                    }
                },
                {
                    "id": 2,
                    "name": "Колледж",
                    "count": 48,
                    "page": {
                        "filter": {
                            "slug": "catalog"
                        },
                        "params": {
                            "levels": [
                                2
                            ]
                        }
                    }
                }
            ]
        }
    ],
    "success": true
}
```

## <a name="method_menu"></a> Метод получения меню: menu
Адрес: https://mp.synergy.ru/api/v1/menu  
Тип: POST  
Формат входных данных: JSON<br>

Входных параметров для запроса нет

Пример запроса:

```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/menu' \
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

## <a name="method_products_sections_list"></a> Метод получения секций продукта по фильтру: entities/sections/list
Адрес: https://mp.synergy.ru/api/v1/entities/sections/list  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| entity_id | integer | + | 549 | Идентификатор |
| entity_type | string | + | "product" | Идентификатор |

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/entities/sections/list' \
--header 'Content-Type: application/json' \
--header 'Accept: application/vnd.api+json' \
--data-raw '{
    "filter": {
        "entity_id": 594
        "entity_type": "product"
    }
}''
 ```

Пример ответа:
```json
{
    "success": true,
    "data": [
        {
            "entity_id": 594,
            "entity_type": "product",
            "type": "entity-sections",
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
            },
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
        }
    ]
}
```

## <a name="method_products_sections_detail"></a> Метод получения конкретной секции продукта по фильтру: entities/sections/detail
Адрес: https://mp.synergy.ru/api/v1/entities/sections/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | ------- | --- | ---------------- | ------------------------------ |
| entity_id | integer | - | 549 | Идентификатор |
| entity_type | string | - | "product" | Идентификатор |
| section_id | integer | - | 10 | Идентификатор |

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/entities/sections/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "section_id": 10,
        "entity_id": 549,
        "entity_type": "product",
    }
}'
 ```

Пример ответа:
```json
{
    "data": {
        "entity_id": 549,
        "entity_type": "product",
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

## <a name="method_banners_list"></a> Метод получения баннеров по фильтру: banners/list
Адрес: https://mp.synergy.ru/api/v1/banners/list  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип         | Обязательное | Пример              | Комментарий
| ------------- | ----------- | ------------ | ------------------- | ---------------------- |
| ids           | array int[] | -            | [1,3]               | Массив идентификаторов |
| published     | bool        | -            | true                | Опубликован            |
| name          | string      | -            | Баннер 1            | Название               |
| link          | string      | -            | http://example.ru/1 | Ссылка                 |
| banner_type   | string      | -            | narrow              | Тип                    |
| colour        | string      | -            | #ff0000             | Цвет                   |
| description   | string      | -            | Good banner         | Описание               |



Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/banners/list' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "ids": [1,3],
        "published": true,
    },
    "sort": "-name"
}'
 ```
Пример ответа:
```json
{
    "data": [
        {
            "id": 1,
            "type": "banners",
            "published": 1,
            "name": "Баннер 1",
            "link": "http://example.ru/1",
            "banner_type": "narrow",
            "colour": "#ff0000",
            "description": "Good banner",
            "image": "uploads\/banners\/nSDOUocleJZcOhTtaSbdk1IR5eqAQz5DlBAaov4B.jpg",
            "created_at": "2021-09-01T17:12:25.000000Z",
            "updated_at": "2021-09-01T17:22:47.000000Z"
        },
        {
            "id": 3,
            "type": "banners",
            "published": 1,
            "name": "Banner 2",
            "link": "http://example.ru/2",
            "banner_type": "top",
            "colour": "#00ff00",
            "description": "Excellent banner",
            "image": "uploads\/banners\/lRfJ0FoRDx2xz9odVM7Hn0BoeDxObc92nXozynfm.jpg",
            "created_at": "2021-09-01T17:35:12.000000Z",
            "updated_at": "2021-09-02T17:38:01.000000Z"
        }
    ],
    "count": 2,
    "success": true
}
 ```

## <a name="method_banners_detail"></a> Метод получения конкретного баннера по фильтру: banners/detail
Адрес: https://mp.synergy.ru/api/v1/banners/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | --- | ------------ | ------ | ------------- |
| id            | id  | -            | 3      | Идентификатор |


Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/banners/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "id": 3
    }
}'
 ```
Пример ответа:
```json
{
    "data": {
        "id": 3,
        "type": "banners",
        "published": 1,
        "name": "Banner 2",
        "link": "http://example.ru/2",
        "banner_type": "top",
        "colour": "#00ff00",
        "description": "Excellent banner",
        "image": "uploads\/banners\/lRfJ0FoRDx2xz9odVM7Hn0BoeDxObc92nXozynfm.jpg",
        "created_at": "2021-09-01T17:35:12.000000Z",
        "updated_at": "2021-09-02T17:38:01.000000Z"
    },
    "success": true,
    "log_request_id": ""
}
 ```

## <a name="method_organizations_sections_list"></a> Метод получения секций организации по фильтру: entities/sections/list
Адрес: https://mp.synergy.ru/api/v1/entities/sections/list  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля   | Тип     | Обязательное | Пример         | Комментарий
| --------------- | ------- | ------------ | ---------------| ------------- |
| entity_id       | integer | +            | 10             | Идентификатор |
| entity_type     | string  | +            | "organization" | Идентификатор |

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/entities/sections/list' \
--header 'Content-Type: application/json' \
--header 'Accept: application/vnd.api+json' \
--data-raw '{
    "filter": {
        "entity_id": 10,
        "entity_type": "organization",
    }
}''
 ```

Пример ответа:
```json
{
    "success": true,
    "data": [
        {
            "entity_id": 10,
            "entity_type": "organization",
            "type": "entity-sections",
            "section_id": 18,
            "published": 1,
            "title": "Об университете",
            "sort": 500,
            "json": {
                "top": {
                    "data": [
                        {
                            "description": {
                                "name": "Значение",
                                "type": "text",
                                "value": "Международные стандарты обучения"
                            }
                        },
                        {
                            "description": {
                                "name": "Значение",
                                "type": "text",
                                "value": "Практическая направленность"
                            }
                        },
                        {
                            "description": {
                                "name": "Значение",
                                "type": "text",
                                "value": "Государственный диплом"
                            }
                        },
                        {
                            "description": {
                                "name": "Значение",
                                "type": "text",
                                "value": "Доверие работодателей"
                            }
                        },
                        {
                            "description": {
                                "name": "Значение",
                                "type": "text",
                                "value": "Помощь в трудоустройстве"
                            }
                        },
                        {
                            "description": {
                                "name": "Значение",
                                "type": "text",
                                "value": "Ориентация на подготовку кадров в сфере потребительского рынка и услуг для города Москвы"
                            }
                        }
                    ],
                    "name": "Элементы сверху (с галочками)",
                    "type": "list"
                },
                "bottom": {
                    "data": [
                        {
                            "title": {
                                "name": "Заголовок",
                                "type": "text",
                                "value": "ТОП-100"
                            },
                            "description": {
                                "name": "Описание",
                                "type": "text",
                                "value": "лучших ВУЗов России"
                            }
                        },
                        {
                            "title": {
                                "name": "Заголовок",
                                "type": "text",
                                "value": "5"
                            },
                            "description": {
                                "name": "Описание",
                                "type": "text",
                                "value": "программ бакалавриата"
                            }
                        },
                        {
                            "title": {
                                "name": "Заголовок",
                                "type": "text",
                                "value": "от 4 лет"
                            },
                            "description": {
                                "name": "Описание",
                                "type": "text",
                                "value": "срок обучения"
                            }
                        }
                    ],
                    "name": "Элементы",
                    "type": "list"
                },
                "bottom_title": {
                    "name": "Заголовок нижнего блока",
                    "type": "text",
                    "value": "Об академии в цифрах"
                }
            },
            "created_at": null,
            "updated_at": null
        }
    ]
}
```

## <a name="method_organizations_sections_detail"></a> Метод получения конкретной секции организации по фильтру: entities/sections/detail
Адрес: https://mp.synergy.ru/api/v1/entities/sections/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля   | Тип     | Обязательное | Пример         | Комментарий
| --------------- | ------- | ------------ | -------------- | ------------- |
| entity_id       | integer | +            | 10             | Идентификатор |
| entity_type     | string  | +            | "organization" | Идентификатор |
| section_id      | integer | +            | 18             | Идентификатор |

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/entities/sections/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "entity_id": 10,
        "entity_type": "organization",
        "section_id": 18
    }
}'
 ```

Пример ответа:
```json
{
    "success": true,
    "data": {
        "entity_id": 10,
        "entity_type": "organization",
        "type": "entity-sections",
        "section_id": 18,
        "published": 1,
        "title": "Об университете",
        "sort": 500,
        "json": {
            "top": {
                "data": [
                    {
                        "description": {
                            "name": "Значение",
                            "type": "text",
                            "value": "Международные стандарты обучения"
                        }
                    },
                    {
                        "description": {
                            "name": "Значение",
                            "type": "text",
                            "value": "Практическая направленность"
                        }
                    },
                    {
                        "description": {
                            "name": "Значение",
                            "type": "text",
                            "value": "Государственный диплом"
                        }
                    },
                    {
                        "description": {
                            "name": "Значение",
                            "type": "text",
                            "value": "Доверие работодателей"
                        }
                    },
                    {
                        "description": {
                            "name": "Значение",
                            "type": "text",
                            "value": "Помощь в трудоустройстве"
                        }
                    },
                    {
                        "description": {
                            "name": "Значение",
                            "type": "text",
                            "value": "Ориентация на подготовку кадров в сфере потребительского рынка и услуг для города Москвы"
                        }
                    }
                ],
                "name": "Элементы сверху (с галочками)",
                "type": "list"
            },
            "bottom": {
                "data": [
                    {
                        "title": {
                            "name": "Заголовок",
                            "type": "text",
                            "value": "ТОП-100"
                        },
                        "description": {
                            "name": "Описание",
                            "type": "text",
                            "value": "лучших ВУЗов России"
                        }
                    },
                    {
                        "title": {
                            "name": "Заголовок",
                            "type": "text",
                            "value": "5"
                        },
                        "description": {
                            "name": "Описание",
                            "type": "text",
                            "value": "программ бакалавриата"
                        }
                    },
                    {
                        "title": {
                            "name": "Заголовок",
                            "type": "text",
                            "value": "от 4 лет"
                        },
                        "description": {
                            "name": "Описание",
                            "type": "text",
                            "value": "срок обучения"
                        }
                    }
                ],
                "name": "Элементы",
                "type": "list"
            },
            "bottom_title": {
                "name": "Заголовок нижнего блока",
                "type": "text",
                "value": "Об академии в цифрах"
            }
        },
        "created_at": null,
        "updated_at": null
    }
}
```

##  <a name="method_menu_main"></a> Метод получения главного меню по фильтру: menu/main
Адрес: https://mp.synergy.ru/api/v1/menu/main  
Тип: POST  
Формат входных данных: JSON<br>

Входных параметров нет

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/menu/main' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/vnd.api+json' \
--data-raw ''
 ```

Пример ответа

```json
{
  "data": [
    {
      "id": 1,
      "anchor": "Колледж",
      "link": "/catalog/level/2",
      "sub_items": [
        {
          "id": 6,
          "anchor": "Продажи",
          "link": "/catalog/level/2/direction/6",
          "products": [
            {
              "id": 481,
              "anchor": "Предпринимательство",
              "link": "/product/predprinimatelstvo"
            },
            {
              "id": 597,
              "anchor": "Электронная коммерция",
              "link": "/product/elektronnaya-kommerciya"
            }
          ]
        },
        {
          "id": 8,
          "anchor": "Бизнес",
          "link": "/catalog/level/2/direction/8",
          "products": [
            {
              "id": 481,
              "anchor": "Предпринимательство",
              "link": "/product/predprinimatelstvo"
            },
            {
              "id": 494,
              "anchor": "Банковское дело",
              "link": "/product/bankovskoe-delo"
            }
          ]
        }
      ]
    }
  ]
}
```

## <a name="method_quizzes_list"></a> Метод получения квизов по фильтру: quizzes/list
Адрес: https://mp.synergy.ru/api/v1/quizzes/list  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип  | Обязательное | Пример | Комментарий
| ------------- | ---- | ------------ | ------ | ----------- |
| published     | bool | -            | true   | Опубликован |


Пример запроса:
```bash
curl --location --request POST 'http://localhost:8003/api/v1/quizzes/list' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "include": ["questions","questions.answers"],
    "filter": {
        "published": true
    },
    "sort": "id"
}'
 ```
Пример ответа:
```json
{
    "data": [
        {
            "id": 1,
            "type": "quizzes",
            "lead_id": 1,
            "name": "Подбор программы обучения",
            "description": "Квиз для подбора программы обучения",
            "page": 2,
            "title": "Образовательный <br> маркетплейс",
            "text": "Ответьте на 6 вопросов <br> и мы подберём Вам нужную программу",
            "button": "Подобрать программу",
            "published": 1,
            "background_image": "uploads/quizzes/background/M3ntd8Elk7hki8alXeMxVO1LZyws7Q1qejK5jIjf.jpg",
            "person_image": "uploads/quizzes/person/qVPU3zCsEaSU9p9MGw6hFNBu2HUnwZ2hKjnY7htL.png",
            "questions": [
                {
                    "id": 1,
                    "type": "questions",
                    "question": "К каким профессиям вы больше склонны?",
                    "published": 1,
                    "answers": [
                        {
                            "id": 1,
                            "type": "answers",
                            "question_id": 1,
                            "answer": "Гуманитарные",
                            "next_question_id": 1
                        },
                        {
                            "id": 2,
                            "type": "answers",
                            "question_id": 1,
                            "answer": "Технические",
                            "next_question_id": 1
                        }
                    ]
                },
                {
                    "id": 2,
                    "type": "questions",
                    "question": "Какое направление обучения вас интересует?",
                    "published": 1,
                    "answers": [
                        {
                            "id": 4,
                            "type": "answers",
                            "question_id": 2,
                            "answer": "Колледж",
                            "next_question_id": 1
                        },
                        {
                            "id": 5,
                            "type": "answers",
                            "question_id": 2,
                            "answer": "Бакалавриат",
                            "next_question_id": 1
                        }
                    ]
                }
            ]
        }
    ],
    "count": 2,
    "success": true
}
 ```

## <a name="method_quizzes_detail"></a> Метод получения конкретного квиза по фильтру: quizzes/detail
Адрес: https://mp.synergy.ru/api/v1/quizzes/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип | Обязательное | Пример | Комментарий
| ------------- | --- | ------------ | ------ | ------------- |
| id            | id  | -            | 1      | Идентификатор |

Пример запроса:
```bash
curl --location --request POST 'http://localhost:8003/api/v1/quizzes/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "id": 1
    },
    "include": ["questions", "questions.answers"]
}'
 ```
Пример ответа:
```json
{
    "data": {
        "id": 1,
        "type": "quizzes",
        "lead_id": 1,
        "name": "Подбор программы обучения",
        "description": "Квиз для подбора программы обучения",
        "page": 2,
        "title": "Образовательный <br> маркетплейс",
        "text": "Ответьте на 6 вопросов <br> и мы подберём Вам нужную программу",
        "button": "Подобрать программу",
        "published": 1,
        "background_image": "uploads/quizzes/background/M3ntd8Elk7hki8alXeMxVO1LZyws7Q1qejK5jIjf.jpg",
        "person_image": "uploads/quizzes/person/qVPU3zCsEaSU9p9MGw6hFNBu2HUnwZ2hKjnY7htL.png",
        "questions": [
            {
                "id": 1,
                "type": "questions",
                "question": "К каким профессиям вы больше склонны?",
                "published": 1,
                "answers": [
                    {
                        "id": 1,
                        "type": "answers",
                        "question_id": 1,
                        "answer": "Гуманитарные",
                        "next_question_id": 1
                    },
                    {
                        "id": 2,
                        "type": "answers",
                        "question_id": 1,
                        "answer": "Технические",
                        "next_question_id": 1
                    }
                ]
            },
            {
                "id": 2,
                "type": "questions",
                "question": "Какое направление обучения вас интересует?",
                "published": 1,
                "answers": [
                    {
                        "id": 4,
                        "type": "answers",
                        "question_id": 2,
                        "answer": "Колледж",
                        "next_question_id": 1
                    },
                    {
                        "id": 5,
                        "type": "answers",
                        "question_id": 2,
                        "answer": "Бакалавриат",
                        "next_question_id": 1
                    }
                ]
            }
        ]
    },
    "success": true,
    "log_request_id": ""
}
 ```

## <a name="method_pages_sections_detail"></a>  Метод получения конкретной секции страницы по фильтру: entities/sections/detail
Адрес: https://mp.synergy.ru/api/v1/entities/sections/detail  
Тип: POST  
Формат входных данных: JSON<br>

Входные параметры для фильтра

| Название поля | Тип     | Обязательное | Пример | Комментарий
| ------------- | ------- | ------------ | ------ | ------------- |
| entity_id     | integer | -            | 1      | Идентификатор |
| entity_type   | string  | -            | "page" | Идентификатор |
| section_id    | integer | -            | 10     | Идентификатор |

Пример запроса:
```bash
curl --location --request POST 'https://mp.synergy.ru/api/v1/entities/sections/detail' \
--header 'Accept: application/vnd.api+json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "filter": {
        "section_id": 10,
        "entity_id": 1,
        "entity_type": "page",
    }
}'
 ```

Пример ответа:
```json
{
    "success": true,
    "data": {
        "entity_id": 1,
        "entity_type": "page",
        "section_id": 10,
        "published": 1,
        "title": "Название секции",
        "sort": 500,
        "json": "{\"items\": {\"data\": [{\"title\": {\"name\": \"Название\", \"type\": \"text\", \"value\": \"Название элемента\"}}], \"name\": \"Элементы\", \"type\": \"list\"}}",
        "created_at": null,
        "updated_at": null
    }
}
```



## <a name="method_app_site"></a>  Метод получения глобальной информации о сайте: app/site
Адрес: https://mp.synergy.ru/api/v1/app/site
Тип: POST  
Формат входных данных: JSON<br>

Пример запроса:
```bash
curl --location --request POST 'http://mp-api.tagiev.site/api/v1/app/site' \
--header 'Content-Type: application/json' \
--header 'Accept: application/vnd.api+json' \
--data-raw ''
 ```

Пример ответа:
```json
{
    "success": true,
    "data": {
        "main": {
            "logo": "https://dev.sys3.ru/marketplace/uploads/logo.jpeg"
        },
        "contacts": {
            "phones": [
                "+7 495 800-10-01",
                "8 800 100-00-11"
            ],
            "social_networks": [
                {
                    "name": "vk",
                    "icon": "https://sys3.ru/marketplace/uploads/social_network/icons/EhsMb1zQKhfwnRtN0cjujs1EaHaBdrytYP7rrMDw.svg",
                    "link": "https://vk.com/synergyuniversity"
                },
                {
                    "name": "facebook",
                    "icon": "https://sys3.ru/marketplace/uploads/social_network/icons/bL2uLI0TahcNfPOAtt5a6r21xrhMvp2Q6KfsKL2u.svg",
                    "link": "https://www.facebook.com/synergyunivers"
                },
                {
                    "name": "instagram",
                    "icon": "https://sys3.ru/marketplace/uploads/social_network/icons/8jLa8zAjHl0sPj5zrJT9aDc7uneNsYRA7ooAENYr.svg",
                    "link": "https://www.instagram.com/synergyuniversity/"
                },
                {
                    "name": "youtube",
                    "icon": "https://sys3.ru/marketplace/uploads/social_network/icons/XbMDWL8X76oCVd85uAY2ka2YFKaK6STQIYzhMBRD.svg",
                    "link": "https://www.youtube.com/user/synergytvru"
                }
            ]
        },
        "copyright": "© 2021 Synergy. Все права защищены",
        "privacy_policy": {
            "link": "https://synergy.ru/lp/_chunk/privacy.php?lang=ru",
            "text": ""
        }
    }
}
```
