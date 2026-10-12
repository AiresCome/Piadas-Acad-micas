<?php

require_once "config/conexao.php";

$id = (int) $_GET["id"];

$sql = "SELECT * FROM piadas WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$piada = $stmt->fetch();

if (!$piada) {
    echo "Piada não encontrada.";
    exit;
}

$area_id = $piada["area_id"];
$texto = $piada["texto"];
$mensagem = "";


// Buscar todas as áreas
$sql = "SELECT areas.id, areas.nome AS area,
               niveis.nome AS nivel
        FROM areas
        INNER JOIN niveis
            ON areas.nivel_id = niveis.id
        ORDER BY niveis.id, areas.nome";

$stmt = $pdo->query($sql);
$areas = $stmt->fetchAll();


// Guardar alterações
if (isset($_POST["editar"])) {

    $area_id = (int) $_POST["area_id"];
    $texto = trim($_POST["texto"]);

    if ($texto == "") {

        $mensagem = "A piada não pode estar vazia.";

    } else {

        $sql = "UPDATE piadas
                SET area_id = ?, texto = ?
                WHERE id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$area_id, $texto, $id]);

        header("Location: gerenciar.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Editar Piada</title>
</head>

<body>

    <h1>Editar Piada</h1>

    <p><?php echo $mensagem; ?></p>

    <form method="POST" action="editar.php?id=<?php echo $id; ?>">

        <label>Área:</label>

        <select name="area_id">

            <?php foreach ($areas as $area) { ?>

                <option
                    value="<?php echo $area["id"]; ?>"
                    <?php
                    if ($area_id == $area["id"]) {
                        echo "selected";
                    }
                    ?>
                >
                    <?php
                    echo htmlspecialchars(
                        $area["nivel"] . " - " . $area["area"]
                    );
                    ?>
                </option>

            <?php } ?>

        </select>

        <br><br>

        <label>Piada:</label>

        <br>

        <textarea name="texto" required><?php
            echo htmlspecialchars($texto);
        ?></textarea>

        <br><br>

        <button type="submit" name="editar">
            Guardar alterações
        </button>

    </form>

    <br>

    <a href="gerenciar.php">Voltar</a>

</body>

</html>