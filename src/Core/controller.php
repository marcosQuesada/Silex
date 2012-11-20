<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Core\Model;

/**
 *  /
 **/
$app->get('/', function (Silex\Application $app, Request $request){

     $model = new Model($app['db']);
     echo "<pre>";
     var_dump($model->getCategory(1));
     echo "</pre>";
     $categories = $model->getAll('categorias');

     /*if (!isset($blogPosts[3])) {
              $app->abort(404, "Post 3 does not exist.");
     }*/

     foreach ($categories as $post) {
              echo var_export($post);
              echo '<br />';
     }

    $message = $request->get('message');
    if (isset($message))
        echo "Message:".$message;

    return new Response('', 201);
});

/**
*  /blog/show/{id}
*  parameter: id
**/
$app->get('/blog/show/{id}', function (Silex\Application $app, $id) {
    $model = new Model($app['db']);
    echo "<pre>";
    $data = $model->getCategory($id);

    if (!$data) {
        $app->abort(404, "Post $id does not exist.");
    }

    return  "<h1>{$data['title_es']}</h1>".
        "<p>ID:{$id}</p>";
});


/**
 *  /catch error response
 *
 **/
$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = $e->getMessage().'OHHH! The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
            var_dump($e->getMessage());
    }

    return new Response($message, 404, array('X-header-test'=> 'ok'));
});


