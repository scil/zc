console.log('\n\
[[init command]]\n\
yarn add gulpjs/gulp#4.0 --dev \n\
yarn add gulp-flowtype --dev \n\
\
yarn add gulp-babel@8.0.0 --dev\n\
yarn add @babel/core@7.0.0 --dev\n\
yarn add @babel/cli@7.0.0 --dev\n\
yarn add @babel/polyfill@7.0.0 --save\n\
yarn add @babel/preset-env @babel/preset-flow -dev \n\
\n\
\
//why not use official babelify? Read:\n\
//  Upgrade to Babel 7 and @babel scoped packages https://github.com/babel/babelify/pull/255\n\
yarn add "github:ylemkimon/babelify" --dev \n\
\
\n\
[[run when pkgs are changed]] \n\
gulp pkg \n\
');


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
    fontawesome_versin = '4.5.0',
    pkg_dir = 'node_modules/',
    bower_pkg_dir = 'bower_components/';

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

    cleanCSS = require('gulp-clean-css'),
    sass = require('gulp-sass'),

    log = require('fancy-log');


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
            // use cdn instead
            //pkg_dir + 'simplemde/dist/simplemde.min.css', // 11k
        ],
        'js': [
            // use cdn instead
            //pkg_dir + 'simplemde/dist/simplemde.min.js',  // 263k

            'public/js/browserify_md.js',

            // pkg_dir + 'emmet-codemirror/dist/emmet.js', // thy it so big? contain codemirror?
        ],
    }
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
        .pipe(uglify())
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
        'public/js/vendor.js',
        // here we use a globbing pattern to match everything inside the `mobile` folder
        'dist/mobile/**/*',
        // we don't want to clean this file though so we negate the pattern
        '!dist/mobile/deploy.json'
    ]);
}

let css_files = [];
let js_files = [];

// select2
css_files.push(pkg_dir + 'select2/dist/css/select2.min.css');
js_files.push(pkg_dir + 'select2/dist/js/select2.min.js'); // 66k

// slick
css_files.push(pkg_dir + 'slick-carousel/slick/slick.css');
//css_files.push(pkg_dir + 'slick-carousel/slick/slick-theme.css');
js_files.push(pkg_dir + 'slick-carousel/slick/slick.min.js');

/* 41k*/

function dist_vendor_css() {
    return gulp.src(css_files.concat(
        markdown_editor_res[markdown_editor]['css']
    ))
        .pipe(concat('vendor.css'))
        .pipe(cleanCSS())
        .pipe(gulp.dest('public/css'));
}

function flowcheck_app_js() {
    return gulp.src(['resources/js/*.js'])
        .pipe(flow({
            all: false,
            weak: false,
            killFlow: false,
            beep: true,
            abort: false
        }));
}

function jsbin_free() {

    return gulp.src(['resources/js/free.js'])
        .pipe(flow({
            all: false,
            weak: false,
            killFlow: false,
            beep: true,
            abort: false
        }))
        .pipe(babel({
            presets: ['@babel/preset-flow'] }))
        .pipe(gulp.dest('resources/jsbin'));

}

function dist_app_js() {
    return browserify({debug: true,})// enalbe debug To use source maps
        .transform("babelify")
        .require("./resources/js/entry.js", {entry: true})
        .bundle()
        .on("error", function (err) {
            console.error("Error: " + err.message);
        })
        .pipe(source('zc.js'))  // Set source name
        .pipe(buffer()) // Convert to gulp pipeline
        .pipe(gulp.dest('public/js/babeled'))
        .pipe(sourcemaps.init({
            loadMaps: true,
            //compress: false,
        }))
        // todo: a replacement https://github.com/babel/minify   it has not pkg @babel
        .pipe(uglify().on('error', function (err) {
            console.error("Uglify: " + err.toString());
        }))
        .pipe(sourcemaps.write('./map'))
        .pipe(gulp.dest('public/js'));
}

function dist_vendor_js() {

    // google maps in a dependent file
    gulp.src([
        pkg_dir + 'gmaps/gmaps.min.js',
    ])
        .pipe(concat('gmaps.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));


    if (markdown_editor == 'editormd') {
        gulp.src([
            pkg_dir + 'emmet-codemirror/dist/emmet.js',
        ]).pipe(gulp.dest('public/js'))

    }

    return gulp.src([

        // pkg_dir + 'formvalidation/dist/js/formValidation.min.js',// 119k
        // pkg_dir + 'formvalidation/dist/js/framework/bootstrap.min.js',
        // pkg_dir + 'formvalidation/dist/js/language/zh_CN.js',

        pkg_dir + 'form-serializer/jquery.serialize-object.js',
        pkg_dir + 'jQuery-autoGrowInput/jquery.auto-grow-input.min.js',
        pkg_dir + 'vanilla-masker/build/vanilla-masker.min.js',

        pkg_dir + 'jquery-mousewheel/jquery.mousewheel.js',
        pkg_dir + 'jquery-visible/jquery.visible.min.js',
        pkg_dir + 'perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js',
        pkg_dir + 'jquery-touchswipe/jquery.touchSwipe.min.js',

        // use cdn instead
        // pkg_dir + 'jquery-mapael/js/jquery.mapael.js', // 53k
        // pkg_dir + 'jquery-mapael/js/maps/world_countries.js',
        'resources/js/world.js',

        pkg_dir + 'vue/dist/vue.min.js',
    ]
        .concat(markdown_editor_res[markdown_editor]['js'])
        .concat(js_files))
        .pipe(concat('vendor.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
}

function sass_app() {

    return gulp.src('./resources/assets/sass/app.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({includePaths: ['./resources/assets/sass/'], outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write('./map'))
        .pipe(gulp.dest('./public/css'));
}

function sass_ferry() {

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
        dist_app_js)

    gulp.watch(
        './resources/assets/sass/**/*.scss',
        {
            ignoreInitial: false,
            ignored: './resources/assets/sass/pass/_ferry.scss',
            delay: 300,
            // Usually necessary when watching files on a network mount or on a VMs file system.
            usePolling: true,
        },
        sass_app);

    gulp.watch(
        './resources/assets/sass/pass/_ferry.scss',
        {
            ignoreInitial: false,
            delay: 300,
            usePolling: true,
        },
        sass_ferry);

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

exports.clean = clean;
exports.dist_vendor_css = dist_vendor_css;
exports.dist_vendor_js = dist_vendor_js;
exports.dist_app_js = dist_app_js;
exports.flowcheck_app_js = flowcheck_app_js;
exports.jsbin_free=jsbin_free

// sass
exports.sass_app = sass_app;
exports.sass_ferry = sass_ferry;

// view and data
exports.column_cache = column_cache;
exports.column_data = column_data;

exports.watch = watch;
exports.watch_seed = watch_seed;

var build = gulp.series(
    clean,
    gulp.parallel(
        dist_vendor_css,
        gulp.series(flowcheck_app_js, dist_app_js),
        dist_vendor_js,
    ),
    sass_app,
    sass_ferry
);
gulp.task('default', build);
