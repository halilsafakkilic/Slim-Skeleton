<?php

use DI\ContainerBuilder;

return function(ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'settings' => require(APP_DIR . '/app/settings/default.php')
    ]);
};