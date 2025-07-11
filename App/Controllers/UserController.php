<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Models\User;
use \Core\View;
use \Core\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $session = Session::getInstance();
        if (!$session->isSignedIn()) {
            header('Location: /login');
        }
    }

    public function index()
    {
        $users = User::all();

        View::renderTemplate('Users/Index.html', ['users' => $users]);
    }

    public function create()
    {
        View::renderTemplate('Users/Create.html');
    }

    public function store()
    {
        User::create($_POST);
        header('Location: /users');
    }

    public function edit()
    {
        $user = User::findOrFail($_GET['id']);

        View::renderTemplate('Users/Edit.html', ['user' => $user]);
    }

    public function update()
    {
        $user = User::findOrFail($_POST['id']);
        $user->update($_POST);
        header('Location: /users');
    }

    public function destroy()
    {
        $user = User::findOrFail($_GET['id']);
        $user->delete();
        header('Location: /users');
    }
}
