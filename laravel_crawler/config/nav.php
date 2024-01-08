<?php

return [
    'crawler' => [
        'nav' => [
            [
                'name' => 'Danh mục',
                'route' => 'get_crawler.category.index'
            ]
        ]
    ],
    'admin' => [
        'nav' => [
//            [
//                'name' => 'Danh mục',
//                'route' => 'get_admin.category.index'
//            ],
            [
                'name' => 'Menu',
                'route' => 'get_admin.menu.index'
            ],
            [
                'name' => 'Tag',
                'route' => 'get_admin.tag.index'
            ],
            [
                'name' => 'Bài viết',
                'route' => 'get_admin.article.index'
            ],
        ]
    ]
];
