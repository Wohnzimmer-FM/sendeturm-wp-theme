const { src, dest, parallel, watch, series } = require('gulp');
const concat = require('gulp-concat');
const gulp_sass = require('gulp-sass');
const minifyCSS = require('gulp-csso');
const del = require("del");

exports.clean = function clean() {
    return del(["./dist"]);
}

exports.js = function js() {
    return src(['node_modules/bootstrap/dist/js/bootstrap.min.js', 
        'node_modules/jquery/dist/jquery.min.js', 
        'node_modules/popper.js/dist/umd/popper.min.js',
        'src/js/sendeturm.js'], { sourcemaps: true })
        .pipe(concat('sendeturm.min.js'))
        .pipe(dest("dist/js", { sourcemaps: true }))
}

exports.assets = function assets() {
    return src(['src/assets/**/*'])
        .pipe(dest("dist/assets"))
}

exports.css = function css() {
    return src(['src/css/**/*'])
        .pipe(dest("dist/css"))
}

exports.sass = function sass() {
    return src(['src/scss/*.scss'])
        .pipe(gulp_sass())
        .pipe(minifyCSS())
        .pipe(dest("dist/css"))
}

exports.watch = function() {
    watch(['node_modules/bootstrap/scss/bootstrap.scss', 'src/scss/*.scss'], exports.sass);
};

exports.default = series(exports.clean, parallel(
    exports.sass,
    exports.css,
    exports.js,
    exports.assets,
));