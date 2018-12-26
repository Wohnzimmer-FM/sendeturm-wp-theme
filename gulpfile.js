var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src(['src/scss/*.scss'])
        .pipe(sass())
        .pipe(gulp.dest("dist/css"))
        .pipe(browserSync.stream());
});

// Move the javascript files into our /dist/js folder
gulp.task('js', function() {
    return gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js', 
                     'node_modules/jquery/dist/jquery.min.js', 
                     'node_modules/popper.js/dist/umd/popper.min.js',
                     'src/js/sendeturm.js'])
        .pipe(gulp.dest("dist/js"))
        .pipe(browserSync.stream());
});

gulp.task('assets', function() {
    return gulp.src(['src/assets/**/*']).pipe(gulp.dest("dist/assets"))
});

gulp.task('css', function() {
    return gulp.src(['src/css/**/*']).pipe(gulp.dest("dist/css"))
});

// Static Server + watching scss/html files
gulp.task('serve', ['sass', 'assets', 'css', 'js'], function() {
    gulp.watch(['node_modules/bootstrap/scss/bootstrap.scss', 'src/scss/*.scss'], ['sass']);
    gulp.watch(['src/js/*.js'], ['js']);
});

gulp.task('default', ['js','serve']);