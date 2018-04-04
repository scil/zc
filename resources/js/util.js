export {log,xsScreen,notXsScreen}

var _debug = (typeof(console) !== 'undefined');

function log() {
    _debug && console.log.apply(null, arguments)
}


function xsScreen() {
    return $('#me').css('opacity') == "0.99";
}

function notXsScreen() {
    return !xsScreen();
}


