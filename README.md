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

## Описание ресурса Product

Чтобы не нарушать уже проделанную работу я для своего варианта создал контроллер _CourseController_ и отдельный для него
роутинг. Используется модель Product

Причины по которым я предлагаю свой вариант следующие

- На данный момент у нас нет сложной доменной логики, где имело бы смысл создавать DTO, когда данные проходят сложный 
алгоритм обработки с многочисленными передачами в разные части кода.
- Применение стандартных фич Laravel в настоящий момент более чем обоснованно. Это дает огромный выигрыш в скорости 
разработки и видна динамика прогресса, в короткие сроки предоставляются данные для работы фронтенда.
- По мере появления сложной логики есть такая штука как рефакторинг. Такой подход позволит реагировать на реальные 
требования усложненной логики, а не пытаться сейчас предугадать будущее

Работа с ресурсом осуществляется стандартным набором CRUD методов. Для этого создается апишный ресурсный контроллер с 
пятью методами:
- list (index)
- create
- show
- update
- delete

Метод **list** позволяет получать коллекцию записей из таблицы **products** и имеет следующие возможности, которые 
управляются параметрами запроса. Для этой функциональности используется сторонний пакет 
https://spatie.be/docs/laravel-query-builder/v3/introduction

Описание метода

Адрес: https://mp.synergy.ru/api/v1/courses  <br>
Тип: GET  <br>
Формат входных данных: строка с параметрами для GET запроса

- фильтрация по заданным полям (exact или like)
- сортировка по заданным полям (по возрастанию и по убыванию)
- управление выводом связанных сущностей
- добавление пагинации

**Фильтрация** 
```
/courses?filter[published]=true
/courses?filter[name]=John&filter[published]=true
/courses?filter[name]=John,Tom
```
**Сортировка**
```
/courses?sort=name
/courses?sort=created_at,name
```
**Включение связанных сущностей**
```
/courses?include=subjects,formats
```

**Вывод данных**

```
https://mp.synergy.ru/api/v1/courses?sort=-id&include=subjects,formats,levels,directions,sections,persons,organization
```

```json
{
    "id": 840,
    "type": "courses",
    "slug": "aktivnye-i-interaktivnye-metody-obucheniya",
    "attributes": {
        "is_moderated": 0,
        "land": null,
        "published": 0,
        "expiration": null,
        "name": "Активные и интерактивные методы обучения",
        "preview_image": null,
        "digital_image": null,
        "price": null,
        "start_day": null,
        "is_installment": 1,
        "installment_months": 2,
        "is_document": 1,
        "document": 2,
        "triggers": "1|5|6",
        "begin_duration": null,
        "duration": 1440,
        "duration_format_value": null,
        "description": "Формирование и развитие профессиональных компетенций педагогов в области применения активных и интерактивных методов во время обучения. Интерактивные методы часто трактуются как совокупность внедрения ИКТ, что в корне не верно. В основе интерактивной педагогики лежит взаимодействие учеников не только с педагогом во время занятия, но и друг с другом, организация групповой работы. Переход из роли транслятора опыта в роль организатора совместной деятельности учеников для многих педагогов даётся нелегко.",
        "organization_id": 9,
        "category_id": 4,
        "user_id": 12,
        "created_at": "2021-07-05T17:32:02.000000Z",
        "updated_at": "2021-07-05T17:39:22.000000Z"
    },
    "relationships": {
        "subjects": {
            "links": {
                "self": "",
                "related": ""
            },
            "data": [
                {
                    "id": 35,
                    "type": "subjects",
                    "slug": "pedagogicheskoe-obrazovanie"
                }
            ]
        },
        "formats": {
            "links": {
                "self": "",
                "related": ""
            },
            "data": [
                {
                    "id": 23,
                    "type": "formats",
                    "slug": "zaocnaya"
                },
                {
                    "id": 26,
                    "type": "formats",
                    "slug": "onlain"
                }
            ]
        },
        "levels": {
            "links": {
                "self": "",
                "related": ""
            },
            "data": [
                {
                    "id": 9,
                    "type": "levels",
                    "slug": "dopolnitelnoe-obrazovanie"
                }
            ]
        },
        "directions": {
            "links": {
                "self": "",
                "related": ""
            },
            "data": [
                {
                    "id": 12,
                    "type": "directions",
                    "slug": "pedagogika"
                }
            ]
        },
        "sections": {
            "links": {
                "self": "",
                "related": ""
            },
            "data": [
                {
                    "id": 8,
                    "type": "sections",
                    "slug": null
                },
                {
                    "id": 9,
                    "type": "sections",
                    "slug": null
                },
                {
                    "id": 10,
                    "type": "sections",
                    "slug": null
                },
                {
                    "id": 11,
                    "type": "sections",
                    "slug": null
                },
                {
                    "id": 12,
                    "type": "sections",
                    "slug": null
                }
            ]
        },
        "persons": {
            "links": {
                "self": "",
                "related": ""
            },
            "data": []
        },
        "organization": {
            "links": {
                "self": "",
                "related": ""
            },
            "data": {
                "id": 9,
                "type": "organizations",
                "slug": "universitet-sinergiya"
            }
        }
    }
}
```

Спецификация структуры json api документа взята отсюда https://jsonapi.org/

Метод **show** выводит одну запись по ее **id** и имеет возможность управления выводом связанных сущностей

Описание метода

Адрес: https://mp.synergy.ru/api/v1/courses/{id}  <br>
Тип: GET  <br>
Формат входных данных: строка с параметрами для GET запроса

**Включение связанных сущностей**
```
/courses/234?include=subjects,formats
```
Методы create и update потребуют еще ввода классов валидации данных, но это тоже стандартная фича Laravel.

Готов ответить за все мной написанное)))
