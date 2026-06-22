<?php

$crudActions = [
    'view' => 'View',
    'create' => 'Create',
    'edit' => 'Edit',
    'delete' => 'Delete',
];

return [
    'actions' => $crudActions,

    'legacy_permissions' => [
        'manage-users' => [
            'name' => 'Manage Users',
            'description' => 'Legacy full access to dashboard users.',
        ],
        'manage-roles' => [
            'name' => 'Manage Roles',
            'description' => 'Legacy full access to dashboard roles.',
        ],
        'manage-privileges' => [
            'name' => 'Manage Privileges',
            'description' => 'Legacy full access to dashboard privileges.',
        ],
        'manage-system-settings' => [
            'name' => 'Manage System Settings',
            'description' => 'Legacy full access to system settings.',
        ],
        'manage-home-page' => [
            'name' => 'Manage Home Page',
            'description' => 'Legacy full access to home page management.',
        ],
        'manage-about-page' => [
            'name' => 'Manage About Page',
            'description' => 'Legacy full access to all about page sections.',
        ],
        'manage-tools-page' => [
            'name' => 'Manage Tools Page',
            'description' => 'Legacy full access to tools management.',
        ],
        'manage-library' => [
            'name' => 'Manage Library',
            'description' => 'Legacy full access to library content.',
        ],
        'manage-blog' => [
            'name' => 'Manage Blog',
            'description' => 'Legacy full access to blog content.',
        ],
        'manage-invitations' => [
            'name' => 'Manage Invitations',
            'description' => 'Legacy full access to invitation management.',
        ],
        'view-audit-logs' => [
            'name' => 'View Audit Logs',
            'description' => 'Legacy full access to audit logs.',
        ],
        'manage-adminplan' => [
            'name' => 'Manage Admin Plan',
            'description' => 'Legacy full access to the admin plan page.',
        ],
    ],

    'groups' => [
        'users' => [
            'name' => 'Users',
            'description' => 'User accounts, status, impersonation, and profile controls.',
            'legacy' => ['manage-users'],
            'actions' => $crudActions,
        ],
        'roles' => [
            'name' => 'Roles',
            'description' => 'Role creation and privilege assignment.',
            'legacy' => ['manage-roles'],
            'actions' => $crudActions,
        ],
        'privileges' => [
            'name' => 'Privileges',
            'description' => 'Privilege catalog management.',
            'legacy' => ['manage-privileges'],
            'actions' => $crudActions,
        ],
        'system-settings' => [
            'name' => 'System Settings',
            'description' => 'Global site settings and dashboard branding.',
            'legacy' => ['manage-system-settings'],
            'actions' => [
                'view' => 'View',
                'edit' => 'Edit',
            ],
        ],
        'home' => [
            'name' => 'Home Page',
            'description' => 'Home page hero text and video slider.',
            'legacy' => ['manage-home-page'],
            'actions' => $crudActions,
        ],
        'about.hero' => [
            'name' => 'About: Hero',
            'description' => 'Hero text, hero image, and hero metrics.',
            'legacy' => ['manage-about-page'],
            'actions' => $crudActions,
        ],
        'about.mission' => [
            'name' => 'About: Our Mission',
            'description' => 'Mission title, description, and mission cards.',
            'legacy' => ['manage-about-page'],
            'actions' => $crudActions,
        ],
        'about.creator' => [
            'name' => 'About: The Creator',
            'description' => 'Creator copy and creator image.',
            'legacy' => ['manage-about-page'],
            'actions' => [
                'view' => 'View',
                'edit' => 'Edit',
            ],
        ],
        'about.credentials' => [
            'name' => 'About: Credentials',
            'description' => 'Credentials copy, checklist rows, and process cards.',
            'legacy' => ['manage-about-page'],
            'actions' => $crudActions,
        ],
        'about.social' => [
            'name' => 'About: Social Media',
            'description' => 'Social heading and social platform links.',
            'legacy' => ['manage-about-page'],
            'actions' => $crudActions,
        ],
        'about.journey' => [
            'name' => 'About: Our Journey',
            'description' => 'Journey copy, CTA, quote, and timeline.',
            'legacy' => ['manage-about-page'],
            'actions' => $crudActions,
        ],
        'tools' => [
            'name' => 'Tools',
            'description' => 'Tools page, tool sections, and tool items.',
            'legacy' => ['manage-tools-page'],
            'actions' => $crudActions,
        ],
        'library' => [
            'name' => 'Library',
            'description' => 'Library videos, articles, and resources.',
            'legacy' => ['manage-library'],
            'actions' => $crudActions,
        ],
        'blog' => [
            'name' => 'Blog',
            'description' => 'Blog posts and blog categories.',
            'legacy' => ['manage-blog'],
            'actions' => $crudActions,
        ],
        'invitations' => [
            'name' => 'Invitations',
            'description' => 'Invitation links and referrals.',
            'legacy' => ['manage-invitations'],
            'actions' => $crudActions,
        ],
        'audits' => [
            'name' => 'Audit Logs',
            'description' => 'Audit log visibility, exports, and cleanup.',
            'legacy' => ['view-audit-logs'],
            'actions' => [
                'view' => 'View',
                'delete' => 'Delete',
            ],
        ],
        'adminplan' => [
            'name' => 'Admin Plan',
            'description' => 'Admin plan page.',
            'legacy' => ['manage-adminplan'],
            'actions' => [
                'view' => 'View',
            ],
        ],
    ],

    'route_groups' => [
        'tyro-dashboard.users.*' => 'users',
        'tyro-dashboard.roles.*' => 'roles',
        'tyro-dashboard.privileges.*' => 'privileges',
        'tyro-dashboard.invitations.admin.*' => 'invitations',
        'tyro-dashboard.audits.*' => 'audits',
        'dashboard.system-settings*' => 'system-settings',
        'dashboard.home-page.*' => 'home',
        'dashboard.home-management.*' => 'home',
        'dashboard.tools-page.*' => 'tools',
        'dashboard.adminplan' => 'adminplan',
    ],

    'resources' => [
        'tool-sections' => 'tools',
        'tool-items' => 'tools',
        'library-items' => 'library',
        'blog-posts' => 'blog',
        'blog-categories' => 'blog',
    ],

    'about_sections' => [
        'about-hero' => 'about.hero',
        'our-mission' => 'about.mission',
        'the-creator' => 'about.creator',
        'credentials-approach' => 'about.credentials',
        'social-media' => 'about.social',
        'our-journey' => 'about.journey',
    ],

    'about_item_routes' => [
        'dashboard.about-page.metrics.*' => 'about.hero',
        'dashboard.about-page.mission-items.*' => 'about.mission',
        'dashboard.about-page.approach-items.*' => 'about.credentials',
        'dashboard.about-page.social-links.*' => 'about.social',
        'dashboard.about-page.journey-items.*' => 'about.journey',
    ],

    'sidebar_groups' => [
        'users',
        'roles',
        'privileges',
        'system-settings',
        'home',
        'about.hero',
        'about.mission',
        'about.creator',
        'about.credentials',
        'about.social',
        'about.journey',
        'tools',
        'library',
        'blog',
        'invitations',
        'audits',
        'adminplan',
    ],
];
