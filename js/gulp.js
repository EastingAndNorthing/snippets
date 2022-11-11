var gulp 	= require('gulp');
var sass 	= require('gulp-sass');
var prefix 	= require('gulp-autoprefixer');
var sourcemaps 	= require('gulp-sourcemaps');
var cssmin = require('gulp-cssmin');
var rename = require('gulp-rename');
var browserSync = require('browser-sync').create();

gulp.task('styles', function() {
	gulp.src(['style/**/*.sass', 'style/**/*.scss'])
	.pipe(sourcemaps.init())
	.pipe(sass().on('error', sass.logError))
	.pipe(prefix({
        browsers: ['last 2 versions', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'],
        cascade: false
    }))
	// .pipe(rename({suffix: '.min'}))
	.pipe(sourcemaps.write('.'))
	// .pipe(cssmin())
	.pipe(gulp.dest('./style/'))
	.pipe(browserSync.stream());
});

gulp.task('browser-sync', function() {
	browserSync.init({
		open: false,
		proxy: 'wnf.dev'
	});
});

gulp.task('default', ['browser-sync','styles'], function() {
	gulp.watch(['style/**/*.sass', 'style/**/*.scss'],['styles']);
});
