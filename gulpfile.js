const { src, dest, watch, parallel} = require('gulp');
const sourcemaps = require('gulp-sourcemaps')
const terser = require('gulp-terser-js');
const imagemin = require('gulp-imagemin'); // Minificar imagenes 
const cache = require('gulp-cache');
const clean = require('gulp-clean');
const webp = require('gulp-webp');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*',
}

function javascript() {
    return src(paths.js)
        .pipe(sourcemaps.init())
        .pipe(terser())
        .pipe(sourcemaps.write('.'))
        .pipe(dest('./public/build/js'))
}

/* Opitmizacion de imagenes jpg
function imagenes() {
    return src(paths.iconos)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('public/build/img'))
        .pipe(notify({ message: 'Imagen Completada' }));
}
*/

function versionWebp() {
    return src(paths.imagenes)
        .pipe(webp())
        .pipe(dest('public/build/img'))
}


function watchPaths() {
    watch(paths.js, javascript);
    // watch(paths.imagenes, imagenes);
    // watch(paths.imagenes, versionWebp);
}

exports.webp = versionWebp;
exports.javascript = javascript;
exports.watch = watchPaths;
exports.default = parallel(javascript, versionWebp); 