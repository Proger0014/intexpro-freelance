<?php

return [
    /**
     * Иерархия ролей
     * 
     * Чеи выше, тем важнее
     */
    'roles' => [ 
        'admin' => 'admin',
        'customer' => 'customer',
        'executor' => 'executor'
    ],

    'common-permissions' => [ 
        'create' => 'create',
        'read' => 'read',
        'update' => 'update',
        'delete' => 'delete',

        config('rbac-config.common-permissions')['create'] . '.self' => config('rbac-config.common-permissions')['create'] . '.self',
        config('rbac-config.common-permissions')['read'] . '.self' => config('rbac-config.common-permissions')['read'] . '.self',
        config('rbac-config.common-permissions')['update'] . '.self' => config('rbac-config.common-permissions')['update'] . '.self',
        config('rbac-config.common-permissions')['delete'] . '.self' => config('rbac-config.common-permissions')['delete'] . '.self',

    ],

    'tables-permissions' => [

        'users' => [
            config('rbac-config.common-permissions')['create'] => config('rbac-config.common-permissions')['create'],
            config('rbac-config.common-permissions')['read'] => config('rbac-config.common-permissions')['read'],
            config('rbac-config.common-permissions')['update'] => config('rbac-config.common-permissions')['update'],
            config('rbac-config.common-permissions')['delete'] => config('rbac-config.common-permissions')['delete'],
            config('rbac-config.common-permissions')['read.self'] => config('rbac-config.common-permissions')['read.self'],
            config('rbac-config.common-permissions')['update.self'] => config('rbac-config.common-permissions')['update.self'],
            config('rbac-config.common-permissions')['delete.self'] => config('rbac-config.common-permissions')['delete.self'],
        ],

        'roles' => [
            config('rbac-config.common-permissions')['create'] => config('rbac-config.common-permissions')['create'],
            config('rbac-config.common-permissions')['read'] => config('rbac-config.common-permissions')['read'],
            config('rbac-config.common-permissions')['update'] => config('rbac-config.common-permissions')['update'],
            config('rbac-config.common-permissions')['delete'] => config('rbac-config.common-permissions')['delete'],

            'assign-user' => 'assign-user',
            'discharge-user' => 'discharge-user'
        ],
    ],

    
    'roles-permissions' => [
        config('rbac-config.roles')['executor'] => [
            'users' => [
                config('rbac-config.tables-permissions')['users']['read'],
                config('rbac-config.tables-permissions')['users']['update.self'],
            ],

            'roles' => [
                config('rbac-config.tables-permissions')['roles']['read'],
            ]
        ],

        config('rbac-config.roles')['customer'] => [

            'users' => [
                config('rbac-config.tables-permissions')['users']['create'],
                config('rbac-config.tables-permissions')['users']['update'],
            ],

            'roles' => [
                config('rbac-config.tables-permissions')['roles']['assign-user'],
                config('rbac-config.tables-permissions')['roles']['discharge-user'],
            ]
        ]
    ],

    /**
     * Определить некоторым разрешениям их scope, то есть, 
     * на какие роли будет воздействовать разрешение для другой роли
     * 
     * Например, customer сможет создавать юзеров, но только с ролью executor
     * 
     * или, customer сможет создавать заказы, но только для себя: create.self
     * 
     * По дефолту, для всех доступных ролей, который ниже по званию, кроме read, read доступен для всех уровней
     * 
     * Если значение массива пустое, то будут применяться дефолтное значение
     */
    'permissions-role-scope' => [
        config('rbac-config.roles')['executor'] => [ ],
        config('rbac-config.roles')['customer'] => [
            'roles' => [
                // заказчик сможет создавать пользователей с ролью executor, если не писать roles, то будет тоже самое
                config('rbac-config.tables-permissions')['roles']['assign-user'] => [
                    config('rbac-config.roles')['executor']
                ],

                config('rbac-config.tables-permissions')['roles']['discharge-user'] => [
                    config('rbac-config.roles')['executor']
                ]
            ]
        ],
    ],

];