var webpack = require("webpack");

module.exports = {
    entry: {
        app: "./app.js",
        vendor: ['./bower_components/formvalidation/dist/js/formValidation.min.js',
            './bower_components/formvalidation/dist/js/framework/bootstrap.min.js',
            './bower_components/formvalidation/dist/js/language/zh_CN.js',
            './bower_components/vanilla-masker/build/vanilla-masker.min.js',
            './bower_components/selectize/dist/js/standalone/selectize.min.js',
            './bower_components/jQuery-autoGrowInput/jquery.auto-grow-input.min.js',],
},
output: {
    filename: "bundle.js"
},
plugins: [
    new webpack.optimize.CommonsChunkPlugin(/* chunkName= */"vendor", /* filename= */"vendor.bundle.js")
]
};