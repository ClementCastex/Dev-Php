
    <?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_project'])) {
        // Handle project uploads
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

        // Additional checks...

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $title_ppro = $_POST['title_ppro'];
                $description_ppro = $_POST['description_ppro'];
                $date_ppro = date('Y-m-d');
                $creator_ppro = 'Your Name';

                $sql = "INSERT INTO projets_pro (image_ppro, title_ppro, description_ppro, date_ppro, creator_ppro) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $target_file, $title_ppro, $description_ppro, $date_ppro, $creator_ppro);

                if(!$stmt->execute()){
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (isset($_POST['submit_comment'])) {
        // Handle comments
        $project_id = $_POST['project_id'];
        $comment_text = $_POST['texte_commentaire_pro'];

        $sql = "INSERT INTO commentaires_pro (id_projet_pro, texte_commentaire_pro) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $project_id, $comment_text);

        if (!$stmt->execute()) {
            echo "Error adding comment: " . $conn->error;
        } else {
            echo "Comment added successfully!";
        }
    }
}


if (isset($row['id_ppro'])) {
    $project_id = $row['id_ppro'];
    // Continue processing
} else {
    // Handle the error, e.g., log it or display a message
    error_log('id_ppro is not set in the row.');
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
            // Handle project upload
        }
    
        if (isset($_POST['project_id']) && isset($_POST['texte_commentaire_pro'])) {
            $project_id = $_POST['project_id'];
            $comment_text = $_POST['texte_commentaire_pro'];
            // Rest of the comment handling code
        }
    }
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets Professionnels</title>
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
    <h1>Mes Projets Professionnels</h1>
    <p>Dans cette rubrique, vous découvrirez mes <strong>Projets Professionnels</strong>, incluant des projets réalisés lors des cours de la Normandie Web School. Chaque projet est accompagné d’une description incluant les <strong>logiciels utilisés</strong> et les <strong>dates de création</strong>.</p>
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
                            <input type="text" name="title_ppro" id="title_ppro">
                            </div>
                        <div id="i-descrip">
                            <p>Description :</p>
                            <textarea name="description_ppro" id="description_ppro"></textarea>
                        </div>  
                        <input type="submit" value="Poster ton Projet" name="submit_project" class="btn btn-white btn-animate">
                    </form>
                </div>
            </div>
        </div>
        <div id="Projets">
<?php
$sql = "SELECT * FROM projets_pro";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $modalTarget = 'projectInfoModal-' . $row['id_ppro'];
?>
<?php
$sql = "SELECT * FROM projets_pro";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Utilisez l'ID du projet pour créer un ID de modal unique
        $uniqueModalId = "projectInfoModal-" . $row['id_ppro'];
?>
        <div class="projet" style="display: flex; align-items: flex-start;">
            <div class="img-left" style="flex: 2;">
                <img class="P-img" src="<?php echo htmlspecialchars($row["image_ppro"]); ?>" alt="Projet :<?php echo htmlspecialchars($row["title_ppro"]); ?>">
            </div>
            <div class="text_right" style="flex: 2; padding-left: 20px;">
                <h2 class="P-titre"><?php echo htmlspecialchars($row["title_ppro"]); ?></h2>
                <p class="P-descrip"><?php echo htmlspecialchars($row["description_ppro"]); ?></p>
                <button type="button" class="btn-projet" data-toggle="modal" data-target="#<?php echo $uniqueModalId; ?>">
                En connaître plus sur le projet
                </button>
                <div id="<?php echo $uniqueModalId; ?>" class="modal">
                    <div class="modal-content-projet">
                        <div id="projets-content">
                            <div class="modal-img">
                                <img class="M-img" src="<?php echo htmlspecialchars($row["image_ppro"]); ?>" alt="Projet :<?php echo htmlspecialchars($row["title_ppro"]); ?>">
                            </div>
                            <div class="modal-descrip">
                                <p class="M-descrip"><?php echo htmlspecialchars($row["description_ppro"]); ?></p>
                            </div>
                        </div>
                        <div class="modal-com">
                            <div class="sec-com">
                            <?php
                                $comment_sql = "SELECT texte_commentaire_pro FROM commentaires_pro WHERE id_projet_pro = ?";
                                $comment_stmt = $conn->prepare($comment_sql);
                                $comment_stmt->bind_param("i", $row["id_ppro"]);
                                $comment_stmt->execute();
                                $comment_result = $comment_stmt->get_result();

                                if ($comment_result->num_rows > 0) {
                                    while ($comment_row = $comment_result->fetch_assoc()) {
                                        echo "<p>" . htmlspecialchars($comment_row['texte_commentaire_pro']) . "</p>";
                                    }
                                } else {
                                    echo "<p>No comments yet.</p>";
                                }
                            ?>
                            </div>
                            <form class="inp-com" method="post" action="projets-professionnels.php">
                                <input type="hidden" name="project_id" value="<?php echo $row['id_ppro']; ?>">
                                <p>Laissez un Commentaire:</p>
                                <textarea name="texte_commentaire_pro" id="texte_commentaire_pro"></textarea>
                                <input type="submit" value="Submit" name="submit_comment">
                            </form>
                        </div>
                    </div>  
                </div>
                <div class="detail">
                    <p class="date"><?php echo htmlspecialchars($row["date_ppro"]); ?></p>
                    <p class="creator"><?php echo htmlspecialchars($row["creator_ppro"]); ?></p>
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