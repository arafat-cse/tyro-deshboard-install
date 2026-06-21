<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\LibraryItem;
use App\Models\ToolItem;
use App\Models\ToolSection;

return [
    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the dashboard routes prefix and middleware.
    |
    */
    'routes' => [
        'prefix' => env('TYRO_DASHBOARD_PREFIX', 'dashboard'),
        'middleware' => ['web', 'auth'],
        'name_prefix' => 'tyro-dashboard.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Roles
    |--------------------------------------------------------------------------
    |
    | Users with these roles will have full access to admin features
    | (user management, role management, privilege management, settings).
    |
    */
    'admin_roles' => ['admin', 'super-admin'],

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | The user model to use throughout the dashboard.
    |
    */
    'user_model' => env('TYRO_DASHBOARD_USER_MODEL', 'App\\Models\\User'),

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Default pagination settings for lists.
    |
    */
    'pagination' => [
        'users' => 15,
        'roles' => 15,
        'privileges' => 15,
    ],

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    |
    | Customize the dashboard appearance.
    |
    */
    'branding' => [
        'app_name' => env('TYRO_DASHBOARD_APP_NAME', 'Life Decode'),
        'logo' => env('TYRO_DASHBOARD_LOGO', null),
        'logo_height' => env('TYRO_DASHBOARD_LOGO_HEIGHT', '32px'),
        'favicon' => env('TYRO_DASHBOARD_FAVICON', null),

        // Sidebar colors (supports any CSS color value: hex, rgb, hsl, etc.)
        'sidebar_bg' => env('TYRO_DASHBOARD_SIDEBAR_BG', null), // Custom background color for sidebar
        'sidebar_text' => env('TYRO_DASHBOARD_SIDEBAR_TEXT', null), // Custom text color for sidebar
        'sidebar_primary' => env('TYRO_DASHBOARD_SIDEBAR_PRIMARY', null), // Custom text color for sidebar
        'sidebar_accent' => env('TYRO_DASHBOARD_SIDEBAR_ACCENT', null), // Custom text color for sidebar
        'sidebar_accent_foreground' => env('TYRO_DASHBOARD_SIDEBAR_ACCENT_FOREGROUND', null), // Custom text color for sidebar
        'sidebar_header_border' => env('TYRO_DASHBOARD_SIDEBAR_HEADER_BORDER', null), // Custom text color for sidebar
        'sidebar_accordion_compact' => filter_var(env('TYRO_DASHBOARD_SIDEBAR_ACCORDION_COMPACT', false), FILTER_VALIDATE_BOOLEAN),
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Bar
    |--------------------------------------------------------------------------
    |
    | Configuration for the admin notice bar displayed at the top of the dashboard.
    |
    */
    'admin_bar' => [
        'enabled' => env('TYRO_DASHBOARD_ADMIN_BAR_ENABLED', false),
        'message' => env('TYRO_DASHBOARD_ADMIN_BAR_MESSAGE', ''),
        'bg_color' => env('TYRO_DASHBOARD_ADMIN_BAR_BG_COLOR', '#000000'),
        'text_color' => env('TYRO_DASHBOARD_ADMIN_BAR_TEXT_COLOR', '#ffffff'),
        'align' => env('TYRO_DASHBOARD_ADMIN_BAR_ALIGN', 'left'),
        'height' => env('TYRO_DASHBOARD_ADMIN_BAR_HEIGHT', '40px'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Collapsible Sidebar
    |--------------------------------------------------------------------------
    |
    | Enable or disable the collapsible sidebar feature.
    |
    */
    'collapsible_sidebar' => env('TYRO_DASHBOARD_COLLAPSIBLE_SIDEBAR', true),

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Enable or disable specific dashboard features.
    |
    */
    'features' => [
        'user_management' => true,
        'role_management' => true,
        'privilege_management' => true,
        'settings_management' => true,
        'profile_management' => true,
        'invitation_system' => env('TYRO_DASHBOARD_ENABLE_INVITATION', true),
        'audit_logs' => env('TYRO_DASHBOARD_ENABLE_AUDIT_LOGS', true),
        'activity_log' => false, // Future feature
        'profile_photo_upload' => env('TYRO_DASHBOARD_ENABLE_PROFILE_PHOTO', false),
        'gravatar' => env('TYRO_DASHBOARD_ENABLE_GRAVATAR', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Protected Resources
    |--------------------------------------------------------------------------
    |
    | Resources that cannot be deleted through the dashboard.
    |
    */
    'protected' => [
        'roles' => ['admin', 'super-admin', 'user'],
        'users' => [], // Add user IDs that cannot be deleted
    ],

    /*
    |--------------------------------------------------------------------------
    | Dashboard Widgets
    |--------------------------------------------------------------------------
    |
    | Configure which widgets appear on the dashboard home.
    |
    */
    'widgets' => [
        'stats' => true,
        'recent_users' => true,
        'role_distribution' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    |
    | Configure dashboard notifications behavior.
    |
    */
    'notifications' => [
        'show_flash_messages' => true,
        'auto_dismiss_seconds' => 5,
        'notification_style' => env('TYRO_DASHBOARD_NOTIFICATION_STYLE', 'legacy'), // 'legacy' or 'toast'
        'toast_position' => env('TYRO_DASHBOARD_TOAST_POSITION', 'bottom-right'), // 'top-right' or 'bottom-right'
    ],

    /*
    |--------------------------------------------------------------------------
    | File Upload Configuration
    |--------------------------------------------------------------------------
    |
    | Configure default settings for file uploads in resources.
    |
    */
    'uploads' => [
        'disk' => env('TYRO_DASHBOARD_UPLOAD_DISK', 'public'),
        'directory' => env('TYRO_DASHBOARD_UPLOAD_DIRECTORY', 'uploads'),
        'auto_delete_on_resource_delete' => env('TYRO_DASHBOARD_AUTO_DELETE_UPLOADS', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Profile Photo Configuration
    |--------------------------------------------------------------------------
    |
    | Configure settings for user profile photos and gravatar support.
    |
    */
    'profile_photo' => [
        'disk' => env('TYRO_DASHBOARD_PROFILE_PHOTO_DISK', 'public'),
        'directory' => env('TYRO_DASHBOARD_PROFILE_PHOTO_DIRECTORY', 'profile_images'),
        'max_size' => env('TYRO_DASHBOARD_PROFILE_PHOTO_MAX_SIZE', 10240), // in KB (default 10MB)
        'width' => env('TYRO_DASHBOARD_PROFILE_PHOTO_WIDTH', 400),
        'height' => env('TYRO_DASHBOARD_PROFILE_PHOTO_HEIGHT', 400),
        'quality' => env('TYRO_DASHBOARD_PROFILE_PHOTO_QUALITY', 90),
        'crop_position' => env('TYRO_DASHBOARD_PROFILE_PHOTO_CROP', 'center'), // top, center, bottom
        'allowed_types' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        'auto_delete_on_user_delete' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Dynamic Resources (CRUD)
    |--------------------------------------------------------------------------
    |
    | Define your resources here to automatically generate CRUD interfaces.
    |
    */
    // 'resources' => [
    //     // Example:
    //     // 'posts' => [
    //     //     'model' => 'App\Models\Post',
    //     //     'title' => 'Posts',
    //     //     'icon' => '<svg>...</svg>', // Optional SVG icon
    //     //     'fields' => [
    //     //         'title' => ['type' => 'text', 'label' => 'Title', 'rules' => 'required'],
    //     //         'content' => ['type' => 'textarea', 'label' => 'Content'],
    //     //     ],
    //     // ],
    // ],
    'resources' => [
        'tool-sections' => [
            'model' => ToolSection::class,
            'title' => 'Tool Sections',
            'title_singular' => 'Tool Section',
            'permission' => 'manage-tools-page',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h16" /></svg>',
            'fields' => [
                'tool_page_id' => [
                    'type' => 'select',
                    'label' => 'Tools Page',
                    'rules' => 'required|exists:tool_pages,id',
                    'relationship' => 'page',
                    'option_label' => 'eyebrow',
                    'hide_in_index' => true,
                ],
                'type' => [
                    'type' => 'select',
                    'label' => 'Section Type',
                    'rules' => 'required|in:hero_points,tool_cards,categories,toolkits,how_steps',
                    'options' => [
                        'hero_points' => 'Hero Points',
                        'tool_cards' => 'Popular Tool Cards',
                        'categories' => 'Categories',
                        'toolkits' => 'Toolkits',
                        'how_steps' => 'How Steps',
                    ],
                    'searchable' => true,
                    'sortable' => true,
                ],
                'title' => [
                    'type' => 'text',
                    'label' => 'Title',
                    'rules' => 'required|string|max:255',
                    'searchable' => true,
                    'sortable' => true,
                ],
                'button_text' => [
                    'type' => 'text',
                    'label' => 'Button Text',
                    'rules' => 'nullable|string|max:255',
                    'hide_in_index' => true,
                ],
                'button_url' => [
                    'type' => 'text',
                    'label' => 'Button URL',
                    'rules' => 'nullable|string|max:255',
                    'hide_in_index' => true,
                ],
                'sort_order' => [
                    'type' => 'number',
                    'label' => 'Sort Order',
                    'rules' => 'required|integer|min:0',
                    'default' => 0,
                    'sortable' => true,
                ],
                'is_published' => [
                    'type' => 'boolean',
                    'label' => 'Published',
                    'default' => true,
                    'sortable' => true,
                ],
            ],
        ],
        'tool-items' => [
            'model' => ToolItem::class,
            'title' => 'Tool Items',
            'title_singular' => 'Tool Item',
            'permission' => 'manage-tools-page',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5h14v14H5zM9 9h6M9 13h6M9 17h3" /></svg>',
            'upload_disk' => 'public',
            'upload_directory' => 'tool-items',
            'fields' => [
                'tool_section_id' => [
                    'type' => 'select',
                    'label' => 'Section',
                    'rules' => 'required|exists:tool_sections,id',
                    'relationship' => 'section',
                    'option_label' => 'title',
                    'filterable' => true,
                    'searchable' => true,
                    'sortable' => true,
                ],
                'title' => [
                    'type' => 'text',
                    'label' => 'Title',
                    'rules' => 'required|string|max:255',
                    'searchable' => true,
                    'sortable' => true,
                ],
                'description' => [
                    'type' => 'textarea',
                    'label' => 'Description',
                    'rules' => 'nullable|string',
                    'hide_in_index' => true,
                ],
                'image_path' => [
                    'type' => 'file',
                    'label' => 'Image',
                    'rules' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
                    'display_image' => true,
                    'display_image_position' => 'top',
                    'hide_in_index' => true,
                    'attributes' => [
                        'accept' => 'image/jpeg,image/png,image/webp,image/gif',
                    ],
                    'help_text' => 'Optional image for toolkit cards. Max 5MB.',
                ],
                'icon_text' => [
                    'type' => 'text',
                    'label' => 'Icon Text',
                    'rules' => 'nullable|string|max:10',
                    'sortable' => true,
                ],
                'style_class' => [
                    'type' => 'select',
                    'label' => 'Visual Style',
                    'rules' => 'nullable|in:,gold-bg,green-bg,purple-bg,pink-bg,green-img,purple-img',
                    'options' => [
                        '' => 'Default',
                        'gold-bg' => 'Gold Icon',
                        'green-bg' => 'Green Icon',
                        'purple-bg' => 'Purple Icon',
                        'pink-bg' => 'Pink Icon',
                        'green-img' => 'Green Toolkit Image',
                        'purple-img' => 'Purple Toolkit Image',
                    ],
                    'hide_in_index' => true,
                ],
                'meta_one' => [
                    'type' => 'text',
                    'label' => 'Meta One',
                    'rules' => 'nullable|string|max:255',
                    'hide_in_index' => true,
                ],
                'meta_two' => [
                    'type' => 'text',
                    'label' => 'Meta Two',
                    'rules' => 'nullable|string|max:255',
                    'hide_in_index' => true,
                ],
                'meta_three' => [
                    'type' => 'text',
                    'label' => 'Meta Three',
                    'rules' => 'nullable|string|max:255',
                    'hide_in_index' => true,
                ],
                'button_text' => [
                    'type' => 'text',
                    'label' => 'Button Text',
                    'rules' => 'nullable|string|max:255',
                    'hide_in_index' => true,
                ],
                'button_url' => [
                    'type' => 'text',
                    'label' => 'Button URL',
                    'rules' => 'nullable|string|max:255',
                    'hide_in_index' => true,
                ],
                'sort_order' => [
                    'type' => 'number',
                    'label' => 'Sort Order',
                    'rules' => 'required|integer|min:0',
                    'default' => 0,
                    'sortable' => true,
                ],
                'is_published' => [
                    'type' => 'boolean',
                    'label' => 'Published',
                    'default' => true,
                    'sortable' => true,
                ],
            ],
        ],
        'library-items' => [
            'model' => LibraryItem::class,
            'title' => 'Library Items',
            'title_singular' => 'Library Item',
            'permission' => 'manage-library',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20" /><path stroke-linecap="round" stroke-linejoin="round" d="M4 4.5A2.5 2.5 0 016.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15z" /></svg>',
            'upload_disk' => 'public',
            'upload_directory' => 'library',
            'fields' => [
                'type' => [
                    'type' => 'select',
                    'label' => 'Content Type',
                    'rules' => 'required|in:VIDEO,ARTICLE,RESOURCE',
                    'options' => [
                        'VIDEO' => 'Video',
                        'ARTICLE' => 'Article',
                        'RESOURCE' => 'Resource',
                    ],
                    'searchable' => true,
                    'sortable' => true,
                    'default' => 'VIDEO',
                ],
                'title' => [
                    'type' => 'text',
                    'label' => 'Title',
                    'rules' => 'required|string|max:255',
                    'searchable' => true,
                    'sortable' => true,
                ],
                'description' => [
                    'type' => 'textarea',
                    'label' => 'Short Description',
                    'rules' => 'nullable|string',
                    'hide_in_index' => true,
                ],
                'primary_topic' => [
                    'type' => 'text',
                    'label' => 'Primary Topic',
                    'rules' => 'required|string|max:255',
                    'searchable' => true,
                    'sortable' => true,
                ],
                'secondary_topic' => [
                    'type' => 'text',
                    'label' => 'Secondary Topic',
                    'rules' => 'nullable|string|max:255',
                    'searchable' => true,
                ],
                'format' => [
                    'type' => 'text',
                    'label' => 'Format',
                    'rules' => 'nullable|string|max:255',
                    'searchable' => true,
                ],
                'difficulty' => [
                    'type' => 'select',
                    'label' => 'Difficulty',
                    'rules' => 'required|in:Beginner,Intermediate,Advanced',
                    'options' => [
                        'Beginner' => 'Beginner',
                        'Intermediate' => 'Intermediate',
                        'Advanced' => 'Advanced',
                    ],
                    'default' => 'Beginner',
                ],
                'published_on' => [
                    'type' => 'date',
                    'label' => 'Published Date',
                    'rules' => 'nullable|date',
                    'sortable' => true,
                ],
                'duration_minutes' => [
                    'type' => 'number',
                    'label' => 'Video Duration Minutes',
                    'rules' => 'nullable|integer|min:0',
                    'default' => 0,
                    'attributes' => [
                        'min' => 0,
                        'step' => 1,
                    ],
                    'hide_in_index' => true,
                ],
                'thumbnail_image_path' => [
                    'type' => 'file',
                    'label' => 'Thumbnail Image',
                    'rules' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
                    'display_image' => true,
                    'display_image_position' => 'top',
                    'attributes' => [
                        'accept' => 'image/jpeg,image/png,image/webp,image/gif',
                    ],
                    'hide_in_index' => true,
                ],
                'video_path' => [
                    'type' => 'file',
                    'label' => 'Video File',
                    'rules' => 'nullable|file|mimes:mp4,mov,webm,ogg|max:102400',
                    'attributes' => [
                        'accept' => 'video/mp4,video/webm,video/ogg,video/quicktime',
                    ],
                    'hide_in_index' => true,
                ],
                'content_url' => [
                    'type' => 'url',
                    'label' => 'Content URL',
                    'rules' => 'nullable|url|max:2048',
                    'hide_in_index' => true,
                ],
                'sort_order' => [
                    'type' => 'number',
                    'label' => 'Sort Order',
                    'rules' => 'required|integer|min:0',
                    'default' => 0,
                    'sortable' => true,
                ],
                'is_published' => [
                    'type' => 'boolean',
                    'label' => 'Published',
                    'default' => true,
                    'sortable' => true,
                ],
            ],
        ],
        'blog-posts' => [
            'model' => BlogPost::class,
            'title' => 'Blog Posts',
            'title_singular' => 'Blog Post',
            'permission' => 'manage-blog',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 016.5 17H20" /><path stroke-linecap="round" stroke-linejoin="round" d="M8 6h8M8 10h8M8 14h5" /></svg>',
            'upload_disk' => 'public',
            'upload_directory' => 'blog',
            'fields' => [
                'blog_category_id' => [
                    'type' => 'select',
                    'label' => 'Category',
                    'rules' => 'required|exists:blog_categories,id',
                    'relationship' => 'blogCategory',
                    'option_label' => 'name',
                    'searchable' => true,
                    'sortable' => true,
                ],
                'title' => [
                    'type' => 'text',
                    'label' => 'Title',
                    'rules' => 'required|string|max:255',
                    'searchable' => true,
                    'sortable' => true,
                ],
                'excerpt' => [
                    'type' => 'textarea',
                    'label' => 'Excerpt',
                    'rules' => 'required|string',
                    'hide_in_index' => true,
                ],
                'content' => [
                    'type' => 'textarea',
                    'label' => 'Content',
                    'rules' => 'nullable|string',
                    'hide_in_index' => true,
                ],
                'published_on' => [
                    'type' => 'date',
                    'label' => 'Published Date',
                    'rules' => 'nullable|date',
                    'sortable' => true,
                ],
                'read_minutes' => [
                    'type' => 'number',
                    'label' => 'Read Minutes',
                    'rules' => 'required|integer|min:1',
                    'default' => 1,
                    'attributes' => [
                        'min' => 1,
                        'step' => 1,
                    ],
                    'sortable' => true,
                ],
                'thumbnail_image_path' => [
                    'type' => 'file',
                    'label' => 'Thumbnail Image',
                    'rules' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
                    'display_image' => true,
                    'display_image_position' => 'top',
                    'attributes' => [
                        'accept' => 'image/jpeg,image/png,image/webp,image/gif',
                    ],
                    'hide_in_index' => true,
                ],
                'thumbnail_style' => [
                    'type' => 'select',
                    'label' => 'Fallback Thumbnail Style',
                    'rules' => 'nullable|string|max:40',
                    'options' => [
                        '' => 'Auto',
                        'bias-img' => 'Bias Image',
                        'mindset-img' => 'Mindset Image',
                        'human-img' => 'Human Behavior Image',
                        'desk-img' => 'Desk Image',
                        'philosophy-img' => 'Philosophy Image',
                        'case-img' => 'Case Study Image',
                        'halo-img' => 'Halo Mini Image',
                        'ras-img' => 'RAS Mini Image',
                        'overthink-img' => 'Overthinking Mini Image',
                    ],
                    'hide_in_index' => true,
                ],
                'is_featured' => [
                    'type' => 'boolean',
                    'label' => 'Featured',
                    'default' => false,
                    'sortable' => true,
                ],
                'is_popular' => [
                    'type' => 'boolean',
                    'label' => 'Popular',
                    'default' => false,
                    'sortable' => true,
                ],
                'sort_order' => [
                    'type' => 'number',
                    'label' => 'Sort Order',
                    'rules' => 'required|integer|min:0',
                    'default' => 0,
                    'sortable' => true,
                ],
                'is_published' => [
                    'type' => 'boolean',
                    'label' => 'Published',
                    'default' => true,
                    'sortable' => true,
                ],
            ],
        ],
        'blog-categories' => [
            'model' => BlogCategory::class,
            'title' => 'Blog Categories',
            'title_singular' => 'Blog Category',
            'permission' => 'manage-blog',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" /></svg>',
            'fields' => [
                'name' => [
                    'type' => 'text',
                    'label' => 'Name',
                    'rules' => 'required|string|max:255|unique:blog_categories,name',
                    'searchable' => true,
                    'sortable' => true,
                ],
                'slug' => [
                    'type' => 'text',
                    'label' => 'Slug',
                    'rules' => 'nullable|string|max:255|unique:blog_categories,slug',
                    'searchable' => true,
                    'sortable' => true,
                    'help_text' => 'Leave blank to auto-generate from the name.',
                ],
                'description' => [
                    'type' => 'textarea',
                    'label' => 'Description',
                    'rules' => 'nullable|string',
                    'hide_in_index' => true,
                ],
                'sort_order' => [
                    'type' => 'number',
                    'label' => 'Sort Order',
                    'rules' => 'required|integer|min:0',
                    'default' => 0,
                    'sortable' => true,
                ],
                'is_active' => [
                    'type' => 'boolean',
                    'label' => 'Active',
                    'default' => true,
                    'sortable' => true,
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resource UI Settings
    |--------------------------------------------------------------------------
    |
    | Configure the appearance and behavior of resource forms and lists.
    |
    */
    'resource_ui' => [
        'show_global_errors' => env('TYRO_SHOW_GLOBAL_ERRORS', true),
        'show_field_errors' => env('TYRO_SHOW_FIELD_ERRORS', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Disable Examples
    |--------------------------------------------------------------------------
    |
    | If this is true, the "Examples" section in the sidebar will be hidden
    | and the example routes will be disabled.
    |
    */
    'disable_examples' => env('TYRO_DASHBOARD_DISABLE_EXAMPLES', true),
];
