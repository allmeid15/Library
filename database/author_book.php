<?php
require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('author_book', function ($table) {
    $table->integer('author_id');
    $table->integer('book_id');
});