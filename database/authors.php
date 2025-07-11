<?php
require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('authors', function ($table) {
    $table->id();
    $table->string('first_name', 30);
    $table->string('last_name', 30);
    $table->string('country', 30)->nullable();
    $table->timestamps();
});