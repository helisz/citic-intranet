var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
 
gulp.task('sass', function () {
    gulp.src('sass/*.scss')
	.pipe(sourcemaps.init())
        .pipe(sass({includePaths: ['sass/partials']}).on('error', sass.logError))    
        .pipe(sass({ noCache: true }))     
       	.pipe(concat('style.css'))
	.pipe(sourcemaps.write('maps'))
        .pipe(gulp.dest('css')); 
}); 

gulp.task('watch', function () {
    gulp.watch([
    	'sass/*.scss', 'sass/partials/*.scss'
    	],['sass']); 
}); 

gulp.task('default', ['sass','watch']);
