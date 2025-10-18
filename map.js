var map = L.map("map").setView([46.6, 2.3522219], 4.5);

var Stadia_StamenTonerBackground = L.tileLayer('https://tiles.stadiamaps.com/tiles/stamen_toner_background/{z}/{x}/{y}{r}.{ext}', {
	minZoom: 0,
	maxZoom: 20,
	attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	ext: 'png'
});

Stadia_StamenTonerBackground.addTo(map);

const data = {
	paris: {
		coo: [48.856614, 2.3522219],
		titre: "Paris",
		president: { nom:"Nom Prenom",
			courriel: "email",
			tel: "36303630"
			},
		bureau: [{
			role: "vice-presidente",
			nom:"Monique"	
			},
			{
				role: "tresorerier",
				nom:"huber"	
			}
		],
		sectionLocal: [
			"Château-Thierry (Christiane Krabal)",
			"Chauny",
			"Crécy sur Serre",
			"Laon (Catherine Religieux)",
			"Le Nouvion en Thiérache (en sommeil)",
			"Saint-Quentin",
			"Soissons (Monique Vigues)"
		],
	}
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

};

function afficherAgence(titreAgence){
	let agence = null;
	for (let key in data) {
		agence= data[key];
		if (agence.titre==titreAgence) break;
	}
	let container = document.getElementById("presidence");
	container.innerHTML = agence.president.nom

	container = document.getElementById("courriel");
	container.innerHTML = agence.president.courriel

	container = document.getElementById("tel");
	container.innerHTML = agence.president.tel

	container = document.getElementById("Bureau");
	for (let i in agence.bureau){
		container.innerHTML +=`<p><strong class="label">${agence.bureau[i].role} : </strong> <span>${agence.bureau[i].nom}</span></p>`
	}

	container = document.getElementById("Section local");
	for (let i in agence.sectionLocal){
		container.innerHTML +=`<p>${agence.sectionLocal[i]}</p>`
	}
}
