
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
    
    // create the buttons
    //createNativeHTMLButton(100, 100, 210, 40); // x, y, width, height
    //createScreenOverlayButton(100, 200, 210, 40); // x, y, width, height
    //createNativeHTMLMenu(100, 210, 200); // x, width, height
    //addEntryToMenu("entry1", "#");
    //addEntryToMenu("entry2", "#");
	setStartPosition();
	addPlacemark();
}

function setStartPosition(){
var lookAt = ge.getView().copyAsLookAt(ge.ALTITUDE_RELATIVE_TO_GROUND);

// Set new latitude and longitude values.
lookAt.setLatitude(46.584207);
lookAt.setLongitude(7.754322);

// Update the view in Google Earth.
ge.getView().setAbstractView(lookAt);
// Zoom out to twice the current range.
lookAt.setRange(lookAt.getRange() / 50.0);

// Update the view in Google Earth.
ge.getView().setAbstractView(lookAt);
}

function addKmlFromUrl(kmlUrl) {
  	var link = ge.createLink('');
  	link.setHref(kmlUrl);

  	var networkLink = ge.createNetworkLink('');
  	networkLink.setLink(link);
  	networkLink.setFlyToView(true);

  	ge.getFeatures().appendChild(networkLink);
  	
}

function addPlacemark(){
var counter = 0;

var placemark = ge.createPlacemark('');
placemark.setName("placemark" + counter);
ge.getFeatures().appendChild(placemark);

// Create style map for placemark
var icon = ge.createIcon('');
icon.setHref('http://maps.google.com/mapfiles/kml/paddle/red-circle.png');
var style = ge.createStyle('');
style.getIconStyle().setIcon(icon);
placemark.setStyleSelector(style);
//style.getBallonStyle().setText("lalalal");

// Create point
var la = ge.getView().copyAsLookAt(ge.ALTITUDE_RELATIVE_TO_GROUND);
var point = ge.createPoint('');
//point.setLatitude(la.getLatitude());
//point.setLongitude(la.getLongitude());
point.setLatitude(46.584207);
point.setLongitude(7.754322);
placemark.setGeometry(point);
//var balloon = ge.createHtmlStringBalloon('');
//balloon.setFeature(placemark);
//balloon.setMinWidth(400);
//balloon.setMaxHeight(400);
//balloon.setCloseButtonEnabled(false);
counter++;
//var balloon1 = ge.createHtmlStringBalloon('');
//balloon1.setFeature(placemark);
//balloon1.setMinWidth(400);
//balloon1.setMaxHeight(400);
//balloon1.setCloseButtonEnabled(false);
//ge.setBalloon(balloon1);
//}
//function addEventListenerForBallon(){
//google.earth.addEventListener(placemark, 'click', function(event) {
  // Prevent the default balloon from appearing.
//  event.preventDefault();

//  var content = "test";//placemark.getDescription();
//  var balloon = ge.createHtmlStringBalloon('');
//  balloon.setFeature(placemark);
//  balloon.setContentString(content);
//  ge.setBalloon(balloon);
//});
google.earth.addEventListener(ge, 'balloonopening', function(event) {
event.preventDefault();
// sometimes event.preventDefault() doesn't work so use the following line instead (uncomment it obviously)
// ge.setBalloon(null);

// find out which placemark's balloon tried to open
var placemark1 = event.getBalloon().getFeature();
var placemark_desc = placemark1.getDescription();
var placemark_name = placemark1.getName();
// use this if you have 'unsafe' stuff in the balloon - eg javascript
var placemark_desc_active = placemark.getBalloonHtmlUnsafe();
var content = 'test1';
var balloon = ge.createHtmlStringBalloon('');
balloon.setFeature(placemark);
/*balloon.setContentString(
      '<a href="#" onclick="alert(\'Running some JavaScript!\');">Alert!</a>');*/
balloon.setContentString(
      '<a href="#" onclick="addKmlFromUrl(\'http://demo.creativecode.ch/sampleKML.church.kml\');">Set the church!</a>');
//balloon.setContentString(content);
ge.setBalloon(balloon);
// Do something with the info

});
}
function visShow() {
  ge.getNavigationControl().setVisibility(ge.VISIBILITY_SHOW);
}


// what to do on failure?? TODO
function failureCallback(object) {
}

// load google engine after DOM is completed
google.setOnLoadCallback(init);