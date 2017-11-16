<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


$app->get('/status', function (Request $req, Response $res, array $arg) {
    $this->logger->info("Slim-Skeleton '/' route");

    $data = array('status' => "Populate this with door or system status.");
    $res = $res->withJson($data);
    return $res;
});

$app->get('/command/open', function (Request $req, Response $res, array $arg) {
    $this->logger->info("Slim-Skeleton '/' route");

    $data = array(
        'status' => "Populate this with door OPEN action confirmation and success or failure.",
        'action' => "OPEN"
    );
    $res = $res->withJson($data);
    return $res;
});

$app->get('/command/close', function (Request $req, Response $res, array $arg) {
    $this->logger->info("Slim-Skeleton '/' route");

    $data = array(
        'status' => "Populate this with door CLOSE action confirmation and success or failure.",
        'action' => "CLOSE"
    );
    $res = $res->withJson($data);
    return $res;
});