var gulp = require('gulp');
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    del = require('del');

var config = {
    js: [
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    ],
    css: [        
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/fontawesome-4.7/css/font-awesome.min.css',
    ],
    fonts: [
        'node_modules/fontawesome-4.7/fonts/FontAwesome.otf',
        'node_modules/fontawesome-4.7/fonts/fontawesome-webfont.eot',
        'node_modules/fontawesome-4.7/fonts/fontawesome-webfont.svg',
        'node_modules/fontawesome-4.7/fonts/fontawesome-webfont.ttf',
        'node_modules/fontawesome-4.7/fonts/fontawesome-webfont.woff',
        'node_modules/fontawesome-4.7/fonts/fontawesome-webfont.woff2'
    ],
}

gulp.task('clean', function () {
    return del(['assets/js/all.min.js', 'assets/css/all.min.css', 'assets/fonts/*']);
});

gulp.task('fonts', function () {
    return gulp.src(config.fonts)
        .pipe(gulp.dest('assets/fonts/'));
});

gulp.task('styles', function () {
    return gulp.src(config.css)
        .pipe(concat('all.min.css'))
        .pipe(gulp.dest('assets/css/'));
});

gulp.task('scripts', function () {
    return gulp.src(config.js)
        .pipe(concat('all.min.js'))
        .pipe(gulp.dest('assets/js/'));
});

gulp.task('default', gulp.series('clean', 'fonts', 'styles', 'scripts'), function () {
    
});