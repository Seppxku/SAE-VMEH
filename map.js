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
		president: "Nom Prenom"
	}
}

for (let key in data) {

	const agence= data[key];

	var marker = L.marker(agence.coo,{
	title: agence.titre,
	}).addTo(map);

	marker.bindPopup(
		'<span class="popup"><b class="cliquable" onclick="afficherAgence(',agence.titre,')">'+ agence.titre+ '</b><br>'+agence.president+'</br></></span>'
	);
};

function afficherAgence(agence){
	//afficher les info de l'agence
}
