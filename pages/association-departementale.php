<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <title>VMEH - NOS ASSOCIATIONS DÉPARTEMENTALES</title>
</head>
<body>
<?php require_once "./header.php" ?>
<main>

    <section class="banniere">
        <h1><strong>Nos associations départementales</strong></h1>
    </section>
    <section class="intro">
        <div class="intro-text">
            <p>Retrouvez la VMEH dans vos départements de Métropole et d’outre-mer.</p>
            <p> méthodes via la barre de recherche ci-dessous OU la carte.</p>
        </div>

    </section>

    <section class="map-interactif">
        <h1>Sélectionner votre département</h1>
        <div class="map-interactif-containt">
            <div id="map"></div>
            <div id="recherche-list">

                <input
                    type="search"
                    id="recherche"
                    name="name"
                    required
                    minlength="0"
                    maxlength="25"
                    size="15"
                    placeholder="Recherche . . ."
                />
                <ul id="liste-departements"></ul>



            </div>
        </div>


    </section>

    <!--   cacher au debut puis contenant les info de l'agence pares click sur la carte-->


    <section class="grille cacher">
        <div class="cacher" id="nomDepartement"></div>
        <div class="grille-containt">
            <article id="articlePresident">
                <h1>Présidence</h1>
                <p id="presidence"></p>
                <p><strong class="labelDepartement labelPresident">Courriel : </strong> <span id="courriel" class="labelPresident"></span></p>
                <p><strong class="labelDepartement labelPresident">Tél. : </strong><span id="tel" class="labelPresident"></span></p>
            </article>

            <article>
                <h1>Composition du bureau</h1>
                <p id="Bureau"></p>
            </article>

            <article>
                <h1>Section local</h1>
                <div id="Section local"></div>
            </article>

            <article id="article_actu">
                <h1>Dernières actualités</h1>
                <div id="actu_texte"></div>
                <div id="carrousel_actu" class="carousel slide cacher" data-bs-ride="carousel">
                    <div class="carousel-inner" id="carouselInner"></div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_actu" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carrousel_actu" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </article>
        </div>
    </section>
    <!-- fini de la section cacher-->
</main>
<?php require_once "./footer.php" ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
<script src="../assets/js/map.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // 🔍 on cherche l'url pour voir si il y a ?agence= dans l’URL
        const agence = new URLSearchParams(window.location.search).get("agence");

        // Si une variable agence est dans l'url sa veut dire qu'on doit l'afficher
        if (agence) {
            afficherAgence(decodeURIComponent(agence));
        }
    });
</script>
</body>
</html>
