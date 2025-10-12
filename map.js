var map = L.map("map").setView([46.6, 2.3522219], 4.5);

var Stadia_StamenTonerBackground = L.tileLayer('https://tiles.stadiamaps.com/tiles/stamen_toner_background/{z}/{x}/{y}{r}.{ext}', {
	minZoom: 0,
	maxZoom: 20,
	attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	ext: 'png'
});

Stadia_StamenTonerBackground.addTo(map);

var marker = L.marker([48.856614, 2.3522219]).addTo(map);
marker.bindPopup("<b>Paris paris en t'encule</b><br>je vais me tailler les veine");
//plus qu'a mettre beaucoup de marker