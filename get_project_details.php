<?php

include 'db_connect.php';
$projectId = $_POST['id'];
$sql = "SELECT * FROM projets_perso WHERE id_pperso = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $projectId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
// Générer l'HTML avec les données du projet
echo '<div class="modal-img"><img class="M-img" src="'.htmlspecialchars($row["image_pperso"]).'" alt="Projet :'.htmlspecialchars($row["title_pperso"]).'"></div>';
echo '<div class="modal-descrip"><p class="M-descrip">'.htmlspecialchars($row["description_pperso"]).'</p></div>';
// Ajouter plus de détails si nécessaire
