console.log('\n****************\n[run]  yarn add  gulpjs/gulp#4.0 --dev')
console.log('[run] `gulp pkg` every time your pkgs are changed\n****************\n')


/**
 *
 *  editormd
 *  simplemde
 * @type {string}
 */
const markdown_editor = 'simplemde',
    // used by editormd
    font_css_path = 'resources/font/fontello/css/fontello.css',
    fontawesome_versin = '4.5.0',
    pkg_dir = 'node_modules/',
    bower_pkg_dir = 'bower_components/';

const gulp = require('gulp'), del = require('del'), rename = require('gulp-rename'),
    gulp_replace = require('gulp-replace'), concat = require('gulp-concat'),

    shell = require("gulp-shell"), process = require('child_process'), path = require('path'),

    cleanCSS = require('gulp-clean-css'),

// By default, gulp-uglify uses the version of UglifyJS installed as a dependency.
// var uglify = require('gulp-uglify'),
// 要压缩的文件用到了es6语法
// It's possible to configure the use of a different version using the "composer" entry point.
// let uglify supporting es6
    uglifyjs = require('uglify-es'), composer = require('gulp-uglify/composer'), uglify = composer(uglifyjs, console),

    browserify = require('browserify'), source = require('vinyl-source-stream'), buffer = require('vinyl-buffer'),

    sourcemaps = require('gulp-sourcemaps'),

    sass = require('gulp-sass'),

    log = require('fancy-log')


var markdown_editor_res = {
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
            // raphael.min.js underscore.min.js sequence-diagram.min.js flowchart.min.js jquery.flowchart.min.js
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
        .pipe(gulp_replace(/fontawesome-([^=]+)v=([\d\.]+)/g, 'fontawesome-$1v=' + fontawesome_versin))
        .pipe(rename('editormd.css.version'))
        .pipe(gulp.dest(pkg_dir + 'editor.md/css'));
}

function editormd_font_version_move() {
    return shell.task([
        'mv node_modules/editor.md/css/editormd.css node_modules/editor.md/css/editormd.css.bak',
        'mv node_modules/editor.md/css/editormd.css.version node_modules/editor.md/css/editormd.css',
    ], {
        ignoreErrors: true,
    })
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


function dist_css() {
    return gulp.src([
        // pkg_dir + 'formvalidation/dist/css/formValidation.min.css',
        pkg_dir + 'select2/dist/css/select2.min.css',
        pkg_dir + 'slick-carousel/slick/slick.css',
        // pkg_dir + 'slick-carousel/slick/slick-theme.css',
    ].concat(
        markdown_editor_res[markdown_editor]['css']
    ))
        .pipe(concat('vendor.css'))
        .pipe(cleanCSS())
        .pipe(gulp.dest('public/css'));
}


//  used by both client side and server side(merged to vendor.js)
function dist_browserify() {

    var b = browserify({
        entries: './resources/js/_markdownit.js',
        debug: true
    });

    return b.bundle()
        .pipe(source('browserify_md.js'))  // output file
        .pipe(buffer())
        .pipe(sourcemaps.init({loadMaps: true}))
        // Add transformation tasks to the pipeline here.
        .pipe(uglify())
        .on('error', log)
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./public/js/'));

}

function dist_js_app() {
   return gulp.src(['resources/js/zc.js'])
       .pipe(sourcemaps.init())
       .pipe(uglify())
       .pipe(sourcemaps.write())
       .pipe(gulp.dest('public/js'));
}

function dist_js_vendor() {

    // google maps in a dependent file
    gulp.src([
        pkg_dir + 'gmaps/gmaps.min.js',

        // bower_pkg_dir + 'jquery-timer/jquery.timer.js',
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
        pkg_dir + 'underscore/underscore-min.js', // 17k
        // use cdn instead
        // pkg_dir + 'd3/build/d3.min.js', // 214k

        // pkg_dir + 'formvalidation/dist/js/formValidation.min.js',// 119k
        // pkg_dir + 'formvalidation/dist/js/framework/bootstrap.min.js',
        // pkg_dir + 'formvalidation/dist/js/language/zh_CN.js',

        pkg_dir + 'form-serializer/jquery.serialize-object.js',
        pkg_dir + 'jQuery-autoGrowInput/jquery.auto-grow-input.min.js',
        pkg_dir + 'select2/dist/js/select2.min.js', // 66k
        pkg_dir + 'vanilla-masker/build/vanilla-masker.min.js',

        pkg_dir + 'slick-carousel/slick/slick.min.js', // 41k
        pkg_dir + 'jquery-mousewheel/jquery.mousewheel.js',
        pkg_dir + 'jquery-visible/jquery.visible.min.js',
        pkg_dir + 'perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js',
        pkg_dir + 'jquery-touchswipe/jquery.touchSwipe.min.js',

        // use cdn instead
        // pkg_dir + 'jquery-mapael/js/jquery.mapael.js', // 53k
        // pkg_dir + 'jquery-mapael/js/maps/world_countries.js',
        'resources/js/world.js',

        pkg_dir + 'vue/dist/vue.min.js',


    ].concat(
        markdown_editor_res[markdown_editor]['js']
    ))
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


function watch() {

    gulp.watch('./resources/js/zc.js',
        {
            ignoreInitial:false,
            delay:600,
            // Usually necessary when watching files on a network mount or on a VMs file system.
            usePolling:true,
        },
        dist_js_app)

    gulp.watch(
        './resources/assets/sass/**/*.scss',
        {
            ignoreInitial:false,
            ignored:'./resources/assets/sass/pass/_ferry.scss',
            delay:300,
            // Usually necessary when watching files on a network mount or on a VMs file system.
            usePolling:true,
        },
        sass_app);

    gulp.watch(
        './resources/assets/sass/pass/_ferry.scss',
        {
            ignoreInitial:false,
            delay:300,
            usePolling:true,
        },
        sass_ferry);
}


gulp.task('db:seeds:watch', function () {
    var ids = {};
    var watcher = gulp.watch('database/seeds/*.php', ['']);

    watcher.on('change', function (event) {
            if (event.type === 'added' || event.type === 'changed') {
                var file = event.path;
                if (file in ids) {
                    clearTimeout(ids[file]);
                    delete ids[file];
                    console.log('esc db:seed ' + file);
                }
                console.log('[prepare db:seed] ' + file);
                ids[file] = setTimeout(function () {
                    delete ids[file];
                    var className = path.basename(file, '.php');
                    var cmd = "start db:seed --class=" + className;
                    console.log(cmd);
                    process.exec(cmd, function (error, stdout, stderr) {
                            if (error !== null) {
                                console.log('db:seed error: ' + error);
                            }
                        }
                    );
                    //gulp.src("").pipe(shell(cmd));
                }, 1000 * 20);
            }
        }
    )
    ;
});


exports.clean = clean;
exports.dist_css = dist_css;
exports.dist_js = dist_js_vendor;
exports.dist_js_app = dist_js_app;

exports.sass_app = sass_app;
exports.sass_ferry = sass_ferry;

exports.watch= watch;

var build = gulp.series(
    clean,
    gulp.parallel(
        dist_css,
        dist_js_app,
        gulp.series(dist_js_vendor, dist_browserify),
    ),
    sass_app,
    sass_ferry
);
gulp.task('default', build);
