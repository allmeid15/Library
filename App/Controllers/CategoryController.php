<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Models\Category;
use \Core\View;
use \Core\Controller;

class CategoryController extends Controller
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
        $categories = Category::orderBy('id', 'desc')->get();

        View::renderTemplate('Categories/Index.html', ['categories' => $categories]);
    }

    public function create()
    {
        View::renderTemplate('Categories/Create.html');
    }

    public function store()
    {
        Category::create($_POST);
        header('Location: /categories');
    }

    public function edit()
    {
        $category = Category::findOrFail($_GET['id']);

        View::renderTemplate('Categories/Edit.html',[ 'category' => $category]);
    }

    public function update()
    {
        $category = Category::findOrFail($_POST['id']);
        $category->update($_POST);

        header('Location: /categories');
    }

    public function destroy()
    {
        $category = Category::findOrFail($_GET['id']);
        $category->delete();

        header('Location: /categories');
    }
}
