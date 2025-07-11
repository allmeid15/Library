<?php

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);

$router->add('users', ['controller' => 'UserController', 'action' => 'index']);
$router->add('users/create', ['controller' => 'UserController', 'action' => 'create']);
$router->add('users/store', ['controller' => 'UserController', 'action' => 'store']);
$router->add('users/edit', ['controller' => 'UserController', 'action' => 'edit']);
$router->add('users/update', ['controller' => 'UserController', 'action' => 'update']);
$router->add('users/delete', ['controller' => 'UserController', 'action' => 'destroy']);

$router->add('authors', ['controller' => 'AuthorController', 'action' => 'index']);
$router->add('authors/create', ['controller' => 'AuthorController', 'action' => 'create']);
$router->add('authors/store', ['controller' => 'AuthorController', 'action' => 'store']);
$router->add('authors/edit', ['controller' => 'AuthorController', 'action' => 'edit']);
$router->add('authors/update', ['controller' => 'AuthorController', 'action' => 'update']);
$router->add('authors/delete', ['controller' => 'AuthorController', 'action' => 'destroy']);

$router->add('students', ['controller' => 'StudentController', 'action' => 'index']);
$router->add('students/create', ['controller' => 'StudentController', 'action' => 'create']);
$router->add('students/store', ['controller' => 'StudentController', 'action' => 'store']);
$router->add('students/edit', ['controller' => 'StudentController', 'action' => 'edit']);
$router->add('students/update', ['controller' => 'StudentController', 'action' => 'update']);
$router->add('students/delete', ['controller' => 'StudentController', 'action' => 'destroy']);

$router->add('categories', ['controller' => 'CategoryController', 'action' => 'index']);
$router->add('categories/create', ['controller' => 'CategoryController', 'action' => 'create']);
$router->add('categories/store', ['controller' => 'CategoryController', 'action' => 'store']);
$router->add('categories/edit', ['controller' => 'CategoryController', 'action' => 'edit']);
$router->add('categories/update', ['controller' => 'CategoryController', 'action' => 'update']);
$router->add('categories/delete', ['controller' => 'CategoryController', 'action' => 'destroy']);

$router->add('books', ['controller' => 'BookController', 'action' => 'index']);
$router->add('books/create', ['controller' => 'BookController', 'action' => 'create']);
$router->add('books/store', ['controller' => 'BookController', 'action' => 'store']);
$router->add('books/edit', ['controller' => 'BookController', 'action' => 'edit']);
$router->add('books/update', ['controller' => 'BookController', 'action' => 'update']);
$router->add('books/delete', ['controller' => 'BookController', 'action' => 'destroy']);

$router->add('borrows', ['controller' => 'BorrowController', 'action' => 'index ']);
$router->add('borrows/create', ['controller' => 'BorrowController', 'action' => 'create ']);
$router->add('borrows/store', ['controller' => 'BorrowController', 'action' => 'store ']);
$router->add('borrows/edit', ['controller' => 'BorrowController', 'action' => 'edit ']);
$router->add('borrows/update', ['controller' => 'BorrowController', 'action' => 'update']);
$router->add('borrows/delete', ['controller' => 'BorrowController', 'action' => 'destroy']);
$router->add('borrows/return', ['controller' => 'BorrowController', 'action' => 'return']);


$router->add('login', ['controller' => 'AuthController', 'action' => 'login']);
$router->add('login/store', ['controller' => 'AuthController', 'action' => 'loginStore']);
$router->add('logout', ['controller' => 'AuthController', 'action' => 'logout']);

$router->dispatch($_SERVER['QUERY_STRING']);


?>