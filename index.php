<?php

require("vendor/autoload.php");

use App\{EventManager, FactoryPDO, Migration, User};

$pdo = new FactoryPDO();
$newPdo = $pdo->build("mysql:host=localhost;dbname=event_manager", "root", "toor");

// $migration = new Migration();
// $migration->setData($newPdo);

$user = new User();
$userOne = $user->find(1);
$userOne->setEmail('toto@lasticot.com');
$userOne->persist();

EventManager::attach('database.user.update', function ($args) {
    $id = $args['id'];
    echo "create new update id : $id";
});

EventManager::trigger('database.user.update', ['id' => $userOne->getId(), $userOne->persist()]);

var_dump($user->find(1));
