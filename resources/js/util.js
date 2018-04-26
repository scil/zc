// @flow
export {log,smScreen,notSmScreen}

/** @type {boolean} */
var _debug = (typeof(console) !== 'undefined');

function log() {
    _debug && console.log.apply(null, arguments)
}


function smScreen():boolean {
    return $('#me').css('opacity') === "0.99";
}

function notSmScreen():boolean {
    return !smScreen();
}


