/**
 [[how]]
 1. gzip js and css here, not nginx. \
 but nginx should set add_header Content-Encoding gzip \
 2. zhenc.test uses two js/css files: app.js/css vendor.js/css, so css_merge js_merge and rev used by product only   \


 [[needed pkg]]
 yarn add gulpjs/gulp#4.0 --dev
 yarn add gulp-flowtype --dev

 yarn add gulp-babel@8.0.0 --dev
 yarn add @babel/core@7.0.0 --dev
 yarn add @babel/cli@7.0.0 --dev
 yarn add @babel/polyfill@7.0.0 --dev
 yarn add @babel/preset-env @babel/preset-flow -dev

 // why not use official babelify? Read:
 //  Upgrade to Babel 7 and @babel scoped packages https://github.com/babel/babelify/pull/255
 yarn add "github:ylemkimon/babelify" --dev


 ');
 */

console.log('\n\
[[run when pkgs are changed]] \n\
gulp pkg \n\
\
');

var IN_PRODUCT = 0;

/**
 *
 *  editormd
 *  simplemde
 * @type {string}
 */
const
    markdown_editor = 'simplemde',
    // used by editormd
    font_css_path = 'resources/font/fontello/css/fontello.css',
    fontawesome_versin = '4.7.0',
    pkg_dir = 'node_modules/',
    bower_pkg_dir = 'bower_components/';


const markdown_editor_res = {
    // editor.md + codemirror
    'editormd': {
        'css': [
            pkg_dir + 'editor.md/css/editormd.min.css',
            //autoLoadModules : false,  // Manually load modules
            pkg_dir + 'editor.md/lib/codemirror/codemirror.min.css',
            pkg_dir + 'editor.md/lib/codemirror/addon/dialog/dialog.css',
            // 虽然editor.md默认加载了，我觉得这个css不需要加载，待出现问题再说
            // pkg_dir + 'editor.md/lib/codemirror/addon/search/matchesonscrollbar.css',

            font_css_path,
        ],
        'js': [
            pkg_dir + 'editor.md/lib/codemirror/codemirror.min.js',
            pkg_dir + 'editor.md/lib/codemirror/addons.min.js',
            pkg_dir + 'editor.md/lib/codemirror/modes.min.js',
            pkg_dir + 'editor.md/lib/marked.min.js',
            // if setting previewCodeHighlight == true
            //pkg_dir + 'editor.md/lib/prettify.min.js',
            // if setting flowchart == true, or sequence-diagram == true
            // raphael.min.js sequence-diagram.min.js flowchart.min.js jquery.flowchart.min.js
            pkg_dir + 'editor.md/editormd.min.js',
            //pkg_dir + 'emmet-codemirror/dist/emmet.js', 提前加载无效， editormd所依赖的项目都是动态加载的
        ],
    },
    'simplemde': {
        'css': [
            pkg_dir + 'simplemde/dist/simplemde.min.css', // 11k
        ],
        'js': [
            // use cdn instead
            //pkg_dir + 'simplemde/dist/simplemde.min.js',  // 263k

            // pkg_dir + 'emmet-codemirror/dist/emmet.js', // thy it so big? contain codemirror?
        ],
    }
}

const
    gulp = require('gulp'),
    babel = require('gulp-babel'),
    flow = require('gulp-flowtype'),

    // By default, gulp-uglify uses the version of UglifyJS installed as a dependency.
    // var uglify = require('gulp-uglify'),
    // 要压缩的文件用到了es6语法 It's possible to configure the use of a different version using the "composer" entry point.
    composer = require('gulp-uglify/composer'),
    uglify = composer(require('uglify-es'), console),
    browserify = require('browserify'),
    babelify = require('babelify'),
    source = require('vinyl-source-stream'),
    buffer = require('vinyl-buffer'),

    sourcemaps = require('gulp-sourcemaps'),

    del = require('del'),
    rename = require('gulp-rename'),
    replace = require('gulp-replace'),
    concat = require('gulp-concat'),

    exec = require("gulp-exec"),
    process = require('child_process'),
    path = require('path'),

    _cleanCSS = require('gulp-clean-css'),
    sass = require('gulp-sass'),

    rev = require('gulp-rev'),
    revCollector = require('gulp-rev-collector'),

    gzip = require('gulp-gzip'),
    log = require('fancy-log');


function product_init() {
    IN_PRODUCT = 1;
}

function getUglifyOptions() {

    return uglifyOptions = {
        toplevel: true,
        compress: IN_PRODUCT ? {
            warnings: true,
            unsafe_proto: true,
            unsafe_math: true,
            unsafe_comps: true,
            toplevel: true,
            passes: IN_PRODUCT ? 5 : 1,
        } : false,
    }

}

console.log('ugify: ', getUglifyOptions(), "\n")

function cleanCSS() {
    if (IN_PRODUCT)
        return _cleanCSS({
            level: 2,
        }, (details) => {
            console.log(`${details.name}: ${details.stats.originalSize}`);
            console.log(`${details.name}: ${details.stats.minifiedSize}`);
        });

    return _cleanCSS({
        level: 0,
    }, (details) => {
        console.log(`${details.name}: ${details.stats.originalSize}`);
        console.log(`${details.name}: ${details.stats.minifiedSize}`);
    });
}

// 把字体后缀 ?v=4.3.0 变成 ?v=4.5.0 虽然没必要 只是个query string 但还是一致点好
// 把原文件备份为 editormd.css.bak
function editormd_font_version() {
    return gulp.src([pkg_dir + 'editor.md/css/editormd.css'])
        .pipe(replace(/fontawesome-([^=]+)v=([\d\.]+)/g, 'fontawesome-$1v=' + fontawesome_versin))
        .pipe(rename('editormd.css.version'))
        .pipe(gulp.dest(pkg_dir + 'editor.md/css'));
}

function editormd_font_version_move() {
    return gulp.src('node_modules/editor.md/css/editormd.css')
        .pipe(exec('mv <%= file.path %>  <%= file.path %>.bak && mv <%= file.path %>.version <%= file.path %> '));
}

gulp.task('pkg_editormd', gulp.series(editormd_font_version, editormd_font_version_move));

// minify emmet.js
function pkg_codemirror() {
    return gulp.src(pkg_dir + 'emmet-codemirror/dist/emmet.js')
        .pipe(uglify(getUglifyOptions()))
        .pipe(rename('emmet.min.js'))
        .pipe(gulp.dest(pkg_dir + 'emmet-codemirror/dist'));
}


gulp.task('pkg', gulp.parallel([
        pkg_codemirror,
    ].concat(
    markdown_editor == 'editormd' ? pkg_editormd : [])
));


function clean() {
    return del([
        'public/css/app.css',
        'public/css/vendor.css',
        'public/css/all.css',
        'public/js/vendor.js',
        // here we use a globbing pattern to match everything inside the `mobile` folder
        'dist/mobile/**/*',
        // we don't want to clean this file though so we negate the pattern
        '!dist/mobile/deploy.json'
    ]);
}

let form_js_files = [];
let form_css_files = [];
let vendor_js_files = [];
let vendor_css_files = [];

// use cdn
// // select2
// vendor_css_files.push(pkg_dir + 'select2/dist/css/select2.min.css');
// form_js_files.push(pkg_dir + 'select2/dist/js/select2.min.js'); // 66k

// editor
form_js_files = form_js_files.concat(
    markdown_editor_res[markdown_editor]['js']
)
form_css_files = form_css_files.concat(
    markdown_editor_res[markdown_editor]['css']
)


// slick
vendor_css_files.push(pkg_dir + 'slick-carousel/slick/slick.css');
//vendor_css_files.push(pkg_dir + 'slick-carousel/slick/slick-theme.css');
vendor_js_files.push(pkg_dir + 'slick-carousel/slick/slick.min.js'); // 42k

/* 41k*/

function css_vendor() {
    if (IN_PRODUCT) {
        return gulp.src(vendor_css_files)
            .pipe(concat('vendor.css'))
            // .pipe(cleanCSS())
            .pipe(rename('vendor.css.product'))
            .pipe(gulp.dest('public/css'));

    }
    return gulp.src(vendor_css_files)
        .pipe(sourcemaps.init({
            // loadMaps: true,
            //compress: false,
        }))
        .pipe(cleanCSS())
        .pipe(concat('vendor.css'))
        .pipe(sourcemaps.write('./map'))
        .pipe(gulp.dest('public/css'));
}

function css_app() {
    if (IN_PRODUCT) {
        return gulp.src('./resources/assets/sass/app.scss')
            .pipe(sass({
                includePaths: ['./resources/assets/sass/'],
                outputStyle: 'compressed'
            }).on('error', sass.logError))
            // .pipe(cleanCSS())
            .pipe(rename('app.css.product'))
            .pipe(gulp.dest('./public/css'));
    }
    return gulp.src('./resources/assets/sass/app.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({includePaths: ['./resources/assets/sass/'], outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(sourcemaps.write('./map'))
        .pipe(gulp.dest('./public/css'));
}

function css_merge_clean() {
    return del(['public/rev/*.css']);
}

function css_merge() {
    return gulp.src(['public/css/app.css.product', 'public/css/vendor.css.product'])
    // .pipe(sourcemaps.init({
    //     loadMaps: true,
    //     //compress: false,
    // }))
        .pipe(concat('all.css'))
        .pipe(cleanCSS())
        // .pipe(sourcemaps.write('./map',{}))
        .pipe(gzip({
            skipGrowingFiles: true,
            append: false,
            gzipOptions: {level: 9, memLevel: 9}
        }))
        .pipe(rev())
        .pipe(gulp.dest('public/rev'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('public/css'));

}

function only_pub_rev() {
    return gulp.src(['public/**/rev-manifest.json', 'resources/views/layouts/base.blade.php'])
        .pipe(replace(/link href="\/css\/app.css"/, 'link href="/css/all.css"'))
        .pipe(replace(/<link href="\/css\/vendor.css" rel="stylesheet">\n/, ''))
        .pipe(replace(/src="\/js\/app.js"/, 'src="/js/all.js"'))
        .pipe(replace(/<script src="\/js\/vendor.js" defer><\/script>\n/, ''))
        .pipe(revCollector({
            dirReplacements: {
                '/css': '/rev',
                '/js': '/rev',
            }
        }))
        .pipe(rename('base.blade.php.product'))
        .pipe(gulp.dest('resources/views/layouts'));
}

function flowcheck_app() {
    return gulp.src(['resources/js/*.js'])
        .pipe(flow({
            all: false,
            weak: false,
            killFlow: false,
            beep: true,
            abort: false
        }));
}

//deprecated
function jscli_free() {

    return gulp.src(['resources/js/free.js'])
        .pipe(flow({
            all: false,
            weak: false,
            killFlow: false,
            beep: true,
            abort: false
        }))
        .pipe(babel({
            presets: ['@babel/preset-flow']
        }))
        .pipe(gulp.dest('resources/jscli'));

}

function js_app() {

    // return browserify({debug: true,})// enalbe debug To use source maps
    //     .transform("babelify")
    //     .require("./resources/js/entry.js", {entry: true})

    var bundler = browserify('./resources/js/entry.js', {debug: true})
        .on('postbundle', function (src) {
            console.log(src)
        })
        .transform(babelify, {})
        .bundle()
        .on("error", function (err) {
            console.error("Error: " + err.message);
        })
        .pipe(source('app.js'))  // Set source name
        .pipe(buffer()) // Convert to gulp pipeline
        .pipe(gulp.dest('public/js/babeled'))

    if (IN_PRODUCT) {
        return bundler
        // todo: a replacement https://github.com/babel/minify   it has not pkg @babel
            .pipe(uglify(getUglifyOptions()).on('error', function (err) {
                console.error("Uglify: " + err.toString());
            }))
            .pipe(rename('app.js.product'))
            .pipe(gulp.dest('public/js'));

    }
    return bundler
        .pipe(sourcemaps.init({
            // loadMaps: true,
            //compress: false,
        }))
        // todo: a replacement https://github.com/babel/minify   it has not pkg @babel
        .pipe(uglify(getUglifyOptions()).on('error', function (err) {
            console.error("Uglify: " + err.toString());
        }))
        .pipe(sourcemaps.write('./map'))
        .pipe(gulp.dest('public/js'));
}

// just study babel config
function js_app_ie() {
    return browserify({debug: true,})// enalbe debug To use source maps
        .transform("babelify",
            {
                //  "plugins": [
                //    "transform-react-jsx"
                //  ],
                //  "ignore": [
                //    "foo.js",
                //    "bar/**/*.js"
                //  ],
                "babelrc": false,
                "presets": [

                    "@babel/preset-flow",

                    ["@babel/preset-env",
                        {
                            "targets": {
                                "browsers": [
                                    "last 2 versions",
                                    "ie >= 8"
                                ],
                                "firefox": 55
                            },

                            "modules": "commonjs",

                            // Babel默认只转换新的JavaScript句法（syntax），而不转换新的API. 须使用babel-polyfill
                            // * 可打包用到的api 即 "usage"
                            //  "useBuiltIns": "usage",
                            // * 可在html上引入 如     <script src="https://cdn.bootcss.com/babel-polyfill/7.0.0-beta.49/polyfill.min.js"></script>
                            // "useBuiltIns": false,
                            "useBuiltIns": 'usage',

                            "debug": true,
                        }]

                ],
                //"sourceMaps": "both",
                "sourceMaps": "inline",
                "minified": true,
                "comments": false
            }
        )
        .require("./resources/js/entry.js", {entry: true})
        .bundle()
        .on("error", function (err) {
            console.error("Error: " + err.message);
        })
        .pipe(source('ie_app.js'))  // Set source name
        .pipe(buffer()) // Convert to gulp pipeline
        .pipe(gulp.dest('public/js/babeled'))
        .pipe(sourcemaps.init({
            // loadMaps: true,
            //compress: false,
        }))
        // todo: a replacement https://github.com/babel/minify   it has not pkg @babel
        .pipe(uglify(getUglifyOptions()).on('error', function (err) {
            console.error("Uglify: " + err.toString());
        }))
        .pipe(sourcemaps.write('./map'))
        .pipe(gulp.dest('public/js'));
}

function js_form() {
    gulp.src([
        pkg_dir + 'form-serializer/jquery.serialize-object.js',
        pkg_dir + 'jQuery-autoGrowInput/jquery.auto-grow-input.min.js',
        pkg_dir + 'vanilla-masker/build/vanilla-masker.min.js',

        // pkg_dir + 'formvalidation/dist/js/formValidation.min.js',// 119k
        // pkg_dir + 'formvalidation/dist/js/framework/bootstrap.min.js',
        // pkg_dir + 'formvalidation/dist/js/language/zh_CN.js',

    ])
        .concat(form_js_files)
        .concat()
        .pipe(concat('form.js'))
        .pipe(uglify(getUglifyOptions()))
        .pipe(gulp.dest('public/js'));
}

function js_vendor() {

    // google maps in a dependent file
    // gulp.src([
    //     pkg_dir + 'gmaps/gmaps.min.js',
    // ])
    //     .pipe(concat('gmaps.js'))
    //     .pipe(uglify(getUglifyOptions()))
    //     .pipe(gulp.dest('public/js'));


    // if (markdown_editor === 'editormd') {
    //     gulp.src([
    //         pkg_dir + 'emmet-codemirror/dist/emmet.js',
    //     ]).pipe(gulp.dest('public/js'))
    // }

    let g = gulp.src([

        // only used in homepage, so use cdn
        // pkg_dir + 'jquery-mousewheel/jquery.mousewheel.js',

        // use cdn instead
        // pkg_dir + 'bootstrap-sass/assets/javascripts/bootstrap.min.js', // 36k

        pkg_dir + 'jquery-touchswipe/jquery.touchSwipe.min.js', // 20k
        // pkg_dir + 'jquery-pjax/jquery.pjax.js',

        pkg_dir + 'jquery-mapael/js/jquery.mapael.min.js', // 53k

        // pkg_dir + 'jquery-mapael/js/maps/world_countries.js',
        'resources/js/world.js', // 105k

    ]
        .concat(vendor_js_files));

    if (IN_PRODUCT) {
        return g
            .pipe(concat('vendor.js'))
            .pipe(uglify(getUglifyOptions()))
            .pipe(rename("vendor.js.product"))
            .pipe(gulp.dest('public/js'));

    }

    return g
        .pipe(sourcemaps.init({
            // loadMaps: true,
            //compress: false,
        }))
        .pipe(concat('vendor.js'))
        .pipe(uglify(getUglifyOptions()))
        .pipe(sourcemaps.write('./map', {}))
        .pipe(gulp.dest('public/js'));
}

function js_merge_clean() {
    return del(['public/rev/*.js']);
}

function js_merge() {
    return gulp.src(['public/js/app.js.product', 'public/js/vendor.js.product'])
    // .pipe(sourcemaps.init({
    //     loadMaps: true,
    //     //compress: false,
    // }))
        .pipe(concat('all.js'))
        // .pipe(sourcemaps.write('./map',{}))
        .pipe(gzip({
            skipGrowingFiles: true,
            append: false,
            gzipOptions: {level: 9, memLevel: 9}
        }))
        .pipe(rev())
        .pipe(gulp.dest('public/rev'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('public/js'));

}


function css_ferry() {

    return gulp.src('./resources/assets/sass/ferry.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({includePaths: ['./resources/assets/sass/'], outputStyle: 'compressed'}).on('error', sass.logError))
        // add comment myself, because ferry.css and map files are not in a same folder
        .pipe(sourcemaps.write('../../../public/css/map', {addComment: false}))
        .pipe(gulp.dest('./resources/views/css'));
}

function column_blade() {
    return process.exec('php artisan column:blade', function (error, stdout, stderr) {
            if (error !== null) {
                console.log('php artisan column:blade error: ' + error);
            }
        }
    );
}

function column_cache() {
    return process.exec('php artisan column:cache', function (error, stdout, stderr) {
            if (error !== null) {
                console.log('php artisan column:cache error: ' + error);
            }
        }
    );
}

function column_data() {
    return process.exec('php artisan db:seed --class=MenuItemsTableSeeder ', function (error, stdout, stderr) {
            if (error !== null) {
                console.log('php artisan db:seed MenuItemsTableSeeder and column:cache error: ' + error);
            } else {
                column_cache();
            }
        }
    );
}

function watch() {

    gulp.watch('./resources/js/entry.js',
        {
            ignoreInitial: false,
            delay: 600,
            // Usually necessary when watching files on a network mount or on a VMs file system.
            usePolling: true,
        },
        js_app)

    gulp.watch(
        './resources/assets/sass/**/*.scss',
        {
            ignoreInitial: false,
            ignored: './resources/assets/sass/pass/_ferry.scss',
            delay: 300,
            // Usually necessary when watching files on a network mount or on a VMs file system.
            usePolling: true,
        },
        css_app);

    gulp.watch(
        './resources/assets/sass/pass/_ferry.scss',
        {
            ignoreInitial: false,
            delay: 300,
            usePolling: true,
        },
        css_ferry);

    gulp.watch(
        './database/seeds/MenuItemsTableSeeder.php',
        {
            delay: 500,
            usePolling: true,
        },
        column_data
    );
    gulp.watch(
        './resources/views/layouts/base.blade.php',
        {
            delay: 500,
            usePolling: true,
        },
        column_blade);
}


function watch_seed() {

    gulp.watch('database/seeds/*.php',
        {
            ignoreInitial: false,
            delay: 300,
            usePolling: true,
        }, function (path, stats) {

            var className = path.basename(path, '.php');
            var cmd = "php artisan db:seed --class=" + className;
            console.log(cmd);
            process.exec(cmd, function (error, stdout, stderr) {
                    if (error !== null) {
                        console.log('db:seed error: ' + error);
                    }
                }
            );
        })
};


function icon() {
    return gulp.src(['public/other/apple-icon.png', 'public/other/favicon.ico'])
        .pipe(gzip({
            skipGrowingFiles: true,
            append: false,
            gzipOptions: {level: 9, memLevel: 9}
        }))
        .pipe(gulp.dest('public'));
}


exports.icon = icon;

exports.clean = clean;

// js
exports.flowcheck_app = flowcheck_app;
exports.js_form = js_form;
exports.js_vendor = js_vendor;
exports.js_app = js_app;
exports.js_app_ie = js_app_ie;
exports.js_merge = gulp.series(
    // js_merge_clean,
    js_merge
);

//deprecated
exports.jscli_free = jscli_free

// sass
exports.css_app = css_app;
exports.css_ferry = css_ferry;
// vendor css
exports.css_vendor = css_vendor;
exports.css_merge = gulp.series(
    // css_merge_clean,
    css_merge
);

exports.only_pub_rev = only_pub_rev;
exports.rev = gulp.series(
    // css_merge_clean,
    css_merge,
    // js_merge_clean,
    js_merge,
    only_pub_rev
);

// view and data
exports.column_cache = column_cache;
exports.column_data = column_data;

exports.watch = watch;
exports.watch_seed = watch_seed;

all_work = gulp.series(
    clean,
    css_app,
    css_ferry,
    gulp.parallel(
        css_vendor,
        gulp.series(flowcheck_app, js_app),
        gulp.series(js_form, js_vendor)
    ),
);

gulp.task('default', all_work);
gulp.task('product', gulp.series(
    product_init,
    all_work,
    exports.rev,
));

