<?php
class Database
{

    public static function Conectar()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=b2btic;charset=utf8', 'root', '');
        //Filtrando posibles errores de conexión.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
