<?php

namespace App;

class Migration
{

    public function setData($pdo): void
    {
        $sql = "
            DROP TABLE IF EXISTS users;
        ";

        $pdo->exec($sql);
        /**
         * @create table users
         */
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTO_INCREMENT,
                email TEXT,
                password TEXT,
                address TEXT,
                history_count SMALLINT UNSIGNED NOT NULL DEFAULT 0
            );
      ";

        $pdo->exec($sql);

        for ($i = 0; $i < 30; $i++) {
            $email = 'email' . $i . '@gmail.com';
            $pass = sha1("secret");
            $address = $i . "Paris du marais";
            $pdo->exec("INSERT INTO users (email, password, address) VALUES ('$email', '$pass', '$address')");
        }
    }
}
