<?php

// Routes
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\User;

// example home route
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->group('/api', function () use ($app) {

    $app->group('/v1', function () use ($app) {

        $app->get('/users', function ($request, $response){

            $users = User::all();

            // logging within the controller
            $this->logger->info($request->getUri() . " route");

            return $response->withJson([
                'code' => 200,
                'total_results' => $users->count(),
                'data' => $users
            ]);

        });

    });
});