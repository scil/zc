export default getG;

var g;

function getG() {
    if (g) return g;

    let localG;
    if (typeof window !== "undefined") {
        localG = window
    } else if (typeof global !== "undefined") {
        localG = global
    } else if (typeof self !== "undefined") {
        localG = self
    } else {
        localG = this
    }
    return g = localG;
}
