<?php
require_once "config/conexao.php";

$sql = "SELECT * FROM niveis";
$stmt = $pdo->query($sql);
$niveis = $stmt->fetchAll();

$areas = [];
$nivel_id = null;
$mostrarAreas = false;
$mensagem = "";

//Escolher o nível
if (isset($_POST["continuar"])) {

    $nivel_id = $_POST["nivel_id"];

    $sql = "SELECT * FROM areas WHERE nivel_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nivel_id]);

    $areas = $stmt->fetchAll();

    $mostrarAreas = true;
}

//Adicionar a piada

if (isset($_POST["adicionar"])) {
    
    $area_id = $_POST["area_id"];
    $texto = trim($_POST["texto"]);

    $sql = "INSERT INTO piadas (area_id, texto) VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$area_id, $texto]);

    $mensagem = "Piada adicionada com sucesso!";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Piada</title>
</head>

<body>
   
    <h1>Espaço para adicionar as piadas </h1>    

    <?php echo $mensagem; ?> 

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

            <input type="hidden" name="nivel_id"
                    value="<?php echo $nivel_id; ?>">
                
            <label>Área:</label>

                <select name="area_id">

                    <?php foreach ($areas as $area) { ?>

                        <option value="<?php echo $area["id"]; ?>">
                            <?php echo $area["nome"]; ?>
                        </option>
                        
                    <?php } ?>

                </select>

                <br> <br>

                <label>Piada:</label>

                <br>

                <textarea name="texto"></textarea>

                <br></br>

                <button type="submit" name="adicionar">
                    Adicionar
                </button>
        </form>
        
        
        <?php } ?>

</body>
</html>

