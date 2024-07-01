<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_project'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $title_pperso = $_POST['title_pperso'];
                $description_pperso = $_POST['description_pperso'];
                $date_pperso = date('Y-m-d');
                $creator_pperso = 'Your Name';

                $sql = "INSERT INTO projets_perso (image_pperso, title_pperso, description_pperso, date_pperso, creator_pperso) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $target_file, $title_pperso, $description_pperso, $date_pperso, $creator_pperso);

                if(!$stmt->execute()){
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (isset($_POST['submit_comment'])) {
        $project_id = $_POST['project_id'];
        $comment_text = $_POST['texte_commentaire_perso'];

        $sql = "INSERT INTO commentaires_perso (id_projet_perso, texte_commentaire_perso) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $project_id, $comment_text);

        if (!$stmt->execute()) {
            echo "Error adding comment: " . $conn->error;
        } else {
            echo "Comment added successfully!";
        }
    }
}if (isset($row['id_pperso'])) {
    $project_id = $row['id_pperso'];
} else {
    error_log('id_pperso is not set in the row.');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
        }
    
        if (isset($_POST['project_id']) && isset($_POST['texte_commentaire_perso'])) {
            $project_id = $_POST['project_id'];
            $comment_text = $_POST['texte_commentaire_perso'];
        }
    }
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets Personnels</title>
    <link rel="stylesheet" href="style-projets.css">
    <link rel="icon" type="image/svg+xml" href="images/Logo FavIcon.png">
    <link rel="icon" type="image/png" href="images/Logo FavIcon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<?php   include 'sidebar.php'; ?>
    <div class="main-content">
        <h1>Mes Projets Personnels</h1>
        <p>Dans cette rubrique, vous découvrirez mes <strong>Projets Personnels</strong>. Vous y trouverez des dessins réalisés lors de cours extrascolaires ou de manière indépendante. Ils seront accompagnés d’une description incluant les <strong>logiciels utilisés</strong> et les <strong>dates de création</strong>.</p>
        <button type="button" id="openModalButton" class="button" data-toggle="modal" data-target="#myModal">
        Ajoutez votre Projet
        </button>

        <!-- partie caché  -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Ajouter un Projet</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class='bx bx-chevrons-right'></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <div id="i-image"><p>Sélectionnez une image :</p>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                        <div id="i-titre">
                            <p>Titre :</p>
                            <input type="text" name="title_pperso" id="title_pperso">
                            </div>
                        <div id="i-descrip">
                            <p>Description :</p>
                            <textarea name="description_pperso" id="description_pperso"></textarea>
                        </div>  
                        <input type="submit" value="Poster ton Projet" name="submit_project" class="btn btn-white btn-animate">
                    </form>
                </div>
            </div>
        </div>
        <div id="Projets">
<?php
$sql = "SELECT * FROM projets_perso";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $modalTarget = 'projectInfoModal-' . $row['id_pperso'];
?>
<?php
$sql = "SELECT * FROM projets_perso";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $uniqueModalId = "projectInfoModal-" . $row['id_pperso'];
?>
        <div class="projet" style="display: flex; align-items: flex-start;">
            <div class="img-left" style="flex: 2;">
                <img class="P-img" src="<?php echo htmlspecialchars($row["image_pperso"]); ?>" alt="Projet :<?php echo htmlspecialchars($row["title_pperso"]); ?>">
            </div>
            <div class="text_right" style="flex: 2; padding-left: 20px;">
                <h2 class="P-titre"><?php echo htmlspecialchars($row["title_pperso"]); ?></h2>
                <p class="P-descrip"><?php echo htmlspecialchars($row["description_pperso"]); ?></p>
                <button type="button" class="btn-projet" data-toggle="modal" data-target="#<?php echo $uniqueModalId; ?>">
                En connaître plus sur le projet
                </button>
                <div id="<?php echo $uniqueModalId; ?>" class="modal">
                    <div class="modal-content-projet">
                        <div id="projets-content">
                            <div class="modal-img">
                                <img class="M-img" src="<?php echo htmlspecialchars($row["image_pperso"]); ?>" alt="Projet :<?php echo htmlspecialchars($row["title_pperso"]); ?>">
                            </div>
                            <div class="modal-descrip">
                                <p class="M-descrip"><?php echo htmlspecialchars($row["description_pperso"]); ?></p>
                            </div>
                        </div>
                        <div class="modal-com">
                            <div class="sec-com">
                            <?php
                                $comment_sql = "SELECT texte_commentaire_perso FROM commentaires_perso WHERE id_projet_perso = ?";
                                $comment_stmt = $conn->prepare($comment_sql);
                                $comment_stmt->bind_param("i", $row["id_pperso"]);
                                $comment_stmt->execute();
                                $comment_result = $comment_stmt->get_result();

                                if ($comment_result->num_rows > 0) {
                                    while ($comment_row = $comment_result->fetch_assoc()) {
                                        echo "<p>" . htmlspecialchars($comment_row['texte_commentaire_perso']) . "</p>";
                                    }
                                } else {
                                    echo "<p>No comments yet.</p>";
                                }
                            ?>
                            </div>
                            <form class="inp-com" method="post" action="projets-personnels.php">
                                <input type="hidden" name="project_id" value="<?php echo $row['id_pperso']; ?>">
                                <p>Laissez un Commentaire:</p>
                                <textarea name="texte_commentaire_perso" id="texte_commentaire_perso"></textarea>
                                <input type="submit" value="Submit" name="submit_comment">
                            </form>
                        </div>
                    </div>  
                </div>
                <div class="detail">
                    <p class="date"><?php echo htmlspecialchars($row["date_pperso"]); ?></p>
                    <p class="creator"><?php echo htmlspecialchars($row["creator_pperso"]); ?></p>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "Aucun projet";
}
?>

<?php
    }
} else {
    echo "Aucun projet";
}
?> 
        <?php   include 'footer.php'; ?>

</div>

<script src="script.js"></script>
</body>

</html>