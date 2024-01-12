<?php
require_once __DIR__ . "/vendor/autoload.php";

use Tgu\Bazitov\User;
use Tgu\Bazitov\Article;
use Tgu\Bazitov\Comment;
use Faker\Factory;

spl_autoload_register(function ($class) {
    $file = str_replace(['\\', '_'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $class);
    $filePath = __DIR__ . $file . '.php';

    if (file_exists($filePath)) {
        require_once($filePath);
    }
});

$faker = Factory::create('ru_RU');

$user = new User($faker->userName(), $faker->firstName(), $faker->lastName());

echo $user->getUserName();
echo $user->getId();

