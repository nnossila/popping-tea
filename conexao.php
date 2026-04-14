<?php
class Conexao{
    private static $pdo;

    public static function conectar(){
        if (!self::$pdo){
            self::$pdo = new PDO(
                "mysql:host=localhost;dbname=popping_tea",
                "root",
                ""
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
?>