<?php


return [

    [
        'title' => 'Dashboard',
        'gate' => 'dashboard',
        'route' => 'dashboard',
        'is_active' => 'dashboard',
        'description' => 'Yönetim Paneli',
        'icon' => 'fas fa-fire',
        'permissions' => [
            'show' => 'Show',
            'read' => 'Read',
        ],
    ],
    [
        'title' => 'Kullanıcılar',
        'gate' => 'users',
        'route' => 'users.index',
        'is_active' => 'users*',
        'description' => 'Kullanıcı Listesi',
        'icon' => 'fas fa-users',
        'permissions' => [
            'show' => 'Show',
            'read' => 'Read',
            'create' => 'Create',
            'store' => 'Store',
            'edit' => 'Edit',
            'update' => 'Update',
            'delete' => 'Delete'
        ],
    ],
    [
        'title' => 'Roller ve Yetkiler',
        'gate' => 'roles',
        'route' => 'roles.index',
        'is_active' => 'roles*',
        'description' => 'Kullanıcı Rolleri',
        'icon' => 'fas fa-lock',
        'permissions' => [
            'show' => 'Show',
            'read' => 'Read',
            'create' => 'Create',
            'store' => 'Store',
            'edit' => 'Edit',
            'update' => 'Update',
            'delete' => 'Delete'
        ],
    ],
    [
        'title' => 'Kullanıcı Aktiviteleri',
        'gate' => 'activities',
        'route' => 'activities.index',
        'is_active' => 'activities*',
        'description' => 'User Activity Logs',
        'icon' => 'fas fa-medal',
        'permissions' => [
            'show' => 'Show',
            'read' => 'Read',
            'delete' => 'Delete'
        ],
    ],
    [
        'title' => 'Etkinlik Geçmişi',
        'gate' => 'logs',
        'route' => 'logs.index',
        'is_active' => 'logs*',
        'description' => 'Event Activities',
        'icon' => 'fas fa-tachometer-alt',
        'permissions' => [
            'show' => 'Show',
            'read' => 'Read',
            'delete' => 'Delete'
        ],
    ]

];
