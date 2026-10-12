<?php

require_once "config/conexao.php";

$sql = "SELECT * FROM niveis";
$stmt = $pdo->query($sql);
$niveis = $stmt->fetchAll();

$areas = [];
$piada = null;
$nivel_id = null;
$area_id = null;
$mostrarAreas = false;
$semPiadas = false;


// Escolher nível e buscar áreas
if (isset($_POST["continuar"]) || isset($_POST["ver"])) {

    $nivel_id = $_POST["nivel_id"];

    $sql = "SELECT * FROM areas WHERE nivel_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nivel_id]);

    $areas = $stmt->fetchAll();

    $mostrarAreas = true;
}


// Buscar uma piada aleatória
if (isset($_POST["ver"])) {

    $area_id = $_POST["area_id"];

    $sql = "SELECT piadas.texto
            FROM piadas
            INNER JOIN areas ON piadas.area_id = areas.id
            WHERE piadas.area_id = ?
            AND areas.nivel_id = ?
            ORDER BY RAND()
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$area_id, $nivel_id]);

    $piada = $stmt->fetch();

    if (!$piada) {
        $semPiadas = true;
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Ver Piada</title>
</head>

<body>

    <h1>Piadas Académicas</h1>

    <?php if (!$mostrarAreas) { ?>

        <form method="POST">

            <label>Nível académico:</label>

            <select name="nivel_id">

                <?php foreach ($niveis as $nivel) { ?>

                    <option value="<?php echo $nivel["id"]; ?>">
                        <?php echo $nivel["nome"]; ?>
                    </option>

                <?php } ?>

            </select>

            <br><br>

            <button type="submit" name="continuar">
                Continuar
            </button>

        </form>

    <?php } else { ?>

        <form method="POST">

            <input type="hidden"
                   name="nivel_id"
                   value="<?php echo $nivel_id; ?>">

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
                        <?php echo $area["nome"]; ?>
                    </option>

                <?php } ?>

            </select>

            <br><br>

            <button type="submit" name="ver">
                Ver Piada
            </button>

        </form>

    <?php } ?>


    <?php if ($piada) { ?>

        <h2>😂 A tua piada</h2>

        <p>
            <?php echo htmlspecialchars($piada["texto"]); ?>
        </p>

    <?php } elseif ($semPiadas) { ?>

        <p>Ainda não existem piadas nesta área.</p>

    <?php } ?>

</body>

</html>