<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }


    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }


    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $title_ppro = $_POST['title_ppro'];
            $description_ppro = $_POST['description_ppro'];
            $date_ppro = date('Y-m-d');
            $creator_ppro = 'Your Name';  

            $sql = "INSERT INTO projets_perso (image_ppro, title_ppro, description_ppro, date_ppro, creator_ppro)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $target_file, $title_ppro, $description_ppro, $date_ppro, $creator_ppro);

            if($stmt->execute()){
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
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
    <p>Dans cette rubrique, vous découvrirez mes Projets Professionnels, vous y trouverez des Projets réalisés lors des cours de la Normandie Web School. Ils seront accompagnés d’une description incluant les logiciels utilisés et les dates de création.</p>
        <button type="button" id="openModalButton" class="button" data-toggle="modal" data-target="#myModal">
    Ajoutez votre Projet
</button>

<!-- partie caché  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
                    <input type="submit" value="Poster ton Projet" name="submit" class="btn btn-white btn-animate">
                </form>
            </div>
        </div>
    </div>
</div>
<div id="Projets">

<?php
$sql = "SELECT * FROM projets_pro";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div class="project" style="display: flex; align-items: flex-start;">
            <div class="img-left" style="flex: 2;">
                <img class="P-img" src="<?php echo htmlspecialchars($row["image_ppro"]); ?>" alt="Projet :<?php echo htmlspecialchars($row["title_ppro"]); ?>">
            </div>
            <div class="text_right" style="flex: 2; padding-left: 20px;">
                <h2 class="P-titre"><?php echo htmlspecialchars($row["title_ppro"]); ?></h2>
                <p class="P-descrip"><?php echo htmlspecialchars($row["description_ppro"]); ?></p>
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
        <?php   include 'footer.php'; ?>
</div>

<script>
$(document).ready(function(){
    $("#openModalButton").click(function(){
    $("#myModal").modal('toggle');
    });
$(".close").click(function(){
    $("#myModal").modal('hide');
});
});

</script>


   


</body>

</html>
