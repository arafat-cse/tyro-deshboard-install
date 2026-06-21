<?php

return [
    'permissions' => [
        'manage-users' => [
            'name' => 'Manage Users',
            'description' => 'Create, edit, suspend, impersonate, and delete dashboard users.',
        ],
        'manage-roles' => [
            'name' => 'Manage Roles',
            'description' => 'Create, edit, and assign roles.',
        ],
        'manage-privileges' => [
            'name' => 'Manage Privileges',
            'description' => 'Create, edit, and attach privileges to roles.',
        ],
        'manage-system-settings' => [
            'name' => 'Manage System Settings',
            'description' => 'Update global site and branding settings.',
        ],
        'manage-home-page' => [
            'name' => 'Manage Home Page',
            'description' => 'Update home page hero content and video slides.',
        ],
        'manage-about-page' => [
            'name' => 'Manage About Page',
            'description' => 'Update about page content, metrics, and sections.',
        ],
        'manage-tools-page' => [
            'name' => 'Manage Tools Page',
            'description' => 'Update tools page content, sections, and tool items.',
        ],
        'manage-library' => [
            'name' => 'Manage Library',
            'description' => 'Create and update library content.',
        ],
        'manage-blog' => [
            'name' => 'Manage Blog',
            'description' => 'Create and update blog posts and categories.',
        ],
        'manage-invitations' => [
            'name' => 'Manage Invitations',
            'description' => 'Manage invitation links and referrals.',
        ],
        'view-audit-logs' => [
            'name' => 'View Audit Logs',
            'description' => 'View, export, and maintain audit logs.',
        ],
        'manage-adminplan' => [
            'name' => 'Manage Admin Plan',
            'description' => 'View and update the admin plan page.',
        ],
    ],

    'routes' => [
        'tyro-dashboard.users.*' => 'manage-users',
        'tyro-dashboard.roles.*' => 'manage-roles',
        'tyro-dashboard.privileges.*' => 'manage-privileges',
        'tyro-dashboard.invitations.admin.*' => 'manage-invitations',
        'tyro-dashboard.audits.*' => 'view-audit-logs',
        'dashboard.system-settings*' => 'manage-system-settings',
        'dashboard.home-page.*' => 'manage-home-page',
        'dashboard.home-management.*' => 'manage-home-page',
        'dashboard.about-page.*' => 'manage-about-page',
        'dashboard.about-management.*' => 'manage-about-page',
        'dashboard.tools-page.*' => 'manage-tools-page',
        'dashboard.adminplan' => 'manage-adminplan',
    ],

    'resources' => [
        'tool-sections' => 'manage-tools-page',
        'tool-items' => 'manage-tools-page',
        'library-items' => 'manage-library',
        'blog-posts' => 'manage-blog',
        'blog-categories' => 'manage-blog',
    ],

    'sidebar_permissions' => [
        'manage-users',
        'manage-roles',
        'manage-privileges',
        'manage-system-settings',
        'manage-home-page',
        'manage-about-page',
        'manage-tools-page',
        'manage-library',
        'manage-blog',
        'manage-invitations',
        'view-audit-logs',
        'manage-adminplan',
    ],
];
