var map = L.map('map').setView([51.5, -0.09], 15);

// create the tile layer with correct attribution
var OpenStreetMap_Mapnik = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>' }).addTo(map);

var marker = L.marker([51.5, -0.09]).addTo(map);
