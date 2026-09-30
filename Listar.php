<?php
require_once "config/conexao.php";

$piada = null;

if (isset($_POST["ver"])) {

    $categoria = $_POST["categoria"];

    $sql = "SELECT texto FROM piadas WHERE categoria = ? ORDER BY RAND() LIMIT 1";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$categoria]);

    $piada = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Piada</title>
</head>

<body>

    <h1>Espaço para visualizar as piadas </h1>    

    <form method="POST">
        
        <label>Escolha uma categoria:</label>
        <select name="categoria">
            <option value="programacao">Programação</option>
            <option value="asri">ASRI</option>
            <option value="medicina">Medicina</option>
            <option value="contabilidade">Contabilidade</option>  
            <option value="mecanica">Mecânica</option>
            <option value="aduaneiro">Aduaneiro</option>
            <option value="geral">Geral</option>
        </select>
    
        <button type="submit" name="ver">Ver Piada</button>
    
    </form>

<?php

if($piada) {
    echo "<p>" . $piada["texto"] . "</p>";
} else {
    echo "<p>Ainda não existem piadas nesta categoria.</p>";
}

?>

</body>
</html>