<?php

try{
    $db = 'mysql: host=localhost;dbname=piadas_academicas';
    $usuario = 'root';
    $senha = '';

    $opcoes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = new PDO($db, $usuario, $senha, $opcoes);

} catch(PDOException $e) {
    echo "Erro na conexão: " .$e->getMessage();
}

?>