<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/model.php';

/**
 *  /
 **/
$app->get('/', function (Silex\Application $app, Request $request) use ($blogPosts) {


    echo "<pre>";
    var_dump($app['config']);
    echo "</pre>";
    /*if (!isset($blogPosts[3])) {
        $app->abort(404, "Post 3 does not exist.");
    }*/

    $message = $request->get('message');

    foreach (getRoutes($app) as $key=>$route) {
        echo "key:".$key."-".$route->getPattern()."<br><br>";
    }
    $output = '';
    foreach ($blogPosts as $post) {
        $output .= $post['title'];
        $output .= '<br />';
    }

//    return $app->json(array('name' => array(1=>'x', 2=> 'y')));
    return new Response($output, 201);
});



/**
 *  /blog/show/{id}
 *  parameter: id
 **/
$app->get('/blog/show/{id}', function (Silex\Application $app, $id) use ($blogPosts) {
    if (!isset($blogPosts[$id])) {
        $app->abort(404, "Post $id does not exist.");
    }

    $post = $blogPosts[$id];

    return  "<h1>{$post['title']}</h1>".
        "<p>{$post['body']}</p>";
});

/**
 *  /feedback
 *  requeriments: POST
 **/
$app->post('/feedback', function (Request $request) {
    $message = $request->get('message');

    var_dump($message);
//    mail('feedback@yoursite.com', '[YourSite] Feedback', $message);

    return new Response('Thank you for your feedback!', 201);
});

/**
 *  /test
 * //redirect
 **/
$app->get('/test', function () use ($app) {
    return $app->redirect('/');
});

/**
 *  /catch error response
 *
 **/
$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = 'OHHH! The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message, 404, array('X-header-test'=> 'ok'));
});

function getRoutes($app)
{
    return $app['routes']->all();

}