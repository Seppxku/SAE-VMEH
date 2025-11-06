var map = L.map("map").setView([46.6, 2.3522219], 5.5);

var Stadia_StamenTonerBackground = L.tileLayer('https://tiles.stadiamaps.com/tiles/stamen_toner_background/{z}/{x}/{y}{r}.{ext}', {
	minZoom: 0,
	maxZoom: 20,
	attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	ext: 'png'
});

Stadia_StamenTonerBackground.addTo(map);

const data = {
	Ain: {
		coo: [46.05, 5.20],
		titre: "01 – Ain",
		president: { nom:"Ludovic ORGÉ",
			courriel: "vmeh01.contact@gmail.com",
			tel: "06 87 19 12 17"
			},
	},

	Aisne: {
		coo: [49.30, 3.40],
		titre: "02 – Aisne",
		president: { nom:"René OUBRY",
			courriel: "moniqueviguesbillon@gmail.com",
			tel: "06 89 60 47 65 (SMS de préférence)"
			},
		bureau: [
			{
				role: "Coordinateur",
				nom:"Hubert ISTER"

			},
			{
				role:"Vice-président",
				nom:"Monique Vigues"
			},
			{
				role:"Trésorier",
				nom:"Hubert Ister"
			},
		],
		sectionLocal: ["Château-Thierry (Christiane Krabal)",
			"Chauny",
			"Crécy sur Serre",
			"Laon (Catherine Religieux)",
			"Le Nouvion en Thiérache (en sommeil)",
			"Saint-Quentin",
			"Soissons (Monique Vigues)"
		],
        actualiter: [
            {
                lien:"https://www.vmeh.fr/festival-des-solidarites-2024/",
                img: "Festivale_Solidariter.jpg" ,
                titre: "Festival des Solidarités 2024 (15/11/2024)",
                text: "Découverte et visite en EHPAD de la maison de retraite Bellevue les 19 et 26 novembre 2024."
            },
            {
                lien:"https://www.vmeh.fr/vmeh02-un-pas-en-avant-pour-la-communication/",
                img: "FredericFauveau.jpg" ,
                titre: "VMEH02, « Un pas en avant » pour la Communication (22/03/2024)",
                text: "les benevole du 02 on accueilli Frédéric Fauveau, vice-président de VMEH."
            }
        ]
		
	},
	Allier: {
		coo: [46.25, 3.10],
		titre: "03 – Allier",
		president: { nom:"Dominique BARDIN",
			courriel: "vmeh03@orange.fr",
			tel: "06 82 10 81 22"
			},
		bureau: [
			{
				role: "Présidente ",
				nom:"Dominique BARDIN"

			},
			{
				role:"Vice-présidente",
				nom:"Jacqueline VALLET"
			},
			{
				role: "Secrétaire",
				nom:"Michel THIZY"
			},
			{
				role:"Trésorier",
				nom:"Jacqueline PISSOT"
			}
		],
		sectionLocal: ["<strong>Établissements visités</strong>",
			"<strong>MOULINS</strong>",
			"Responsable : jacqueline.pissot@orange.fr",
			"Centre Hospitalier MOULINS YZEURE",
			"EHPAD Saint François",
			"EHPAD La Gloriette",
			"EHPAD L’Ermitage",
			"EHPAD Les Magnolias",
			"EHPAD Les Cèdres",
			"EHPAD Les Tilleuls",
			"EHPAD Les Mariniers",
			"EHPAD La Source – Souvigny",

			"<strong>SAINT-POURCAIN</strong>",
			"Responsable : claude.bouchaudy@orange.fr",
			"EHPAD Saint François",

			"<strong>VICHY</strong>",
			"Responsable : Dominique Bardin vmeh03@orange.fr",
			"Centre Hospitalier Jacques Lacarin VICHY",
			"EHPAD Le Lys – ViCHY",
			"EHPAD Résidence les Jardins de VENDAT"
		],
		
	},
	AlpesMaritimes:{
		coo: [43.50, 7.10],
		titre: "06 – Alpes-Maritimes",
		president: { nom:"Albert URBANI",
			courriel: "alberturbani@yahoo.fr",
			tel: "06 11 18 96 29"
			},
	},
	Ardeche:{
		coo: [44.40, 4.25],
		titre: "07 – Ardèche",
		president: { nom:"Françoise BALAŸ",
			courriel: "francoisebalay07@gmail.com",
			tel: "06 66 99 96 24"
			},

	},
	Ardennes:{
		coo: [49.35, 4.40],
		titre: "08 – Ardennes",
		bureau: [
			{
				role:"Vice-présidente",
				nom:"Edith CARREL"
			},
			{
				role:"Courriel",
				nom:" edith.carrel08@gmail.com"
			},
			{
				role:"Tél",
				nom:"03 24 38 21 81"
			},
			{
				role:"Vice-présidente",
				nom:"Fernanda GUENNELON"
			},
			{
				role:"Courriel ",
				nom:"lucien.guennelon@gmail.com"
			},
			{
				role:"Tél",
				nom:"03 24 26 44 07"
			},
		],

	},
	Ariège: {
		coo: [42.932629, 1.443469],
		titre: "09 – Ariège",
		president: { nom:"Pierre De ROBERT",
			courriel: "pierre-de-robert@orange.fr",
			tel: "06 10 92 76 18"
			},
	},
	Aube: {
		coo: [48.299999, 4.08333],
		titre: "10 – Aube",
	},
	Aude: {
		coo: [43.183331, 3],
		titre: "11 – Aude",
		president: { nom:"Geneviève CANAPA",
			courriel: "vmeh11@outlook.fr",
			tel: "04 68 94 78 54 <p>Moblie : 07 83 00 81 31</p>"
			},
	},
	BouchesduRhône: {
		coo: [43.5911679, 5.3102505],
		titre: "13 – Bouches-du-Rhône",
		president: { nom:"Danièle TIRAN",
			courriel: "vmeh13@orange.fr",
			tel: " 04 91 50 72 39<p>Moblie : 06 50 13 55 34</p>"
			},
		bureau: [
			{
				role:"Secrétaire-Trésorière",
				nom:"Monique BLANCHARD-MORTUAIRE"
			}
		],
	},
	Calvados: {
		coo: [49.02, 0.15],
		titre: "14 – Calvados",
		president: { nom:"Monique KONCEWIEC ET Sylvie GAREAU",
			courriel: "koncewieczmonique@gmail.com",
			tel: "02 31 78 84 90<p>Moblie : 06 98 82 64 95</p>"
			},

	},
}

for (let key in data) {

	const agence= data[key];

	var marker = L.marker(agence.coo,{
	title: agence.titre,
	}).addTo(map);
	
	marker.bindPopup(`
    <span class="popup" style="cursor:pointer; color:blue;" onclick="afficherAgence('${agence.titre.replace(/'/g, "\\'")}')">
        ${agence.titre}
    </span>
	`);
    let container = document.getElementById("liste-departements");
    container.innerHTML += `<li>${agence.titre}</li>`

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



function afficherAgence(titreAgence){

    // si on est deja sur la page de la map on fait rien mais si on vien d'ailleur on va sur la page de la map
    if (document.title !== "VMEH - NOS ASSOCIATIONS DÉPARTEMENTALES") {
        window.location.href = `./pages/nos-associations-departementales.html?agence=${encodeURIComponent(titreAgence)}`;
        return; // le reste va pas s'exec de toute façon mais au cas ou
    }else{
        const url = new URL(window.location);
        url.searchParams.set('agence', titreAgence);
        history.replaceState(null, '', url);
    }

	const grille = document.querySelector(".grille"); // on affiche les conteneur de l'agence
    grille.classList.remove("cacher");

	const image = document.getElementById("nomDepartement"); // on affiche l'image avec le nom du departement
    image.classList.remove("cacher");

	let agence = null;
	for (let key in data) {
		agence= data[key];
		if (agence.titre===titreAgence) break;
	}
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
    container.innerHTML = `<h1> ${agence.titre}</h1>`;

	container = document.getElementById("Section local");
	if(agence.sectionLocal == null){
		container.innerHTML = `<p class="label">info a venir</p>`;
	} else{
		container.innerHTML = "";
		for (let i in agence.sectionLocal){
			container.innerHTML +=`<p>${agence.sectionLocal[i]}</p>`
		}
	}

    container = document.getElementById("carrousel_actu");
    if(agence.actualiter == null){
        container.innerHTML = `<p class="label">info a venir</p>`;
    } else{
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


    document.querySelector('#nomDepartement').scrollIntoView({ // on deplace la vision vers se qu'on affiche
        behavior: 'smooth',
        block: 'start'
    });
}
