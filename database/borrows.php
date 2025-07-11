<?php
require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('borrows', function ($table) {
    $table->id();
    $table->integer('book_id');
    $table->integer('user_id');
    $table->integer('student_id');
    $table->datetime('borrow_date');
    $table->datetime('return_date')->nullable();
    $table->decimal('price', 4, 2);
    $table->text('comment')->nullable();
    $table->timestamps();
});