<?php
require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('books', function ($table) {
    $table->id();
    $table->integer('category_id');
    $table->string('title');
    $table->string('photo')->nullable();
    $table->string('isbn')->unique();
    $table->string('cover')->nullable();
    $table->date('published')->nullable();
    $table->timestamps();
});