<?php

use App\Controllers\Pages;
use App\Utils\WpApi;
use App\Ai\Agents\MyAgent;
use NeuronAI\Chat\Messages\UserMessage;


// $app = Flight::app();


$app->route('/', [Pages::class, 'home']);
$app->route('/mentors', [Pages::class, 'mentors']);
$app->route('/mentors/@slug', [Pages::class, 'mentor']);

// Auth
$app->route('/login', function() use ($app) {
  // $app->render('fronts/login');
  $app->json(WpApi::init()->login('imshibaji', 'Sdnsdn1497@1'));
});

$app->route('/register', function() use ($app) {
  $app->render('fronts/register');
});

$app->route('/forget', function() use ($app) {
  $app->render('fronts/forget');
});

$app->route('/dashboard', function() use ($app) {
  $app->render('backs/dashboard');
});

$app->route('/menus', function() use ($app) {
  $app->json(WpApi::init()->graphql('{menus(where: {location:MAX_MEGA_MENU_1}){nodes{id name menuItems{nodes{id label path}}}}}'));
});

$app->route('/json', function() use($app) {
  $wpapi = new WpApi($app);
  $app->json($wpapi->getPages());
});

$app->route('/token', function() use($app) {
  $wpapi = new WpApi();
  $app->json($wpapi->getCache('user_token'));
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