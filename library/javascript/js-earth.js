
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
    
    // create the buttons
    //createNativeHTMLButton(100, 100, 210, 40); // x, y, width, height
    //createScreenOverlayButton(100, 200, 210, 40); // x, y, width, height
    //createNativeHTMLMenu(100, 210, 200); // x, width, height
    //addEntryToMenu("entry1", "#");
    //addEntryToMenu("entry2", "#");
}

// what to do on failure?? TODO
function failureCallback(object) {
}

// load google engine after DOM is completed
google.setOnLoadCallback(init);