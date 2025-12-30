<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <title>VMEH</title>
</head>
<body>
<?php require_once "public/header.php" ?>

<main>
    <article>
        <section class="presentation">
            <div class="presentation_container">
                <div class="presentation-texte">
                    <h1>Qui sommes-nous ? </h1>
                    <p>
                        Créé en 1634 à l’Hôtel-Dieu à Paris, le mouvement VMEH est l’héritier des valeurs séculaires portées depuis sa création
                        et possède un ADN singulier qui fait de lui
                        <strong>un acteur engagé et unique dans la lutte contre l’isolement des personnes hospitalisées</strong>
                        (MCO, SSR, longs séjours, maisons de retraite ou établissements pour personnes handicapées).
                    </p>
                    <p>
                        Le mouvement VMEH, dont le siège est à Paris au sein de la collégiale de l’AP-HP, est composé d’une Fédération Nationale et de
                        <strong>80 associations départementales</strong>
                        en métropole et dans les départements d’outre-mer.<br>
                        Il bénéficie d’une grande expérience de la visite des malades, des hôpitaux français et des résidents dans les Ehpad.
                    </p>
                    <p>
                        VMEH réunit, à ce jour près de
                        <strong> 4000 visiteurs</strong> au sein d’environ <strong>1 000 établissements</strong>
                        sanitaires et médico-sociaux. Ils y consacrent plus d’
                        <strong>un million d’heures à l’écoute</strong>,
                        aux visites hospitalières, animations en Ehpad.
                    </p>
                    <p>
                        L’action du mouvement, entièrement bénévole et apolitique, permet aux personnes isolées en cours,
                        moyen et long séjour de recevoir la visite de bénévoles, en partenariat avec la direction des établissements et des équipes de soins.
                    </p>
                    <p>
                        La Fédération Nationale VMEH est reconnue d’utilité publique (décret du 9 janvier 2007, N° 2020RN0012).
                    </p>
                </div>

            </div>

        </section>
        <section  class="main-carrousel d-flex flex-column justify-content-center align-items-center" >
            <div id="carrousel_accueil" class="carousel slide">
                <h1>Actualité</h1>
                <div class="carousel-inner">
                    <a href="https://www.vmeh.fr/vmeh42-votez-pour-la-video-de-charlotte-jusquau-11-novembre-2025/" target="_blank" class="carousel-link">
                        <div class="carousel-item active">
                            <img src="assets/image/accueil/VMEH42.webp" class="d-block w-100" alt="...">
                            <div class="carousel-caption bottom-0 d-none d-md-block">
                                <h3>VMEH42</h3>
                                <p class="fs-5 d-none d-lg-block">Votez pour la vidéo de Charlotte jusqu’au 11 novembre 2025</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://www.vmeh.fr/vmeh-retour-du-congres-2025/" target="_blank" class="carousel-link">
                        <div class="carousel-item">
                            <img src="assets/image/accueil/ag_2025.webp" class="d-block w-100" alt="...">
                            <div class="carousel-caption bottom-0 d-none d-md-block">
                                <h3>VMEH : Retour du congrès 2025</h3>
                                <p class="fs-5 d-none d-lg-block">Les échanges autours des sujets de la communication, des maladies (psycho-)gériatriques grâce aux interventions de médecins des HCL – Hospices Civils de Lyon, ou du droit des associations animé par une avocate lyonnaise ont été riches d’enseignements !</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://www.vmeh.fr/santa-monica" target="_blank" class="carousel-link">
                        <div class="carousel-item active">
                            <img src="assets/image/carrousel/region/Santa_Monica.webp" class="d-block w-100" alt="...">
                            <div class="carousel-caption bottom-0 d-none d-md-block">
                                <h3>Santa Monica</h3>
                                <p class="fs-5 d-none d-lg-block">La Directrice de l'Ehpad Santa Monica, Mme L'Hermite, nous a réservé un accueil particulièrement chaleureux et instructif lors de notre visite à la section très dynamique de Civray.</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://www.vmeh.fr/vmeh-congres-les-24-et-25-septembre-2025/" target="_blank" class="carousel-link">
                        <div class="carousel-item">
                            <img src="assets/image/accueil/congres_2025-1.webp" class="d-block w-100" alt="...">
                            <div class="carousel-caption bottom-0 d-none d-md-block">
                                <h3>VMEH : Congrès les 24 et 25 septembre 2025</h3>
                                <p class="fs-5 d-none d-lg-block">Cette année le congrès, habituellement organisé à Paris, a été décentralisé à Lyon, au sein du Domaine Lyon Saint Joseph.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_accueil" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carrousel_accueil" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                <a href="public/carrousel.html" class="btn-voir-articles">Voir toutes les actualités</a>
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
        <section class="chiffe-cle">
            <div class="bande">
                <h1>Nos chiffres clés</h1>
                <div class="bande-box">
                    <div class="bande-contenu">
                        <h3>4 siècles</h3>
                        <p>D'EXISTENCE</p>
                    </div>
                    <div class="bande-contenu">
                        <h3>3500</h3>
                        <p>VISITEURS BENEVOLES</p>
                    </div>
                    <div class="bande-contenu">
                        <h3>75</h3>
                        <p>ASSOCIATIONS DEPARTEMENTALES</p>
                    </div>
                    <div class="bande-contenu">
                        <h3>1000</h3>
                        <p>ETABLISSEMENTS SANITAIRES ET MEDICO-SOCIAUX</p>
                    </div>
                    <div class="bande-contenu">
                        <h3>+1000000</h3>
                        <p>DE PERSONNES VISITEES CHAQUE ANNEE</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="partenaire">
            <h1>Nos partenaires</h1>
            <div class="partenaire-contenu">
                <div class="partenaire-box">
                    <a href="https://www.mgen.fr/"> <img src="assets/image/partenaire/MGEN.png" alt="MGEN" title="MGEN"> </a>
                </div>
                <div class="partenaire-box">
                    <a href="https://www.acceo-tadeo.fr"> <img src="assets/image/partenaire/logo_acceo_tadeo_verticale.png" alt="Acceo Tadeo" title="Acceo Tadeo"> </a>
                </div>
                <div class="partenaire-box">
                    <a href="https://banquefrancaisemutualiste.fr"> <img src="assets/image/partenaire/banque_francaise_mutualiste.png" alt="Banque Brançaise Butualisete" title="Banque Brançaise Butualisete"> </a>
                </div>
                <div class="partenaire-box">
                    <a  href="https://espritretraite.fr"> <img src="assets/image/partenaire/ESPRIT-RETRAITE-logo.png" alt="Esprit Retraire" title="Esprit Retraire"> </a>
                </div>
                <div class="partenaire-box">
                    <a href="https://www.fondationpartageetvie.org"> <img src="assets/image/partenaire/Fondation-Partage-et-vie.png" alt="Fondation Partage & Vie" title="Fondation Partage & Vie"> </a>
                </div>
                <div class="partenaire-box">
                    <a href="https://www.france-assos-sante.org"> <img src="assets/image/partenaire/LOGO-ILE-DE-FRANCE.png" alt="France Assos Santé" title="France Assos Santé"> </a>
                </div>
                <div class="partenaire-box">
                    <a href="https://www.fhf.fr"> <img src="assets/image/partenaire/FHF_Logo-RVB.png" alt="Fédération Hospitalière de France (FHF)" title="Fédération Hospitalière de France (FHF)"> </a>
                </div>
                <div class="partenaire-box">
                    <a href="https://experiencepatient.fr"> <img src="assets/image/partenaire/logo_Institut-francais-experience-patient.png" alt="Institut Français Expérience Patient" title="Institut Français Expérience Patient"></a>
                </div>

            </div>
            <div class="partenaire-bouton">
                <a href="https://www.vmeh.fr/nous-soutenir/#vmeh_partenaires">Devenir partenaire</a>
            </div>

        </section>
    </article>
</main>

<?php require_once "./public/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
<script src="assets/js/map.js"></script>

</body>
</html>
