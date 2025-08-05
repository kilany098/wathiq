<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadmin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'operation' => [
            'module_1_name' => 'r,u',
        ],
        'inventory' => [
            'module_1_name' => 'r,u',
        ],
        'hr' => [
            'module_1_name' => 'r,u',
        ],
        'accountant' => [
            'module_1_name' => 'c,r,u,d',
        ],
        'technician' => [
            'module_1_name' => 'c,r,u,d',
        ],


    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
