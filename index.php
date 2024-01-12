<?php
require_once __DIR__ . "/vendor/autoload.php";

use Tgu\Bazitov\User;
use Tgu\Bazitov\Article;
use Tgu\Bazitov\Comment;

spl_autoload_register(function ($class) {
    $file = str_replace(['\\', '_'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $class);
    $filePath = __DIR__ . $file . '.php';

    if (file_exists($filePath)) {
        require_once($filePath);
    }
});

$user = new User(5, 'Dmitriy', 'Bazitov');

echo $user->firstName;

