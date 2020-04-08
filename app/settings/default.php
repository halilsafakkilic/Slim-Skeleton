<?php

use Monolog\Logger;

return [
    'displayErrorDetails' => true,
    'logger'              => [
        'name'  => 'slim-app',
        'path'  => isset($_ENV['docker']) ? 'php://stdout' : APP_DIR . '/storage/logs/app.log',
        'level' => Logger::DEBUG,
    ]
];