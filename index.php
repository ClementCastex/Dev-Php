<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Clément Castex</title>
    <link rel="icon" type="image/svg+xml" href="images/Logo FavIcon.png">
    <link rel="icon" type="image/png" href="images/Logo FavIcon.png">
    <link rel="stylesheet" href="style-index.css">
    <link rel="stylesheet" href="style-sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php   include 'sidebar.php'; ?>
    <div class="main-content">
        <div class="Intro">
            <div class="I-text">
                <h1>Je suis Clément</h1>
                <h2>Étudiant dans le Développement Web</h2>
                <p id=" presentation">Actuellement en première année de la formation Chef de Projet Digital, je suis particulièrement attiré par la communication graphique. J'ai réalisé des dessins numériques sur Krita ainsi que des dessins sur papier dans le cadre d'activités extra-scolaires pendant un an. Créatif, imaginatif et curieux, j'ai une forte volonté de découvrir le développement web, raison pour laquelle j'ai entrepris la formation à la Normandie Web School.</p>
                <div class="reseaux">
                    <div class="Intro-btn">
                        <button onclick="window.open('profil.php', '_self');" class="button">
                            <span class="text" >Me Découvrir </span>
                            <span class="shimmer"></span>
                        </button>
                    </div>
                    </div>
                    <div >
                        <a class="icon icon-fill fond-img" href="https://github.com/ClementCastex" target="_blank">
                            <i class='bx bxl-github' ></i>
                        </a>
                        <a class="icon icon-fill fond-img" href="https://www.linkedin.com/in/clément-castex/" target="_blank">
                            <i class='bx bxl-linkedin' ></i>
                        </a>
                        <a class="icon icon-fill " href="https://www.instagram.com/clementcastex/" target="_blank">
                            <i class='bx bxl-instagram'></i>
                        </a>
                        <a class="icon icon-fill fond-img" href="mailto:ccastex@normandiewebschool.fr" target="_blank">
                            <i class='bx bxl-gmail' ></i>
                        </a>
                    </div>
            </div>
            <div class="I-image">
                <img src="images/Profil Picture.jpg" alt="Photo de Profil">
            </div>
        </div>
        <div id="bottom-body">
            <div id="top">
                <div id="top-left">
                    <h2>Explorez mes Travaux </h2>
                    <p>
                    Dans cette rubrique, vous découvrirez mes projets personnels et professionnels, réalisés dans différentes situations et accompagnés d'une description incluant les logiciels utilisés ainsi que les dates de création.
                    </p>
                    <div id="button-double">
                        <div id="bd-left">
                        <button class="btnbt simple" onclick="window.location.href = 'projets-personnels.php';">Projets Perso</button>
                        </div>
                        <div id="bd-right">
                        <button class="btnbt simple" onclick="window.location.href = 'projets-professionnels.php';">Projets Pro</button>
                        </div>
                    </div>
                </div>
                <div id="top-right">
                    <h2>Page de présentation</h2>
                    <p>
                    Dans cette rubrique, vous allez découvrir une présentation de moi-même plus détaillée. Vous pourrez comprendre pourquoi j'ai choisi cette voie, ainsi que découvrir mes passions et loisirs.
                    </p>
                    <div id="Profil">
                    <button  class="btnbt simple" onclick="window.location.href = 'profil.php';">Ma Description</button>
                    </div>
                </div>
            </div>
            <div id="bottom">
                <div id="bottom-left">
                    <h2>Charte graphique du site</h2>
                    <p>
                    Dans cette section, vous découvrirez les éléments graphiques de mon site, comprenant les couleurs, la typographie et le logo
                    </p>
                    <div id="CharteG">
                    <button  class="btnbt simple" onclick="window.location.href = 'charte-graphique.php';">Ma Charte Graphique</button>
                    </div>
                </div>
                <div id="bottom-right">
                    <h2>CV en Htlm et Css</h2>
                    <p>
                    Dans cette rubrique, vous pourrez consulter mon CV en HTML/CSS, ainsi que le code qui le constitue et un lien pour télécharger la version la plus récente de mon CV.
                    </p>
                    <div id="CV">
                    <button  class="btnbt simple" onclick="window.location.href = 'CV.php';">Mon CV</button>
                    </div>
                </div>
            </div>
        </div>
        <?php   include 'footer.php'; ?>
    </div>
</body>

</html>