
// load google earth 
google.load("earth", "1");

// init google engine variable
var ge = null;

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
	flyToModel(latitude, longitude);
	
	// create point
	// Check here if point already exists.
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