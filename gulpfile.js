const   gulp = require("gulp"),
        concat = require("gulp-concat"),
        autoprefixer = require("gulp-autoprefixer"),
        cleanCSS = require('gulp-clean-css'),
        uglify = require('gulp-uglify'),
        del = require('del'),
        browserSync = require('browser-sync').create(),
        babel = require('gulp-babel'),
        sass = require('gulp-sass'),
        sourcemaps = require("gulp-sourcemaps");

const src = './public/src/',
      dist = './public/dist/';

const cssFiles = [
    "./node_modules/normalize.css/normalize.css",
    src + "scss/main.scss"
];

const jsFiles = [
    src + "js/main.js",
];


function styles() {
    return gulp.src(cssFiles)
                .pipe(sass())
                .pipe(sourcemaps.init())
                .pipe(concat("all.css"))
                .pipe(autoprefixer({
                    browsers: ['> 0.1%'],
                    cascade: false
                }))
                .pipe(cleanCSS({
                    level: 2
                }))
                .pipe(sourcemaps.write())
                .pipe(gulp.dest(dist + "css"))
                // .pipe(browserSync.stream());
}

function scripts() {
    return gulp.src(jsFiles)
                .pipe(babel())
                .pipe(uglify({
                    toplevel: true
                }))
                // .pipe(concat("all.js"))
                .pipe(gulp.dest(dist + "js"))
                // .pipe(browserSync.stream());
}


function clean() {
    // return del(["dist/css/*", "dist/js/*", "!dist/js/functions.js"])
}

function watch() {
    // browserSync.init({
    //     server: {
    //         baseDir: "./"
    //     }
    // });
    gulp.watch(src + 'scss/**/*.scss', styles);
    gulp.watch(src + 'js/**/*.js', scripts);
    // gulp.watch('./*.html', browserSync.reload);
}

gulp.task('clean', clean);

gulp.task('styles', styles);
gulp.task('scripts', scripts);

gulp.task('build', gulp.parallel('styles', 'scripts'));

gulp.task('watch', watch);

gulp.task('dev', gulp.series('build', 'watch'));
