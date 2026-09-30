<?php
require_once "config/conexao.php";

$sql = "SELECT * FROM piadas";

$stmt = $pdo->query($sql);

$piadas = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Piadas</title>
</head>

<body>

    <h1>Gerenciar Piadas</h1>

<?php 

    foreach($piadas as $piada){?>
    
    <p>
        <strong><?php echo $piada["categoria"]; ?></strong>
    </p>

    <p>
        <?php echo $piada["texto"]; ?>
    </p>
    
    <a href="editar.php?id=<?php echo $piada["id"]; ?>">
        Editar
    </a>

    <a href="eliminar.php?id=<?php echo $piada["id"]; ?>">
        Eliminar
    </a>

    <hr>

    <?php } ?>

</body>

</html>l