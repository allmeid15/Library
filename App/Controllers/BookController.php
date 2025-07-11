<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use \Core\View;
use \Core\Controller;

class BookController extends Controller
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
        $books = Book::orderBy('id', 'desc')
            ->with('category')
            ->with('authors')
            ->get();

        View::renderTemplate('Books/index.html', ['books' => $books]);
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('first_name')->orderBy('last_name')->get();

        View::renderTemplate('Books/Create.html', [
            'categories' => $categories,
            'authors' => $authors,
            ]);
    }

    public function store()
    {
        $file_tmp = $_FILES['cover']['tmp_name'];
        $file_name = time() . '_' . $_FILES['cover']['name'];
        move_uploaded_file($file_tmp, "../public/uploads/" . $file_name);

        //$file_tmps = $_FILES['gallery']['tmp_name'];
        //$file_names = $_FILES['gallery']['name'];

        $gallery = [];

        for ($i = 0; $i < count($file_tmps); $i++)
        {
            $file_tmp = $file_tmps[$i];
            $file_name = time() . '_' . $file_names[$i];
            move_uploaded_file($file_tmp, "../public/uploads/" . $file_name);

            $gallery[] = $file_name;
        }

        $data = $_POST;
        $data['cover'] = $file_name;
        unset($data['gallery']); //kthehu te gallery

        $book = Book::create($data);

        $book->authors()->attach($_POST['author_ids']);

        header('Location: /books');
    }

    public function edit()
    {
        $book = Book::with('authors')->findOrFail($_GET['id']);

        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('first_name')->orderBy('last_name')->get();

        View::renderTemplate('Books/Edit.html', [
            'book' => $book,
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }

    public function update()
    {
        $book = Book::with('authors')->findOrFail($_POST['id']);

        $book->update($_POST);
        $book->authors()->sync($_POST['author_ids']);

        header('Location: /books');
    }

    public function destroy()
    {
        $book = Book::with('authors')->findOrFail($_GET['id']);
        $book->authors()->detach();
        $book->delete();

        header('Location: /books');
    }

}
