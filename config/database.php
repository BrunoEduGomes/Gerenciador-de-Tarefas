<?php
declare(strict_types=1);

class Database {
    public static function connect(): PDO {
        return new PDO(
            "mysql:host=localhost;dbname=task_manager;charset=utf8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}
