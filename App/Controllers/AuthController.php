<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Models\User;
use \Core\View;
use \Core\Controller;

class AuthController extends Controller
{
    public function login()
    {
        View::renderTemplate('Login.html');
    }

    public function loginStore()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::where('email', $email)->where('password', $password)->latest()->first();

        $session = Session::getInstance();
        if ($user) {
            $session->login($user);
            header('Location: /borrows');
            exit;
        } else {
            $session->message("Your email or password is incorrent");
            header('Location: /login');
        }
        header('Location: /login');
    }

    public function logout()
    {
        $session = Session::getInstance();

        if (! $session->isSignedIn()){
            header('Location: /login');
        }

        $session->logout();
        header('Location: /login');
    }
}
