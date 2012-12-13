
// load google earth 
google.load("earth", "1");

// init google engine variable
var ge = null;
var placemarkArray = new Array();
var maxAlt = -1000000;


// init google earth function
// called on pageload
function init() {
    google.earth.createInstance("map3d", initCallback, failureCallback);
}

// google earth callback method
function initCallback(pluginInstance) {
    ge = pluginInstance;
    ge.getWindow().setVisibility(true);
    visShow();
	//setKmlAndPlacemark('http://www.archipublic.com/models/4/doc.kml',47.3857,8.51783, "test");
}

function flyToModel(latitude, longitude){
	// fly to model
	var lookAt = ge.getView().copyAsLookAt(ge.ALTITUDE_RELATIVE_TO_GROUND);

	// Set new latitude and longitude values.
	lookAt.set(latitude, longitude, 30, ge.ALTITUDE_RELATIVE_TO_GROUND,
           180, 60, 500);

	// Update the view in Google Earth.
	ge.getView().setAbstractView(lookAt);
	// Zoom out to twice the current range.
	lookAt.setRange(lookAt.getRange() / 50.0);

	// Update the view in Google Earth.
	ge.getView().setAbstractView(lookAt);
}

function setKmlAndPlacemark(kmlUrl, latitude, longitude, placemarkClickScript){	
	// fetch new kml model from url
	var link = ge.createLink('');
	link.setHref(kmlUrl);
	var networkLink = ge.createNetworkLink('');
	networkLink.setLink(link);
	networkLink.setFlyToView(true);

	ge.getFeatures().appendChild(networkLink);
	
	
	// fly to model
	// diese methode macht kein sinn, mit setFlyToView fliegt man bereits hin
	//flyToModel(latitude, longitude);
	
	// Check here if point already exists.
	var check = false;
	for (var i = 0; i < placemarkArray.length; i++){
		if (placemarkArray[i] == kmlUrl){
			check = true;
		}
	}
	// create point
	if (check == false){
		placemarkArray.push(kmlUrl);
		var placemark = ge.createPlacemark('');
		//placemark.setName("test");
		ge.getFeatures().appendChild(placemark);

		// Create style map for placemark
		var icon = ge.createIcon('');
		icon.setHref('http://maps.google.com/mapfiles/kml/paddle/red-circle.png');
		var style = ge.createStyle('');
		style.getIconStyle().setIcon(icon);
		placemark.setStyleSelector(style);

		// Create point
		var point = ge.createPoint('');
		point.setLatitude(latitude);
		point.setLongitude(longitude);
		placemark.setGeometry(point);
		
		// Define what happens when a mousemove is detected on the globe.
		function recordAltitude(event) {
		var currentAlt = event.getAltitude();
		maxAlt = Math.max(maxAlt, currentAlt);
		document.getElementById('altitude').innerHTML = '<p>Current altitude: ' + currentAlt + '<br />Max altitude: '+ maxAlt + '</p>';
		
		}
		// Listen to the mousemove event on the globe.
		//google.earth.addEventListener(ge.getGlobe(), 'mousemove', recordAltitude);
		google.earth.addEventListener(placemark, 'mousemove', alert("mouseover"));
	}
}


function visShow() {
  ge.getNavigationControl().setVisibility(ge.VISIBILITY_SHOW);
  //ge.setOverviewMapVisibility();
}


// what to do on failure?? TODO
function failureCallback(object) {
}

// load google engine after DOM is completed
google.setOnLoadCallback(init);