<?php

use Knuckles\Scribe\Extracting\Strategies;
use Knuckles\Scribe\Config\Defaults;
use Knuckles\Scribe\Config\AuthIn;
use function Knuckles\Scribe\Config\{removeStrategies, configureStrategy};

return [
    'title' => config('app.name').' API Documentation',
    'description' => 'THIS DOCUMENTATION IS FOR THE API OF THE SOFTWARE MANAGEMENT SYSTEM. IT IS USED TO MANAGE USERS, ROLES, PERMISSIONS, AND OTHER RELATED FEATURES.',
    'base_url' => config('app.url'),
    'routes' => [
        [
            'match' => [
                'prefixes' => ['api/*'],
                'domains' => ['*'],
            ],
            'include' => [],
            'exclude' => [],
        ],
    ],
    'type' => 'laravel',
    'theme' => 'default',
    'static' => [
        'output_path' => 'public/docs',
    ],
    'laravel' => [
        'add_routes' => true,
        'docs_url' => '/docs',
        'assets_directory' => null,
        // Thêm middleware để xử lý xác thực JWT
        'middleware' => ['api'], // Thay bằng middleware thực tế nếu khác
    ],
    'external' => [
        'html_attributes' => [],
    ],
    'try_it_out' => [
        'enabled' => true,
        'base_url' => null,
        'use_csrf' => false,
        'csrf_url' => '/sanctum/csrf-cookie',
    ],
    'auth' => [
        'enabled' => true, // Bật xác thực vì API sử dụng JWT
        'default' => true, // Mặc định yêu cầu xác thực
        'in' => AuthIn::HEADER->value, // Sử dụng header
        'name' => 'Authorization', // Tên header
        'use_value' => 'Bearer {YOUR_JWT_TOKEN}', // Placeholder token
        'placeholder' => '{YOUR_JWT_TOKEN}', // Placeholder cho người dùng
        'extra_info' => 'You can retrieve your JWT token by logging in via the /api/login endpoint.',
    ],
    'intro_text' => <<<INTRO
        This documentation aims to provide all the information you need to work with our API.

        <aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
        You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
    INTRO,
    'example_languages' => [
        'bash',
        'javascript',
    ],
    'postman' => [
        'enabled' => true,
        'overrides' => [],
    ],
    'openapi' => [
        'enabled' => true,
        'overrides' => [],
        'generators' => [],
    ],
    'groups' => [
        'default' => 'Endpoints',
        'order' => [],
    ],
    'logo' => false,
    'last_updated' => 'Last updated: {date:F j, Y}',
    'examples' => [
        'faker_seed' => 1234,
        'models_source' => ['factoryCreate', 'factoryMake', 'databaseFirst'],
    ],
    'strategies' => [
        'metadata' => [
            ...Defaults::METADATA_STRATEGIES,
        ],
        'headers' => [
            ...Defaults::HEADERS_STRATEGIES,
            Strategies\StaticData::withSettings(data: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]),
        ],
        'urlParameters' => [
            ...Defaults::URL_PARAMETERS_STRATEGIES,
        ],
        'queryParameters' => [
            ...Defaults::QUERY_PARAMETERS_STRATEGIES,
        ],
        'bodyParameters' => [
            ...Defaults::BODY_PARAMETERS_STRATEGIES,
        ],
        'responses' => configureStrategy(
            Defaults::RESPONSES_STRATEGIES,
            Strategies\Responses\ResponseCalls::withSettings(
                only: ['GET *', 'POST *', 'PATCH *', 'DELETE *'], // Bật cho tất cả phương thức
                config: [
                    'app.debug' => false,
                ]
            )
        ),
        'responseFields' => [
            ...Defaults::RESPONSE_FIELDS_STRATEGIES,
        ],
    ],
    'database_connections_to_transact' => [config('database.default')],
    'fractal' => [
        'serializer' => null,
    ],
];