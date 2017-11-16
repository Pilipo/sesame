<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "users" => [
        "pip" => "P@ssw0rd",
    ],
    "secure" => false,
]));