<?php

require_once "config/conexao.php";

if (isset($_POST["confirmar"])) {
    $id = (int) $_POST["id"];
} elseif (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
} else {
    exit("ID inválido.");
}

if ($id <= 0) {
    exit("ID inválido.");
}


// Buscar a piada
$sql = "SELECT piadas.id, piadas.texto,
               areas.nome AS area,
               niveis.nome AS nivel
        FROM piadas
        INNER JOIN areas ON piadas.area_id = areas.id
        INNER JOIN niveis ON areas.nivel_id = niveis.id
        WHERE piadas.id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$piada = $stmt->fetch();

if (!$piada) {
    exit("Piada não encontrada.");
}


// Eliminar a piada
if (isset($_POST["confirmar"])) {

    $sql = "DELETE FROM piadas WHERE id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: gerenciar.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Piada</title>
</head>

<body>

    <h1>Confirmar eliminação</h1>

    <p>Tem certeza de que deseja eliminar esta piada?</p>

    <p>
        <strong>Nível:</strong>
        <?php echo htmlspecialchars($piada["nivel"]); ?>
    </p>

    <p>
        <strong>Área:</strong>
        <?php echo htmlspecialchars($piada["area"]); ?>
    </p>

    <p>
        <strong>Piada:</strong>
        <?php echo htmlspecialchars($piada["texto"]); ?>
    </p>

    <form method="POST">

        <input type="hidden" name="id"
               value="<?php echo $piada["id"]; ?>">

        <button type="submit" name="confirmar">
            Sim, eliminar
        </button>

        <a href="gerenciar.php">Cancelar</a>

    </form>

</body>

</html>