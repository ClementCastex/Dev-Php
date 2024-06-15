<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Clément Castex</title>
    <link rel="icon" type="image/svg+xml" href="images/Logo Icon Off V2.png">
    <link rel="icon" type="image/png" href="images/Logo Icon Off V2.png">
    <link rel="stylesheet" href="style-sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="sidebar"> 
        <div class="top">
            <div class="logo">
                <a href="index.php"><img id="img_header" src="images/Logo Icon Off V2.png" alt="Bannière header" ></a>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <div class="user">
            <img src="images/Profil-Picture.webp" alt="profil image" id="pp">
            <p class="bold-sb">Castex.C</p>
            <p class="p-sb">Admin</p>
        </div>
        <ul>
            <li> <a href="profil.php">
                <i class='bx bx-book-open'></i>
                <span class="nav-item" >A Propos</span>
            </a>
            <span class="tooltips">A Propos</span>
            </li>
            <li> <a href="projets-professionnels.php">
            <i class='bx bxs-briefcase' ></i>
                <span class="nav-item" >Projet Pro</span>
            </a>
            <span class="tooltips">Projet Pro</span>
            </li>
            <li> <a href="projets-personnels.php">
            <i class='bx bx-paint' ></i>
                <span class="nav-item" >Projets Perso</span>
            </a>
            <span class="tooltips">Projets Perso</span>
            </li>
            <li> <a href="charte-graphique.php">
            <i class='bx bxs-collection' ></i>
                <span class="nav-item" >Charte Graphique </span>
            </a>
            <span class="tooltips">Charte Graphique</span>
            </li>
            <li> <a href="CV.php">
            <i class='bx bx-file' ></i>
                <span class="nav-item" >Cv</span>
            </a>
            <span class="tooltips">CV</span>
            </li>
        </ul>
    </div>
    <a href="index.php"><img id="icon-symb" src="images/Logo Icon Off V2.png" alt="mon logo icon" ></a>
</body>
<script>
    let btn = document.querySelector('#btn');
    let sidebar =document.querySelector('.sidebar');

    btn.onclick = function(){
        sidebar.classList.toggle('active');
    };

</script>
</html>