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
        'super_admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'countries' => 'c,r,u,d',
            'cities' => 'c,r,u,d',
            'fields' => 'c,r,u,d',
            'taxes' => 'c,r,u,d',
            'unit-types' => 'c,r,u,d',
            'companies' => 'c,r,u,d',
            'purchase-orders' => 'r,u,d',
            'purchase-orders-demand-unit' => 'r,d',
            'purchase-orders-inquiries' => 'r,d',
            'purchase-orders-offers' => 'r,d',
            'purchase-orders-offers-units' => 'r,d',
            'packages' => 'c,r,u,d',
            'payments' => 'r,u',
            'subscriptions' => 'r,u',
            'loyalty-points' => 'r,u',
            'loyalty-points-settings' => 'r,u',
            'roles' => 'c,r,u,d',  // Roles && assign permission
            'managers' => 'c,r,u,d',
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
    'roles_translations' => [
        'super-admin' => [
            'en' => 'Super Admin',
            'ar' => 'مشرف عام'
        ],
        'admin' => [
            'en' => 'Admin',
            'ar' => 'مشرف'
        ],
    ]
];
