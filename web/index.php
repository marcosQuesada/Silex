    <?php
// web/index.php

require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

// definitions
$blogPosts = array(
    1 => array(
        'date'      => '2011-03-29',
        'author'    => 'igorw',
        'title'     => 'Using Silex',
        'body'      => '...',
    ),
    2 => array(
        'date'      => '2011-03-29',
        'author'    => 'igorw',
        'title'     => 'Using Silex 2',
        'body'      => '...',
    ),
);

$app->get('/blog', function (Silex\Application $app, Request $request) use ($blogPosts) {
    /*if (!isset($blogPosts[3])) {
        $app->abort(404, "Post 3 does not exist.");
    }*/

    $message = $request->get('message');

    var_dump($message);
    
    $output = '';
    foreach ($blogPosts as $post) {
        $output .= $post['title'];
        $output .= '<br />';
    }

    return new Response($output, 201);
});

$app->get('/blog/show/{id}', function (Silex\Application $app, $id) use ($blogPosts) {
    if (!isset($blogPosts[$id])) {
        $app->abort(404, "Post $id does not exist.");
    }

    $post = $blogPosts[$id];

    return  "<h1>{$post['title']}</h1>".
        "<p>{$post['body']}</p>";
});


$app->post('/feedback', function (Request $request) {
    $message = $request->get('message');

    var_dump($message);
//    mail('feedback@yoursite.com', '[YourSite] Feedback', $message);

    return new Response('Thank you for your feedback!', 201);
});

$app->run();