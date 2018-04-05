// @flow
export {log,xsScreen,notXsScreen}

/** @type {boolean} */
var _debug = (typeof(console) !== 'undefined');

function log() {
    _debug && console.log.apply(null, arguments)
}


function xsScreen():boolean {
    return $('#me').css('opacity') === "0.99";
}

function notXsScreen():boolean {
    return !xsScreen();
}


