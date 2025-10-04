<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menu untuk Admin
    |--------------------------------------------------------------------------
    */
    'admin' => [
        [
            'label'  => 'Dashboard',
            'route'  => 'admin.dashboard',
            'active' => ['admin.dashboard'],
            'icon'   => 'fas fa-tachometer-alt',
            'roles'  => ['Admin'],
        ],
        [
            'label'  => 'Blog',
            'route'  => 'admin.blog',
            'active' => ['admin.blog*'],
            'icon'   => 'fas fa-blog',
            'roles'  => ['Admin'],
        ],
        [
            'label'  => 'Manajemen User',
            // 'route'  => 'users.index',
            // 'active' => ['users.index', 'users.create', 'users.edit'],
            'icon'   => 'fas fa-users-cog',
            'roles'  => ['Admin'],
        ],
        [
            'label'  => 'Pengaturan Sistem',
            // 'route'  => 'settings.index',
            // 'active' => ['settings.index'],
            'icon'   => 'fas fa-cogs',
            'roles'  => ['Admin'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu untuk Author
    |--------------------------------------------------------------------------
    */
    'author' => [
        [
            'label'  => 'Dashboard',
            // 'route'  => 'dashboard',
            // 'active' => ['dashboard'],
            'icon'   => 'fas fa-tachometer-alt',
            'roles'  => ['Author'],
        ],
        [
            'label'  => 'Artikel Saya',
            // 'route'  => 'posts.index',
            // 'active' => ['posts.index', 'posts.create', 'posts.edit'],
            'icon'   => 'fas fa-newspaper',
            'roles'  => ['Author'],
        ],
        [
            'label'  => 'Tambah Artikel',
            // 'route'  => 'posts.create',
            // 'active' => ['posts.create'],
            'icon'   => 'fas fa-plus-circle',
            'roles'  => ['Author'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu untuk Contributor
    |--------------------------------------------------------------------------
    */
    'contributor' => [
        [
            'label'  => 'Dashboard',
            'route'  => 'dashboard',
            'active' => ['dashboard'],
            'icon'   => 'fas fa-tachometer-alt',
            'roles'  => ['Contributor'],
        ],
        [
            'label'  => 'Tulis Artikel',
            // 'route'  => 'posts.create',
            // 'active' => ['posts.create'],
            'icon'   => 'fas fa-pen',
            'roles'  => ['Contributor'],
        ],
        [
            'label'  => 'Artikel Saya',
            // 'route'  => 'posts.index',
            // 'active' => ['posts.index'],
            'icon'   => 'fas fa-copy',
            'roles'  => ['Contributor'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu untuk User (Reader / Member)
    |--------------------------------------------------------------------------
    */
    'user' => [
        [
            'label'  => 'Dashboard',
            'route'  => 'dashboard',
            'active' => ['dashboard'],
            'icon'   => 'fas fa-tachometer-alt',
            'roles'  => ['User'],
        ],
        [
            'label'  => 'Profil Saya',
            // 'route'  => 'profile.index',
            // 'active' => ['profile.index', 'profile.edit'],
            'icon'   => 'fas fa-user',
            'roles'  => ['User'],
        ],
        [
            'label'  => 'Artikel',
            // 'route'  => 'posts.public',
            // 'active' => ['posts.public', 'posts.show'],
            'icon'   => 'fas fa-book-open',
            'roles'  => ['User'],
        ],
    ],

];
