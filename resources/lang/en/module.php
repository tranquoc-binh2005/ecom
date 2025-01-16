<?php

return [
    [
        'name' => 'Dashboard',
        'icon' => 'la la-gear',
        'subModule' => [
            [
                'name' => 'Widget',
                'route' => 'role.index',
            ],
            [
                'name' => 'Slider',
                'route' => 'role.index',
            ]
        ]
    ],
    [
        'name' => 'Manage User',
        'icon' => 'la la-user',
        'subModule' => [
            [
                'name' => 'Role Management',
                'route' => 'role.index',
            ],
            [
                'name' => 'User Management',
                'route' => 'user.index',
            ],
            [
                'name' => 'Permission Management',
                'route' => 'permission.index',
            ]
        ]
    ],
    [
        'name' => 'Manage Product',
        'icon' => 'la la-cube',
        'subModule' => [
            [
                'name' => 'Category Management',
                'route' => 'product.catalogue.index',
            ],
            [
                'name' => 'Attribute Product Management',
                'route' => 'attribute.index',
            ],
            [
                'name' => 'Product Management',
                'route' => 'product.index',
            ]
        ]
    ],
    [
        'name' => 'Manage Post',
        'icon' => 'la la-pencil-square',
        'subModule' => [
            [
                'name' => 'Post Catalogue Management',
                'route' => 'post.catalogue.index',
            ],
            [
                'name' => 'Post Management',
                'route' => 'post.index',
            ]
        ]
    ]
];
