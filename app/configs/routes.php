<?php

use App\Controllers\Pages;
use App\Controllers\Auth;
use App\Utils\WpApi;
use App\Ai\Agents\MyAgent;
use NeuronAI\Chat\Messages\UserMessage;
use flight\net\Router;


// $app = Flight::app();


$app->route('/', [Pages::class, 'home']);
$app->route('/mentors', [Pages::class, 'mentors']);
$app->route('/mentors/@slug', [Pages::class, 'mentor']);


// Auth Section
$app->group('', function(Router $router) use($app) {
  // $router->get('/login', [Auth::class, 'index']);
  $router->get('/login', [Auth::class, 'login']);
  $router->get('/register', [Auth::class, 'register']);
  $router->post('/register', [Auth::class, 'register']);
  $router->get('/forget', [Auth::class, 'forget']);
  $router->get('/reset', [Auth::class, 'reset']);
  $router->get('/valid', [Auth::class, 'valid']);
  $router->get('/token', [Auth::class, 'token']);
  $router->get('/logout', [Auth::class, 'logout']);
});


$app->route('/me', function() use ($app) {
  $app->json(WpApi::me());
});

// Auth
// $app->route('/login', function() use ($app) {
//   // $app->render('fronts/login');
//   $app->json(WpApi::login('imshibaji', 'Sdnsdn1497@1'));
// });

// $app->route('/token', function() use($app) {
//   $wpapi = new WpApi();
//   $app->json(['token' => $wpapi->token()]);
// });

// $app->route('/valid', function() use($app) {
//   $app->json(['isToken' => WpApi::validateToken()]);
// });

// $app->route('/logout', function() use ($app) {
//   $app->json(WpApi::logout());
// });

$app->route('/dashboard', function() use ($app) {
  $app->render('backs/dashboard');
});

$app->route('/menus', function() use ($app) {
  $app->json(WpApi::init()->graphql('{menus(where: {location:MAX_MEGA_MENU_1}){nodes{id name menuItems{nodes{id label path}}}}}'));
});

$app->route('/posts', function() use($app) {
  $wpapi = new WpApi();
  // $wpapi->createPost([
  //   'title' => 'Test Post',
  //   'content' => 'This is a test post',
  // ]);
  $app->json($wpapi->getPosts());
  // $app->json($wpapi->getTrash('post'));
  // $app->json($wpapi->getDrafts('post'));
  // $app->json($wpapi->getPostBySlug('test-post-2'));
});

$app->route('/seo', function() use($app) {
    $currentUrl = $_GET['url'] ?? 'https://larnr.com';

    // 2. Fetch from WpApi
    $data = WpApi::init()->getRankMathData($currentUrl);

    $app->json($data);
});

$app->route('/ai', function() use($app) {
  $msg = $_GET['msg'] ?? 'Hello';
  $ai = MyAgent::make()->chat(new UserMessage($msg))
    ->getMessage();

  // $app->json([
  //   'msg' => $ai->getContent()
  // ]);
  // $app->response()->write($ai->getContent());
  echo $ai->getContent();
});



$app->route('/@slug', [Pages::class, 'page']);