<?php
require_once "config/conexao.php";

$id = $_GET["id"];

$sql = "SELECT * FROM piadas WHERE id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

$piada = $stmt->fetch();


if(isset($_POST["editar"])) {

    $categoria = $_POST["categoria"];
    $texto = $_POST["texto"];

    $sql = "UPDATE piadas SET categoria = ?, texto = ? WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$categoria, $texto, $id]);

    echo "Piada editada com sucesso!";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Piada</title>
</head>

<body>

    <h1>Editar Piada</h1>

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
    <textarea name="texto"><?php echo $piada["texto"]; ?></textarea>

    <br><br>
    
    <button type="submit" name="editar">Guardar alterações</button>

    </form>

</body>

</html>