require('events').EventEmitter.prototype._maxListeners = 100;

'use strict';
var gulp = require('gulp'),
    autoprefixer = require('gulp-autoprefixer'),
    minifyCSS = require('gulp-minify-css'),
    sourcemaps = require('gulp-sourcemaps'),
    es = require('event-stream'),
    concat = require('gulp-concat'),
    cleanCSS = require('gulp-clean-css'),
    sass = require('gulp-sass');

gulp.task('serve', ['sass'], function () {
    gulp.watch('./sass/*.scss', ['sass']);
});

function errorHandle(er) {
    console.log(er.toString());

    this.emit('end');
}
gulp.task('default', ['serve']);

// Run SASS compiling and reloading
gulp.task('prefix', function () {
    return gulp.src('./sass/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            errLogToConsole: true
        }))
        .on("error", errorHandle)
        .pipe(autoprefixer({
            browsers: ['last 2 versions', '> 1%', 'Firefox ESR', 'iOS 7']
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./css'))
})

gulp.task('sass', ['prefix'], function () {

    return gulp.src('css/*.css')
        .pipe(minifyCSS())
        .pipe(concat('style.min.css'))
        .pipe(gulp.dest('public/css'))

});

// Minify CSS
gulp.task('minify', ['sass'], function () {
    return gulp.src('./css/*.css')
        .pipe(cleanCSS({
            compatibility: '*'
        }))
        .pipe(gulp.dest('public/css'));
});
