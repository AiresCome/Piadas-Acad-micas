<?php
require_once "config/conexao.php";

if (isset($_POST["enviar"])) {

    $categoria = $_POST["categoria"];
    $texto = trim($_POST["texto"]);

    $sql = "INSERT INTO piadas (categoria, texto) VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$categoria, $texto]);

    echo "Piada adicionada com sucesso!";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdicionarPiadaa</title>
</head>

<body>
   
    <h1>Espaço para adicionar as piadas </h1>    

    <form method="POST">
        
        <label>Categoria:</label>
        <select name="categoria">
            <option value="programacao">Programação</option>
            <option value="asri">ASRI</option>
            <option value="medicina">Medicina</option>
            <option value="contabilidade">Contabilidade</option>  
            <option value="mecanica">Mecânica</option>
            <option value="aduaneiro">Aduaneiro</option>
            <option value="geral">Geral</option>
        </select> 
        
        <br><br>

        <label>Piada:</label>
        <textarea name="texto"></textarea>

        <br><br>

        <button type="submit" name="enviar">Adicionar</button>
        
    </form>


</body>
</html>