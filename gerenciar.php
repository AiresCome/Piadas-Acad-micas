<?php

require_once "config/conexao.php";

$sql = "SELECT piadas.id, piadas.texto,
               areas.nome AS area,
               niveis.nome AS nivel
        FROM piadas
        INNER JOIN areas
            ON piadas.area_id = areas.id
        INNER JOIN niveis
            ON areas.nivel_id = niveis.id
        ORDER BY piadas.id DESC";

$stmt = $pdo->query($sql);
$piadas = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Gerenciar Piadas</title>
</head>

<body>

    <h1>Gerenciar Piadas</h1>

    <?php if (count($piadas) > 0) { ?>

        <?php foreach ($piadas as $piada) { ?>

            <h3>
                <?php echo htmlspecialchars($piada["nivel"]); ?>
                -
                <?php echo htmlspecialchars($piada["area"]); ?>
            </h3>

            <p>
                <?php echo htmlspecialchars($piada["texto"]); ?>
            </p>

            <a href="editar.php?id=<?php echo $piada["id"]; ?>">
                Editar
            </a>

            |

            <a href="eliminar.php?id=<?php echo $piada["id"]; ?>">
                Eliminar
            </a>

            <hr>

        <?php } ?>

    <?php } else { ?>

        <p>Ainda não existem piadas registadas.</p>

    <?php } ?>

    <a href="index.php">Voltar ao início</a>

</body>

</html>