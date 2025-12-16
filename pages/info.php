<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMEH - actualite</title>
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js" defer></script>
    <script src="../assets/js/script.js" defer></script>

</head>

<body>
<?php require_once "./header.php"; ?>
<main id="actualite-page" >
    <article class="info-menu" id="menu">
        <h2>Catégorie</h2>
        <div class="info-menu-categorie">
            <a href="#national" class="list-categorie">VMEH au niveau National</a>
            <a class="list-categorie" href="#region">VMEH en Region</a>
            <a class="list-categorie" href="#presse">VMEH à la Presse</a>
            <a class="list-categorie" href="#video">VMEH en Video</a>
            <a class="list-categorie" href="#portrait">Portraits de VMEH</a>
        </div>
        <h2>Dernier article</h2>
        <div class="info-menu-categorie">
            <a class="list-categorie">Pourquoi être bénévole dans l’association VMEH ?</a>
            <a class="list-categorie">VMEH36, animation de Mélanie d’Iss à l’Ehpad Les Reflets d’Argent</a>
            <a class="list-categorie">VMEH61, portrait d’Arlette Marcadé, bénévole depuis 22 ans dans l’association</a>
            <a class="list-categorie">VMEH48, Au revoir Marie-Thérèse ORLHAC</a>
            <a class="list-categorie">VMEH42, votez pour la vidéo de Charlotte jusqu’au 11 novembre 2025</a>
        </div>
    </article>



    <article>
        <div class="info-container " id="national">
            <h1>VMEH au niveau National</h1>
            <div class="info-carousel swiper">
                <ul class="card-list swiper-wrapper">
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/journee-experience-patient-2024" class="card-link">
                            <img src="../assets/image/carrousel/national/journee_experience_patient.webp" class="card-img" alt="">
                            <h3>Journée Expérience Patient 2024</h3>
                            <p class="info-text">La Fédération Nationale VMEH a participé mardi 18 juin 2024 à
                                la Journée de l’Expérience Patient, organisée par notre partenaire, l’Institut Français de
                                l’Expérience Patient (IFEP).</p>
                        </a>
                    </li>
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/la-vmeh-soutient-octobre-rose"  class="card-link">
                            <img src="../assets/image/carrousel/national/octobre_rose.webp" class="card-img" alt="">
                            <h3>La Fédération Nationale VMEH s’engage pour Octobre Rose</h3>
                            <p class="info-text">Octobre Rose, c’est le mois de sensibilisation au cancer du sein. Sensibiliser pour mieux prévenir !
                                La Fédération Nationale s’engage dans cette mobilisation nationale</p>
                        </a>
                    </li>
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/signature-du-partenariat-avec-la-fhf" class="card-link">
                            <img src="../assets/image/carrousel/national/Signature.webp" class="card-img" alt="">
                            <h3>Signature du partenariat avec la FHF</h3>
                            <p class="info-text">La Fédération Nationale VMEH a signé le 23 mai 2024 un partenariat stratégique avec la Fédération hospitalière de France (FHF) SANTEXPO 2024.</p>
                        </a>
                    </li>
                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="../assets/image/carrousel/national/vmeh_retour_ag_2025_7-400x250.webp" class="card-img" alt="">
                            <h3>VMEH : Retour du congrès 2025</h3>
                            <p class="info-text">Un congrès dans un lieu magnifique…</p>
                        </a>
                    </li>

                </ul>
                <div class="swiper-button swiper-button-prev"></div>
                <div class="swiper-button swiper-button-next"></div>
            </div>
            <a href="https://www.vmeh.fr/category/vmeh-national/" class="btn-voir-articles">Voir tous les articles</a>
        </div>
    </article>
    <article>
        <div class="info-container " id="region">
            <h1>VMEH en Region</h1>
            <div class="info-carousel swiper">
                <ul class="card-list swiper-wrapper">
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/santa-monica" class="card-link">
                            <img src="../assets/image/carrousel/region/Arcachon_Nord.webp" class="card-img" alt="">
                            <h3>Santa Monica</h3>
                            <p class="info-text">La Directrice de l'Ehpad Santa Monica, Mme L'Hermite, nous a réservé un accueil particulièrement chaleureux et instructif lors de notre visite à la section très dynamique de Civray.</p>
                        </a>
                    </li>
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/libourne-une-section-locale-tres-active" class="card-link">
                            <img src="../assets/image/carrousel/region/Libourne.webp" class="card-img" alt="">
                            <h3>Libourne: une section locale très active</h3>
                            <p class="info-text">Placée sous l’entière responsabilité d’Yveline Bouetz, la section locale de Libourne est l’exemple même d’une entité qui sait à travers les années transmettre les valeurs d’humanité de notre mouvement.</p>
                        </a>
                    </li>
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/santa-monica/" class="card-link">
                            <img src="../assets/image/carrousel/region/Santa_Monica.webp" class="card-img" alt="">
                            <h3>Santa Monica</h3>
                            <p class="info-text">La Directrice de l’Ehpad Santa Monica, Mme L’Hermite, nous a réservé un accueil particulièrement chaleureux et instructif lors de notre visite à la section très dynamique de Civray.</p>
                        </a>
                    </li>
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/vmeh-86-a-la-decouverte-de-nos-benevoles"  class="card-link">
                            <img src="../assets/image/carrousel/region/Vmeh_86.webp" class="card-img" alt="">
                            <h3>VMEH 86 : A la découverte de nos bénévoles</h3>
                            <p class="info-text">Viviane et Jean interviennent au Logis du Val de Boivre situé à Vouneuil sous Biard, charmant petit village en périphérie de Poitiers.</p>
                        </a>
                    </li>

                </ul>
                <div class="swiper-button swiper-button-prev"></div>
                <div class="swiper-button swiper-button-next"></div>
            </div>
            <a href="https://www.vmeh.fr/category/vmeh-en-region/" class="btn-voir-articles">Voir tous les articles</a>
        </div>
    </article>
    <article>
        <div class="info-container " id="presse">
            <h1>VMEH à la Presse</h1>
            <div class="info-carousel swiper">
                <ul class="card-list swiper-wrapper">
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/la-presse-locale-soutient-la-vmeh-86" class="card-link">
                            <img src="../assets/image/carrousel/presse/vmeh86.webp" class="card-img" alt="">
                            <h3>LA PRESSE LOCALE SOUTIENT LA VMEH 86</h3>

                            <p class="info-text">Ils sont visiteurs des malades en établissements hospitaliers
                                et des résidents en Ehpad. Chaque semaine, ces bénévoles offrent quelques heures de leur temps dans un geste de fraternité</p>
                        </a>
                    </li>
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/la-vmeh-de-la-chaleur-et-du-reconfort/" class="card-link">
                            <img src="../assets/image/carrousel/presse/La_Vmeh.webp" class="card-img" alt="">
                            <h3>La VMEH : de la chaleur et du réconfort</h3>
                            <p class="info-text">Découvrez l’article captivant sur la VMEH dans le magazine Seniors Actuels de décembre 2023 !</p>
                        </a>
                    </li>
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/la-vmeh-de-la-chaleur-et-du-reconfort" class="card-link">
                            <img src="../assets/image/carrousel/presse/Residence.webp" class="card-img" alt="">
                            <h3>La résidence La Houssaie de la Fondation Partage et Vie sensibilise au bénévolat</h3>
                            <p class="info-text">VMEH 77
                                est présente dans les deux établissements Partage et Vie de la Seine et Marne (77).</p>
                        </a>
                    </li>
                    <li class="card-item swiper-slide">
                        <a href="https://www.vmeh.fr/sur-le-bassin-darcachon-nord/" class="card-link">
                            <img src="../assets/image/carrousel/presse/VMEH33_Jose-Patanchon.webp" class="card-img" alt="">
                            <h3>Sur le Bassin d’Arcachon Nord</h3>
                            <p class="info-text">Un patriarche bienveillant essaime les valeurs de la VMEH sur le Bassin Nord d’Arcachon et donne toute liberté à ses bénévoles d’enrichir leur bénévolat</p>
                        </a>
                    </li>

                </ul>
                <div class="swiper-button swiper-button-prev"></div>
                <div class="swiper-button swiper-button-next"></div>
            </div>
        </div>
        <a href="https://www.vmeh.fr/category/vmeh-portraits-de-benevoles/" class="btn-voir-articles">Voir tous les articles</a>
    </article>


    <article>
        <h1>VMEH en Video</h1>
        <section class="info" id="video">

            <div class="info-item">
                <a href="https://www.vmeh.fr/vmeh-film-sur-lengagement-benevole">
                    <img src="../assets/image/carrousel/video/engagement-benevole_intro.webp" alt="image d'engagement">
                    <div class="info-text">
                        <p>VMEH : Film sur l’engagement bénévole</p>
                    </div>
                </a>

            </div>
            <div class="info-item">
                <a href="https://www.vmeh.fr/vmeh-etait-presente-a-la-journee-de-lexperience-patient-2024">
                    <img src="../assets/image/carrousel/video/Journee-experience-patient.webp" alt="image d'engagement">
                    <div class="info-text">
                        <p>VMEH était présente à la Journée de l’Expérience Patient 2024</p>
                    </div>
                </a>

            </div><div class="info-item">
                <a href="https://www.vmeh.fr/voeux-2024-de-la-vmeh">
                    <img src="../assets/image/carrousel/video/voeux_2024_intro.webp" alt="image d'engagement">
                    <div class="info-text">
                        <p>Vœux 2024 de la VMEH</p>
                    </div>
                </a>
            </div>
        </section>
        <a href="https://www.vmeh.fr/category/vmeh-en-video/" class="btn-voir-articles">Voir tous les articles</a>
    </article>
    <article>
        <h1>Nos portrait</h1>
        <section class="info" id="portrait">

            <div class="info-item">
                <a href="https://www.vmeh.fr/marie-boulay-benevole-et-presidente-vmeh-72">
                    <img src="../assets/image/carrousel/portraits/VMEH72-Marie-BOULAY.webp" alt="Portrait de Marie Boulay, bénévole et présidente ">
                    <div class="info-text">
                        <p>Marie Boulay, bénévole et présidente <br> VMEH 72</p>
                    </div>
                </a>
            </div>
            <div class="info-item">
                <a href="https://www.vmeh.fr/lassociation-vmeh-94-a-un-nouveau-president">
                    <img src="../assets/image/carrousel/portraits/VMEH-94.webp" alt="Portrait du nouveau president de VMEH">
                    <div class="info-text">
                        <p>L'association VMEH 94 a un nouveau président</p>
                    </div>
                </a>

            </div><div class="info-item">
                <a href="https://www.vmeh.fr/germaine-bodo-benevole-vmeh-972">
                    <img src="../assets/image/carrousel/portraits/VMEH972-Germaine-BODO.webp" alt="Portrait de Germaine Bodo, bénévole – VMEH 972">
                    <div class="info-text">
                        <p>Germaine Bodo, bénévole – VMEH 972</p>
                    </div>
                </a>
            </div>
        </section>
        <a href="https://www.vmeh.fr/category/vmeh-portraits-de-benevoles/" class="btn-voir-articles">Voir tous les articles</a>
    </article>

<a href="#menu"> <img src="../assets/image/carrousel/icon/fleche.png" id="fleche-srollTop"> </a>

</main>

<?php require_once "./footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
