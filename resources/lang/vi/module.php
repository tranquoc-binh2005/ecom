<?php

return [
  [
      'name' => 'Trang chủ',
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
      'name' => 'Người dùng',
      'icon' => 'la la-user',
      'subModule' => [
          [
              'name' => 'Quản lý vai trò',
              'route' => 'role.index',
          ],
          [
              'name' => 'Quản lý người dùng',
              'route' => 'user.index',
          ],
          [
              'name' => 'Phân quyền',
              'route' => 'role.index',
          ]
      ]
  ],
  [
      'name' => 'Sản phẩm',
      'icon' => 'la la-cube',
      'subModule' => [
          [
              'name' => 'Danh mục',
              'route' => 'role.index',
          ],
          [
              'name' => 'Sản phẩm',
              'route' => 'role.index',
          ]
      ]
  ],
  [
      'name' => 'Bài viết',
      'icon' => 'la la-pencil-square',
      'subModule' => [
          [
              'name' => 'Danh mục',
              'route' => 'role.index',
          ],
          [
              'name' => 'Bài đăng',
              'route' => 'role.index',
          ]
      ]
  ]
];
