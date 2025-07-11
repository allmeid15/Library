<?php

namespace App\Controllers;

use App\Models\Author;
use App\Helpers\Session;
use \Core\View;
use \Core\Controller;

class AuthorController extends Controller
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
        $authors = Author::orderBy('id', 'desc')->get();

        View::renderTemplate('Authors/Index.html', ['authors' => $authors]);
    }

    public function show()
    {

    }

    public function create()
    {
        View::renderTemplate('Authors/Create.html');
    }

    public function store()
    {
        $author = new Author();
        $author->first_name = $_POST['first_name'];
        $author->last_name = $_POST['last_name'];
        $author->country = $_POST['country'];
        $author->save();

        header('Location: /authors');
    }

    public function edit()
    {
        $author = Author::findOrFail($_GET['id']);
        View::renderTemplate('Authors/Edit.html', ['author' => $author]);
    }

    public function update()
    {
        $author = Author::findOrFail($_POST['id']);

        $author->first_name = $_POST['first_name'];
        $author->last_name = $_POST['last_name'];
        $author->country = $_POST['country'];
        $author->save();

        header('Location: /authors');
    }

    public function destroy()
    {
        $author = Author::findOrFail($_GET['id']);
        $author->delete();

        header('Location: /authors');
    }
}
