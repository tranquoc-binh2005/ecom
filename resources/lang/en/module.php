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
                'route' => 'role.index',
            ]
        ]
    ],
    [
        'name' => 'Manage Product',
        'icon' => 'la la-cube',
        'subModule' => [
            [
                'name' => 'Category Management',
                'route' => 'role.index',
            ],
            [
                'name' => 'Product Management',
                'route' => 'role.index',
            ]
        ]
    ],
    [
        'name' => 'Manage Post',
        'icon' => 'la la-pencil-square',
        'subModule' => [
            [
                'name' => 'Post Catalogue Management',
                'route' => 'role.index',
            ],
            [
                'name' => 'Post Management',
                'route' => 'role.index',
            ]
        ]
    ]
];
