<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X</title>

    <link rel="stylesheet" href="bootstrap-5.0.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <div class="rond">
            <img src="img/LOGO.png" alt="Logo">
        </div>
        <nav class="navbar">
            <div class="menu">
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Guides et Tutoriels</a></li>
                    <li><a href="#">Forum</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Ressources</a></li>
                </ul>
            </div>

            <div class="search-container">
                <input type="text" placeholder="Rechercher" class="search-bar">
            </div>

        </nav>
    </header>

    <section class="intro-text">
        <div class="container mt-5">
            <h1 class="text-center">Bienvenue sur notre guide</h1>
            <p class="text-center">
                Découvrez les différentes étapes pour configurer vos paramètres en toute sécurité.
            </p>
        </div>
    </section>

    <!-- Section contenant le slider et les conseils (tips) -->
    <div class="container mt-5">
        <div id="sliderContainer" class="slider-container">

            <?php
            // Inclusion du fichier de configuration pour la connexion à la base de données
            include 'php/config.php';

            // Récupérer les deux premiers tips de la base de données
            try {
                $stmt = $pdo->query("SELECT * FROM tips WHERE isactive = 1 LIMIT 2");
                $tips = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($tips) {
                    foreach ($tips as $index => $tip) {
                        echo '<div class="slider-item ' . ($index === 0 ? 'active-slide' : '') . '">';
                        echo '<img src="img/1etape.jpg" alt="Image 1" class="w-100">'; // Change l'image si besoin
                        echo '<div class="tips-box">';
                        echo '<p>' . htmlspecialchars($tip['content']) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucun tip trouvé dans la base de données.</p>';
                }
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
            ?>

            <div class="slider-item">
                <img src="img/audienceetid.png" alt="Image 2" class="w-100">
                <div class="tips-box">
                    <p>Voir l'audience</p>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/audienceetid2.png" alt="Image 3" class="w-100">
                <div class="tips-box">
                    <p>Suivez bien chaque étape</p>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/vosposte.png" alt="Image 4" class="w-100">
                <div class="tips-box">
                    <p>Cochez bien tout ce qui est en rouge</p>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/vosposte2.png" alt="Image 5" class="w-100">
                <div class="tips-box">
                    <p>Allez sur vos posts</p>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/Contenue.png" alt="Image 6" class="w-100">
                <div class="tips-box">
                    <p>Vous allez masquer les posts</p>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/reglage.png" alt="Image 7" class="w-100">
                <div class="tips-box">
                    <p>Voir le contenu</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <div class="container">
            <p class="text-center">© 2024 Tous droits réservés - Votre site</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            let currentIndex = 0;
            const slides = $('#sliderContainer .slider-item');
            const totalSlides = slides.length;
            let isDragging = false;
            let startPositionX = 0;
            let endPositionX = 0;
            const minSwipeDistance = 30;

            // Initialiser avec le premier slide visible
            slides.hide();
            slides.eq(currentIndex).show();

            // Fonction pour afficher le slide suivant/précédent
            function showSlide(index) {
                slides.hide();
                slides.eq(index).show();
                currentIndex = index;
            }

            // Détection du début du swipe
            $('#sliderContainer').on('mousedown touchstart', function(event) {
                isDragging = true;
                startPositionX = event.type === 'touchstart' ? event.originalEvent.touches[0].clientX : event.clientX;
            });

            // Détection de la fin du swipe
            $('#sliderContainer').on('mouseup touchend', function(event) {
                if (isDragging) {
                    endPositionX = event.type === 'touchend' ? event.originalEvent.changedTouches[0].clientX : event.clientX;
                    const swipeDistance = endPositionX - startPositionX;

                    if (Math.abs(swipeDistance) > minSwipeDistance) {
                        if (swipeDistance < 0) {
                            let nextIndex = (currentIndex + 1) % totalSlides;
                            showSlide(nextIndex);
                        } else {
                            let prevIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                            showSlide(prevIndex);
                        }
                    }
                    isDragging = false;
                }
            });

            $(document).on('dragstart', function(event) {
                event.preventDefault();
            });
        });
    </script>
</body>
</html>
