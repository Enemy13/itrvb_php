<?php
require_once __DIR__ . "/vendor/autoload.php";

use Tgu\Bazitov\Repositories\ArticlesRepository\SqliteArticlesRepository;
use Tgu\Bazitov\Repositories\CommentRepository\SqliteCommentsRepository;
use Tgu\Bazitov\Repositories\UserRepository\SqliteUserRepository;
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

$user = new User(null, $faker->userName(), $faker->firstName(), $faker->lastName());


$article = new Article(null, $user->getId(), "titletest", 'texttest');

$comment = new Comment(null, $user->getId(), $article->getId(), "someComment");

$connection = new PDO('sqlite:' . __DIR__ . '/identifier.sqlite');

$userRepos = new SqliteUserRepository($connection);
$commentRepos = new SqliteCommentsRepository($connection);
$articleRepos = new SqliteArticlesRepository($connection);

$userRepos->save($user);

$articleRepos->save($article);

$commentRepos->save($comment);

echo $user->getUserName();
echo $user->getId();



