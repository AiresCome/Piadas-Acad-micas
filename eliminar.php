<?php
require_once "config/conexao.php";

$id = $_GET["id"];

$sql = "DELETE FROM piadas WHERE id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

echo "Piada eliminada com sucesso!";

?>