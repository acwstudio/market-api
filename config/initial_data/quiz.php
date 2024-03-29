<?php

return [
    'quizzes' => [
        [
            'name' => 'Подбор программы обучения',
            'description' => 'Квиз для подбора программы обучения',
            'page' => \App\Models\Quiz::PAGES['homepage'],
            'title' => 'Образовательный <br> маркетплейс',
            'text' => 'Ответьте на 6 вопросов <br> и мы подберём Вам нужную программу',
            'button' => 'Подобрать программу',
        ],
        [
            'name' => 'Подбор профессии',
            'description' => 'Квиз для подбора профессии',
            'page' => \App\Models\Quiz::PAGES['product'],
            'title' => 'Не знаете с чего начать? <br> Подберите профессию',
            'text' => 'Поможем определиться с выбором <br> и подберем подходящую программу обучения',
            'button' => 'Подобрать программу',
        ],
    ],
    'leads' => [
        [
            'name' => 'Подбор программы обучения',
            'description' => 'Лид после подбора программы обучения',
            'title' => 'Мы подобрали Вам программу обучения',
            'text' => 'Заполните форму, чтобы узнать больше о программе и наших предложениях',
        ]

    ],
    'questions' => [
        ['К каким профессиям вы больше склонны?',
            [
                'Гуманитарные',
                'Технические',
                'Творческие'
            ]
        ],
        ['Какое направление обучения вас интересует?',
            [
                'Колледж',
                'Бакалавриат',
                'Магистратура',
                'Аспирантура',
                'Курсы',
                'Бизнес-образование',
            ]
        ],
        ['Какой формат обучения вам подходит?',
            [
                'Очно',
                'Заочно',
                'Онлайн',
                'По выходным дням',
            ]
        ],
        ['Вы из Москвы?',
            [
                'да', 'нет'
            ]
        ],
    ],

//    [
//        'name' => 'Подбор программы обучения',
//        'description' => 'Квиз для подбора программы обучения',
//        'page' => \App\Models\Quiz::PAGES['homepage'],
//        'title' => 'Образовательный <br> маркетплейс',
//        'text' => 'Ответьте на 6 вопросов <br> и мы подберём Вам нужную программу',
//        'button' => 'Подобрать программу',
//        'questions' => [
//            ['К каким профессиям вы больше склонны?', [
//                'Гуманитарные',
//                'Технические',
//                'Творческие'
//            ]],
//            ['Какое направление обучения вас интересует?', [
//                'Колледж',
//                'Бакалавриат',
//                'Магистратура',
//                'Аспирантура',
//                'Курсы',
//                'Бизнес-образование',
//            ]],
//            ['Какой формат обучения вам подходит?', [
//                'Очно',
//                'Заочно',
//                'Онлайн',
//                'По выходным дням',
//            ]],
//            ['Вы из Москвы?', [
//                'да', 'нет'
//            ]],
//        ],
//        'lead' => [
//            'name' => 'Подбор программы обучения',
//            'description' => 'Лид после подбора программы обучения',
//            'title' => 'Мы подобрали Вам программу обучения',
//            'text' => 'Заполните форму, чтобы узнать больше о программе и наших предложениях',
//        ]
//    ],
//    [
//        'name' => 'Подбор профессии',
//        'description' => 'Квиз для подбора профессии',
//        'page' => \App\Models\Quiz::PAGES['product'],
//        'title' => 'Не знаете с чего начать? Подберите профессию',
//        'text' => 'Поможем определиться с выбором и подберем подходящую программу обучения',
//        'button' => 'Подобрать программу',
//        'questions' => [
//            ['К каким профессиям вы больше склонны?', [
//                'Гуманитарные',
//                'Технические',
//                'Творческие'
//            ]],
//            ['Какое направление обучения вас интересует?', [
//                'Колледж',
//                'Бакалавриат',
//                'Магистратура',
//                'Аспирантура',
//                'Курсы',
//                'Бизнес-образование',
//            ]],
//            ['Какой формат обучения вам подходит?', [
//                'Очно',
//                'Заочно',
//                'Онлайн',
//                'По выходным дням',
//            ]],
//            ['Вы из Москвы?', [
//                'да', 'нет'
//            ]],
//        ],
//        'lead' => [
//            'name' => 'Подбор программы обучения',
//            'description' => 'Лид после подбора профессии',
//            'title' => 'Мы подобрали Вам программу обучения',
//            'text' => 'Заполните форму, чтобы узнать больше о программе и наших предложениях',
//        ]
//    ]

];
