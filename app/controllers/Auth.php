<?php
namespace App\Controllers;

class Auth extends Controller
{
    public function index()
    {
        $this->app->render('auth/login');
    }

    public function login()
    {
        $this->app->json($this->wpApi->login('amitr', 'password'));
    }

    public function register()
    {
        $this->app->render('auth/register');
    }

    public function logout()
    {
        // $this->app->render('auth/logout');
        $this->wpApi->logout();
        $this->app->redirect('/me');
    }

    public function forget()
    {
        $this->app->render('auth/forget');
    }

    public function reset()
    {
        $this->app->render('auth/reset');
    }

    public function valid()
    {
        $this->app->json(['valid' => $this->wpApi->validateToken()]);
    }

    public function token()
    {
        $this->app->json(['token' => $this->wpApi->token()]);
    }
}