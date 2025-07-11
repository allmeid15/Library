<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Models\Student;
use \Core\View;
use \Core\Controller;

class StudentController extends Controller
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
        $students = Student::orderBy('id', 'desc')->get();

        View::renderTemplate('Students/Index.html', ['students' => $students]);
    }

    public function create()
    {
        View::renderTemplate('Students/Create.html');
    }

    public function store()
    {
        Student::create($_POST);
        header('Location: /students');
    }

    public function edit()
    {
        $student = Student::findOrFail($_GET['id']);

        View::renderTemplate('Students/Edit.html',[ 'student' => $student]);
    }

    public function update()
    {
        $student = Student::findOrFail($_POST['id']);
        $student->update($_POST);

        header('Location: /students');
    }

    public function destroy()
    {
        $student = Student::findOrFail($_GET['id']);
        $student->delete();

        header('Location: /students');
    }
}
