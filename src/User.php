<?php

namespace App;

class User
{
    protected $pdo = null;
    protected $id;
    protected $email;
    protected $history_count;
    protected $dns;

    public function __construct()
    {
        $this->dns = "mysql:host=localhost;dbname=event_manager";
        $this->pdo = FactoryPDO::build("mysql:host=localhost;dbname=event_manager", "root", "toor");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getHistoryCount()
    {
        return $this->history_count;
    }

    public function setHistoryCount(string $count)
    {
        $this->history_count = $count;

        return;
    }

    public function find(int $id)
    {
        $prepare = $this->pdo->prepare('SELECT * FROM users WHERE id=?');

        $prepare->bindValue(1, $id);
        $prepare->execute();

        return $prepare->fetchObject(User::class, [$this->dns]);
    }

    public function all()
    {
        $prepare = $this->pdo->prepare('SELECT * FROM users');
        $prepare->execute();
        return $prepare->fetchAll(\PDO::FETCH_CLASS);
    }

    public function persist()
    {
        $prepare = $this->pdo->prepare('UPDATE users SET history_count = ? WHERE id = ?');
        $prepare->bindValue(1, $this->getHistoryCount() + 1);
        $prepare->bindValue(2, $this->id);
        $prepare->execute();

        return;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return;
    }
}
