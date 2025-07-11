<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Student;
use \Core\View;
use \Core\Controller;


class BorrowController extends Controller
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
        $borrows = Borrow::orderBy('id', 'desc')
            ->with('user')
            ->with('student')
            ->with('book')
            ->get();

        View::renderTemplate('Borrows/Index.html', ['borrows' => $borrows]);
    }

    public function create()
    {
        $books = Book::orderBy('title')->get();
        $students = Student::orderBy('first_name')->orderBy('last_name')->get();

        View::renderTemplate('Borrows/Create.html', [
            'books' => $books,
            'students' => $students,
        ]);
    }

    public function store()
    {

        $data = $_POST;
        $data['user_id'] = 1;
        $data['borrow_date'] = date("Y-m-d H:i:s");

        Borrow::create($data);
        header('Location: /borrows');
    }

    public function edit()
    {
        $borrow = Borrow::findOrFail($_GET['id']);
        $books = Book::orderBy('title')->get();
        $students = Student::orderBy('first_name')->orderBy('last_name')->get();

        View::renderTemplate('Borrows/Edit.html',[
            'borrow' => $borrow,
            'books' => $books,
            'students' => $students,
        ]);
    }

    public function update()
    {
        $borrow = Borrow::findOrFail($_POST['id']);
        $borrow->update($_POST);

        header('Location: /borrows');
    }

    public function destroy()
    {
        $borrow = Borrow::findOrFail($_GET['id']);
        $borrow->delete();

        header('Location: /borrows');
    }

    public function return()
    {
        $borrow = Borrow::findOrFail($_GET['id']);
        $borrow->return_date = date('Y-m-d H:i:s');
        $borrow->save();

        header('Location: /borrows');
    }
}
