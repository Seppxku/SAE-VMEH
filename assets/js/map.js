

const cacheKey = "departementsData";
const cache = localStorage.getItem(cacheKey);

if (cache) {
    // Les données sont déjà en cache on les réutilise
    const data = JSON.parse(cache);
    initialiserCarte(data);
} else {
    // Sinon on les télécharge depuis le JSON
    fetch('../assets/data/agence.json')
        .then(res => {
            if (!res.ok) throw new Error("Erreur de chargement du fichier JSON");
            return res.json();
        })
        .then(data => {
            localStorage.setItem(cacheKey, JSON.stringify(data)); // on met les data dans le cache pour pas recharger
            initialiserCarte(data);
        })
        .catch(err => console.error("Erreur de chargement des données :", err));
}

function initialiserCarte(data) {
    var map = L.map("map").setView([46.6, 2.3522219],window.innerWidth < 768 ? 4 : 5.5); //zoom selon si pc ou tel

    var Stadia_StamenTonerBackground = L.tileLayer('https://tiles.stadiamaps.com/tiles/stamen_toner_background/{z}/{x}/{y}{r}.{ext}', {
        minZoom: 0,
        maxZoom: 20,
        attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        ext: 'png'
    });

    Stadia_StamenTonerBackground.addTo(map);

    window.addEventListener('resize', function() {
        let newZoom = window.innerWidth < 768 ? 4.5 : 5.5;
        map.setZoom(newZoom);
    });

    for (let key in data) {

        const agence = data[key];

        var marker = L.marker(agence.coo, {
            title: key,
        }).addTo(map);

        marker.bindPopup(`
    <span class="popup" style="cursor:pointer; color:blue;" onclick="afficherAgence('${key}')">
        ${key}
    </span>
	`);
        let container = document.getElementById("liste-departements");
        container.innerHTML += `<li>${key}</li>`

    }
// Après avoir créé les <li>, on récupère leur liste et on ajoute l'affichage du departement
    const items = document.querySelectorAll('#liste-departements li');
    items.forEach(li => {
        li.addEventListener('click', () => {
            afficherAgence(li.textContent);
        });
    });

    const input = document.getElementById('recherche');

    input.addEventListener('input', () => {
        const val = input.value.toLowerCase();
        items.forEach(li => {
            li.style.display = li.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
}
function afficherAgence(titreAgence){

    // si on est deja sur la page de la map on fait rien mais si on vien d'ailleur on va sur la page de la map
    if (document.title !== "VMEH - NOS ASSOCIATIONS DÉPARTEMENTALES") {
        window.location.href = `./pages/association-departementale.php?agence=${encodeURIComponent(titreAgence)}`;
        return; // le reste va pas s'exec de toute façon mais au cas ou
    }else{
        const url = new URL(window.location);
        url.searchParams.set('agence', titreAgence);
        history.replaceState(null, '', url);
    }

	let cacher = document.querySelector(".grille"); // on affiche les conteneur de l'agence
    cacher.classList.remove("cacher");

    cacher = document.getElementById("nomDepartement"); // on affiche l'image avec le nom du departement
    cacher.classList.remove("cacher");

/////////////////////////////////on trouve l'agence////////////////////////////////////////////////
    const cacheData = localStorage.getItem("departementsData");
    if (!cacheData) {
        console.error("Aucune donnée en cache, impossible d’afficher l’agence !");
        return;
    }
    const data = JSON.parse(cacheData);
    const agence = data[titreAgence];


//////////////////////////////////////on affiche l'agence///////////////////////////////////
	let container = document.getElementById("presidence");
	if(agence.president != null){
		container.innerHTML = agence.president.nom;

		container = document.getElementById("courriel");
		container.innerHTML = agence.president.courriel;

		container = document.getElementById("tel");
		container.innerHTML = agence.president.tel;

		const labels = document.querySelectorAll('.labelPresident');
    	labels.forEach(label => {
        	label.style.display = 'inline';
    	});
	}else {
		container.innerHTML = `<p class="label">info a venir</p>`;
		const labels = document.querySelectorAll('.labelPresident');
		labels.forEach(label => {
			label.style.display = 'none';
		});
	}

	container = document.getElementById("Bureau");
	if(agence.bureau == null){
		container.innerHTML = `<p class="label">info a venir</p>`;
	}
	else{
		container.innerHTML = "";
		for (let i in agence.bureau){
			container.innerHTML +=`<p><strong class="label">${agence.bureau[i].role} : </strong> <span>${agence.bureau[i].nom}</span></p>`
		}
	}
    container = document.getElementById("nomDepartement");
    container.innerHTML = `<h1> ${titreAgence}</h1>`;

	container = document.getElementById("Section local");
	if(agence.sectionLocal == null){
		container.innerHTML = `<p class="label">info a venir</p>`;
	} else{
		container.innerHTML = "";
		for (let i in agence.sectionLocal){
			container.innerHTML +=`<p>${agence.sectionLocal[i]}</p>`
		}
	}

    container = document.getElementById("carouselInner");
    if(agence.actualiter == null){
        container.innerHTML = "";
        container = document.getElementById("actu_texte");
        container.innerHTML = `<p class="label">info a venir</p>`;
        cacher = document.getElementById("carrousel_actu");
        cacher.classList.add("cacher");

    } else{
        cacher = document.getElementById("carrousel_actu");
        cacher.classList.remove("cacher");
        container.innerHTML = "";
        let first=true;
        for (let i in agence.actualiter){

            container.innerHTML +=`
                <a href="${agence.actualiter[i].lien}" target="_blank" class="carousel-link">
                    <div class="carousel-item ${first? "active":""}">
                        <img src="../assets/image/map/${agence.actualiter[i].img}" class="d-block w-100" alt="...">
                            <div class="carousel-caption bottom-0 d-none d-md-block">
                                <h3>${agence.actualiter[i].titre}</h3>
                                <p class="fs-5 d-none d-lg-block">${agence.actualiter[i].text}</p>
                            </div>
                    </div>
                </a>`
            first= false;
        }

        // Supprimer l'instance existante si elle existe
        const elem = document.getElementById("carrousel_actu");
        const existing = bootstrap.Carousel.getInstance(elem);
        if (existing) existing.dispose();

// Réinitialiser proprement le carrousel
        new bootstrap.Carousel(elem);

    }

///////////////////////////////////////////on scroll j'usque a l'agence/////////////////////////////////////////////////
    document.querySelector('#nomDepartement').scrollIntoView({ // on deplace la vision vers se qu'on affiche
        behavior: 'smooth',
        block: 'start'
    });
}
